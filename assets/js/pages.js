// Page-specific functionality
App.prototype.loadDashboard = async function() {
    try {
        // Load dashboard statistics
        const [guidesResponse, todosResponse, roomsResponse] = await Promise.all([
            fetch('api/guides.php'),
            fetch('api/todos.php'),
            fetch('api/rooms.php')
        ]);

        const guidesData = await guidesResponse.json();
        const todosData = await todosResponse.json();
        const roomsData = await roomsResponse.json();

        const guidesCount = guidesData.success ? guidesData.data.length : 0;
        const todosCount = todosData.success ? todosData.data.filter(t => !t.is_completed).length : 0;
        const roomsCount = roomsData.success ? roomsData.data.length : 0;

        return `
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <p class="text-muted">Willkommen zurück, ${this.currentUser.first_name}!</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title text-muted mb-1">Anleitungen</h6>
                                    <div class="stats-number">${guidesCount}</div>
                                </div>
                                <div class="text-primary">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title text-muted mb-1">Offene To-Dos</h6>
                                    <div class="stats-number">${todosCount}</div>
                                </div>
                                <div class="text-warning">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title text-muted mb-1">Räume</h6>
                                    <div class="stats-number">${roomsCount}</div>
                                </div>
                                <div class="text-success">
                                    <i class="fas fa-door-open fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title text-muted mb-1">Benutzer</h6>
                                    <div class="stats-number">-</div>
                                </div>
                                <div class="text-info">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="#guides" data-page="guides" class="dashboard-card card text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-book"></i>
                            <h5>Anleitungen</h5>
                            <p class="mb-0">Tutorials verwalten</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="#todos" data-page="todos" class="dashboard-card card text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-tasks"></i>
                            <h5>To-Do Liste</h5>
                            <p class="mb-0">Aufgaben verwalten</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="#rooms" data-page="rooms" class="dashboard-card card text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-door-open"></i>
                            <h5>Raum-Check</h5>
                            <p class="mb-0">Räume überprüfen</p>
                        </div>
                    </a>
                </div>
                ${this.currentUser.role === 'admin' ? `
                <div class="col-md-3 mb-3">
                    <a href="#users" data-page="users" class="dashboard-card card text-decoration-none">
                        <div class="card-body text-center">
                            <i class="fas fa-users"></i>
                            <h5>Benutzer</h5>
                            <p class="mb-0">Benutzer verwalten</p>
                        </div>
                    </a>
                </div>
                ` : ''}
            </div>
        `;
    } catch (error) {
        console.error('Dashboard loading error:', error);
        return '<div class="alert alert-danger">Fehler beim Laden des Dashboards</div>';
    }
};

App.prototype.loadGuides = async function() {
    try {
        const response = await fetch('api/guides.php');
        const data = await response.json();

        if (!data.success) {
            return `<div class="alert alert-danger">${data.message}</div>`;
        }

        const guides = data.data;
        const categories = [...new Set(guides.map(g => g.category).filter(c => c))];

        return `
            <div class="row mb-4">
                <div class="col-md-8">
                    <h1 class="h3 mb-0">Anleitungen</h1>
                    <p class="text-muted">Tutorials und Hilfestellungen</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-primary" onclick="showCreateGuideModal()">
                        <i class="fas fa-plus me-2"></i>Neue Anleitung
                    </button>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="guideSearch" placeholder="Anleitungen durchsuchen...">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Alle Kategorien</option>
                        ${categories.map(cat => `<option value="${cat}">${cat}</option>`).join('')}
                    </select>
                </div>
            </div>

            <div class="row" id="guidesContainer">
                ${guides.map(guide => `
                    <div class="col-md-6 col-lg-4 mb-4 guide-item" data-category="${guide.category || ''}" data-title="${guide.title.toLowerCase()}">
                        <div class="card guide-card h-100" onclick="viewGuide(${guide.id})">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title">${this.escapeHtml(guide.title)}</h5>
                                    ${guide.category ? `<span class="guide-category">${guide.category}</span>` : ''}
                                </div>
                                <p class="card-text text-muted">${this.escapeHtml(guide.description || '').substring(0, 100)}...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>
                                        ${guide.first_name} ${guide.last_name}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>
                                        ${guide.views} Aufrufe
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('')}
            </div>

            ${guides.length === 0 ? '<div class="text-center py-5"><p class="text-muted">Keine Anleitungen vorhanden</p></div>' : ''}
        `;
    } catch (error) {
        console.error('Guides loading error:', error);
        return '<div class="alert alert-danger">Fehler beim Laden der Anleitungen</div>';
    }
};

App.prototype.initGuidesPage = function() {
    // Search functionality
    const searchInput = document.getElementById('guideSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    
    if (searchInput) {
        searchInput.addEventListener('input', this.filterGuides);
    }
    
    if (categoryFilter) {
        categoryFilter.addEventListener('change', this.filterGuides);
    }
};

App.prototype.filterGuides = function() {
    const searchTerm = document.getElementById('guideSearch').value.toLowerCase();
    const selectedCategory = document.getElementById('categoryFilter').value;
    const guideItems = document.querySelectorAll('.guide-item');

    guideItems.forEach(item => {
        const title = item.getAttribute('data-title');
        const category = item.getAttribute('data-category');
        
        const matchesSearch = title.includes(searchTerm);
        const matchesCategory = !selectedCategory || category === selectedCategory;
        
        item.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
    });
};

// Global functions for guides
window.viewGuide = function(id) {
    // Implementation for viewing a guide
    console.log('View guide:', id);
};

window.showCreateGuideModal = function() {
    // Implementation for creating a guide
    console.log('Show create guide modal');
};

App.prototype.loadTodos = async function() {
    return `
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0">To-Do Liste</h1>
                <p class="text-muted">Ihre Aufgaben und Termine</p>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary" onclick="showCreateTodoModal()">
                    <i class="fas fa-plus me-2"></i>Neue Aufgabe
                </button>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <p class="text-center text-muted py-5">To-Do Funktionalität wird implementiert...</p>
            </div>
        </div>
    `;
};

App.prototype.initTodosPage = function() {
    // Todo page initialization
};

App.prototype.loadRooms = async function() {
    return `
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0">Raum-Check</h1>
                <p class="text-muted">Raumstatus und Überprüfungen</p>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary" onclick="showCreateRoomCheckModal()">
                    <i class="fas fa-plus me-2"></i>Neuer Check
                </button>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <p class="text-center text-muted py-5">Raum-Check Funktionalität wird implementiert...</p>
            </div>
        </div>
    `;
};

App.prototype.initRoomsPage = function() {
    // Rooms page initialization
};

App.prototype.loadUsers = async function() {
    try {
        const response = await fetch('api/users.php');
        const data = await response.json();

        if (!data.success) {
            return `<div class="alert alert-danger">${data.message}</div>`;
        }

        const users = data.data;

        return `
            <div class="row mb-4">
                <div class="col-md-8">
                    <h1 class="h3 mb-0">Benutzerverwaltung</h1>
                    <p class="text-muted">Benutzer und Berechtigungen verwalten</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-primary" onclick="showCreateUserModal()">
                        <i class="fas fa-user-plus me-2"></i>Neuer Benutzer
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Benutzer</th>
                                    <th>E-Mail</th>
                                    <th>Rolle</th>
                                    <th>Status</th>
                                    <th>Erstellt</th>
                                    <th>Aktionen</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${users.map(user => `
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3">
                                                    ${user.first_name.charAt(0)}${user.last_name.charAt(0)}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">${this.escapeHtml(user.first_name)} ${this.escapeHtml(user.last_name)}</div>
                                                    <small class="text-muted">@${this.escapeHtml(user.username)}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${this.escapeHtml(user.email)}</td>
                                        <td>
                                            <span class="badge bg-${user.role === 'admin' ? 'danger' : user.role === 'moderator' ? 'warning' : 'primary'}">
                                                ${user.role}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-${user.is_active ? 'success' : 'secondary'}">
                                                ${user.is_active ? 'Aktiv' : 'Inaktiv'}
                                            </span>
                                        </td>
                                        <td>${this.formatDate(user.created_at)}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary" onclick="editUser(${user.id})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger" onclick="deleteUser(${user.id})" ${user.id === this.currentUser.id ? 'disabled' : ''}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `;
    } catch (error) {
        console.error('Users loading error:', error);
        return '<div class="alert alert-danger">Fehler beim Laden der Benutzer</div>';
    }
};

App.prototype.initUsersPage = function() {
    // Users page initialization
};

// Global functions for users
window.showCreateUserModal = function() {
    console.log('Show create user modal');
};

window.editUser = function(id) {
    console.log('Edit user:', id);
};

window.deleteUser = function(id) {
    console.log('Delete user:', id);
};