// Authentication related functions
class AuthManager {
    constructor() {
        this.sessionCheckInterval = null;
        this.startSessionCheck();
    }

    startSessionCheck() {
        // Check session every 5 minutes
        this.sessionCheckInterval = setInterval(() => {
            this.checkSessionValidity();
        }, 5 * 60 * 1000);
    }

    async checkSessionValidity() {
        try {
            const response = await fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'check_session' })
            });

            const data = await response.json();
            
            if (!data.success) {
                // Session expired, redirect to login
                this.handleSessionExpired();
            }
        } catch (error) {
            console.error('Session check failed:', error);
        }
    }

    handleSessionExpired() {
        clearInterval(this.sessionCheckInterval);
        
        // Show session expired message
        const modal = this.createSessionExpiredModal();
        document.body.appendChild(modal);
        
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        
        // Auto logout after 10 seconds
        setTimeout(() => {
            window.app.logout();
        }, 10000);
    }

    createSessionExpiredModal() {
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Sitzung abgelaufen
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p>Ihre Sitzung ist abgelaufen. Sie werden in Kürze zur Anmeldung weitergeleitet.</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="window.app.logout()">
                            Jetzt anmelden
                        </button>
                    </div>
                </div>
            </div>
        `;
        return modal;
    }

    validatePassword(password) {
        const minLength = 8;
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        const errors = [];
        
        if (password.length < minLength) {
            errors.push(`Mindestens ${minLength} Zeichen`);
        }
        if (!hasUpperCase) {
            errors.push('Mindestens ein Großbuchstabe');
        }
        if (!hasLowerCase) {
            errors.push('Mindestens ein Kleinbuchstabe');
        }
        if (!hasNumbers) {
            errors.push('Mindestens eine Zahl');
        }
        if (!hasSpecialChar) {
            errors.push('Mindestens ein Sonderzeichen');
        }

        return {
            isValid: errors.length === 0,
            errors: errors
        };
    }

    generateSecurePassword(length = 12) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let password = "";
        
        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        
        return password;
    }

    async changePassword(currentPassword, newPassword) {
        try {
            const response = await fetch('api/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'change_password',
                    current_password: currentPassword,
                    new_password: newPassword
                })
            });

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Password change failed:', error);
            return { success: false, message: 'Verbindungsfehler' };
        }
    }

    logActivity(action, description) {
        // Log user activity for security purposes
        fetch('api/activity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: action,
                description: description,
                timestamp: new Date().toISOString()
            })
        }).catch(error => {
            console.error('Activity logging failed:', error);
        });
    }
}

// Initialize auth manager
document.addEventListener('DOMContentLoaded', () => {
    window.authManager = new AuthManager();
});