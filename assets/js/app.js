// Main Application JavaScript
class App {
    constructor() {
        this.currentUser = null;
        this.currentPage = 'dashboard';
        this.init();
    }

    init() {
        this.checkSession();
        this.bindEvents();
    }

    bindEvents() {
        // Navigation events
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-page]')) {
                e.preventDefault();
                const page = e.target.getAttribute('data-page');
                this.loadPage(page);
            }
        });

        // Form submissions
        document.addEventListener('submit', (e) => {
            if (e.target.id === 'loginForm') {
                e.preventDefault();
                this.handleLogin(e.target);
            }
        });

        // Hash change for navigation
        window.addEventListener('hashchange', () => {
            const page = window.location.hash.substring(1) || 'dashboard';
            this.loadPage(page);
        });
    }

    async checkSession() {
        try {
            const response = await fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'check_session' })
            });

            const data = await response.json();
            
            if (data.success) {
                this.currentUser = data.user;
                this.showMainInterface();
                const page = window.location.hash.substring(1) || 'dashboard';
                this.loadPage(page);
            } else {
                this.showLogin();
            }
        } catch (error) {
            console.error('Session check failed:', error);
            this.showLogin();
        }
    }

    async handleLogin(form) {
        const formData = new FormData(form);
        const username = formData.get('username');
        const password = formData.get('password');

        this.showLoading(true);

        try {
            const response = await fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'login',
                    username: username,
                    password: password
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.currentUser = data.user;
                this.showMainInterface();
                this.loadPage('dashboard');
                this.hideError('loginError');
            } else {
                this.showError('loginError', data.message);
            }
        } catch (error) {
            console.error('Login failed:', error);
            this.showError('loginError', 'Verbindungsfehler. Bitte versuchen Sie es erneut.');
        } finally {
            this.showLoading(false);
        }
    }

    async logout() {
        try {
            await fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'logout' })
            });
        } catch (error) {
            console.error('Logout error:', error);
        }

        this.currentUser = null;
        this.showLogin();
        window.location.hash = '';
    }

    showLogin() {
        document.getElementById('loginContainer').style.display = 'flex';
        document.getElementById('mainNav').style.display = 'none';
        document.getElementById('mainContent').style.display = 'none';
    }

    showMainInterface() {
        document.getElementById('loginContainer').style.display = 'none';
        document.getElementById('mainNav').style.display = 'block';
        document.getElementById('mainContent').style.display = 'block';
        
        // Update user display
        document.getElementById('userDisplayName').textContent = 
            `${this.currentUser.first_name} ${this.currentUser.last_name}`;

        // Show/hide admin elements
        const adminElements = document.querySelectorAll('.admin-only');
        adminElements.forEach(el => {
            el.style.display = this.currentUser.role === 'admin' ? 'block' : 'none';
        });
    }

    async loadPage(pageName) {
        this.currentPage = pageName;
        this.updateNavigation(pageName);
        
        const pageContent = document.getElementById('pageContent');
        pageContent.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary"></div></div>';

        try {
            let content = '';
            switch (pageName) {
                case 'dashboard':
                    content = await this.loadDashboard();
                    break;
                case 'guides':
                    content = await this.loadGuides();
                    break;
                case 'todos':
                    content = await this.loadTodos();
                    break;
                case 'rooms':
                    content = await this.loadRooms();
                    break;
                case 'users':
                    if (this.currentUser.role === 'admin') {
                        content = await this.loadUsers();
                    } else {
                        content = '<div class="alert alert-danger">Keine Berechtigung</div>';
                    }
                    break;
                default:
                    content = '<div class="alert alert-warning">Seite nicht gefunden</div>';
            }

            pageContent.innerHTML = content;
            pageContent.classList.add('fade-in');
            
            // Initialize page-specific functionality
            this.initPageFunctionality(pageName);
            
        } catch (error) {
            console.error('Error loading page:', error);
            pageContent.innerHTML = '<div class="alert alert-danger">Fehler beim Laden der Seite</div>';
        }
    }

    updateNavigation(activePage) {
        const navLinks = document.querySelectorAll('.nav-link[data-page]');
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('data-page') === activePage) {
                link.classList.add('active');
            }
        });
    }

    initPageFunctionality(pageName) {
        switch (pageName) {
            case 'guides':
                this.initGuidesPage();
                break;
            case 'todos':
                this.initTodosPage();
                break;
            case 'rooms':
                this.initRoomsPage();
                break;
            case 'users':
                this.initUsersPage();
                break;
        }
    }

    showLoading(show) {
        const spinner = document.getElementById('loadingSpinner');
        spinner.style.display = show ? 'flex' : 'none';
    }

    showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }

    hideError(elementId) {
        const errorElement = document.getElementById(elementId);
        errorElement.style.display = 'none';
    }

    showToast(message, type = 'success') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed`;
        toast.style.cssText = 'top: 100px; right: 20px; z-index: 9999; min-width: 300px;';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

        document.body.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    }

    formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('de-DE', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.app = new App();
});

// Global logout function
function logout() {
    window.app.logout();
}