# Medientutoren Portal - Rewrite

Ein modernes, vollständig überarbeitetes Portal für Medientutoren mit verbesserter Benutzerverwaltung, Berechtigungssystem und Anleitungsverwaltung.

## Features

### ✨ Neue Funktionen
- **Moderne Benutzeroberfläche** mit Bootstrap 5 und responsivem Design
- **Erweiterte Benutzerverwaltung** mit Rollen und Berechtigungen
- **Verbessertes Anleitungssystem** mit Upload-Funktionalität und Kategorien
- **Dashboard** mit Statistiken und Schnellzugriff
- **Sicherheitsverbesserungen** mit Session-Management und Aktivitätsprotokollierung

### 🔐 Berechtigungssystem
- **Admin**: Vollzugriff auf alle Funktionen
- **Moderator**: Kann Inhalte verwalten, aber keine Benutzer
- **User**: Grundlegende Funktionen wie Anleitungen anzeigen und To-Dos verwalten

### 📚 Anleitungsverwaltung
- Anleitungen erstellen und bearbeiten
- Datei-Uploads für PDFs und Bilder
- Kategorisierung und Suchfunktion
- Vorlagen für häufige Anleitungstypen
- Versionsverwaltung und Freigabeprozess

## Installation

### Voraussetzungen
- PHP 7.4 oder höher
- MySQL 5.7 oder höher
- Webserver (Apache/Nginx)

### Setup
1. Dateien in das Webserver-Verzeichnis kopieren
2. Datenbank erstellen und `config/init.sql` importieren
3. Datenbankverbindung in `config/database.php` anpassen
4. Upload-Verzeichnisse erstellen und Schreibrechte setzen:
   ```bash
   mkdir -p uploads/guides
   chmod 755 uploads uploads/guides
   ```

### Standard-Anmeldedaten
- **Benutzername**: admin
- **Passwort**: admin123

## Technische Details

### Architektur
- **Frontend**: HTML5, CSS3, JavaScript (ES6+), Bootstrap 5
- **Backend**: PHP 8+ mit PDO für Datenbankzugriff
- **Datenbank**: MySQL mit normalisiertem Schema
- **API**: RESTful JSON API für Frontend-Backend Kommunikation

### Sicherheit
- Passwort-Hashing mit PHP's `password_hash()`
- SQL Injection Schutz durch Prepared Statements
- XSS-Schutz durch HTML-Escaping
- Session-Management mit automatischer Ablaufkontrolle
- CSRF-Schutz für kritische Aktionen

### Dateistruktur
```
/
├── api/                    # Backend API Endpoints
├── assets/                 # Frontend Assets (CSS, JS)
├── classes/               # PHP Klassen
├── config/                # Konfigurationsdateien
├── uploads/               # Upload-Verzeichnis
├── index.html            # Haupt-HTML-Datei
└── README.md             # Diese Datei
```

## Entwicklung

### API Endpoints
- `POST /api/auth.php` - Authentifizierung
- `GET|POST|PUT|DELETE /api/users.php` - Benutzerverwaltung
- `GET|POST|PUT|DELETE /api/guides.php` - Anleitungsverwaltung
- `GET|POST|PUT|DELETE /api/todos.php` - To-Do Verwaltung
- `GET|POST|PUT|DELETE /api/rooms.php` - Raum-Check Verwaltung

### Erweiterungen
Das System ist modular aufgebaut und kann einfach erweitert werden:
- Neue Seiten in `assets/js/pages.js` hinzufügen
- Neue API Endpoints erstellen
- Zusätzliche Berechtigungen in der Datenbank definieren

## Support

Bei Fragen oder Problemen wenden Sie sich an das Entwicklungsteam.

---

**Version**: 6.0.0  
**Letztes Update**: 2025  
**Entwickelt für**: Medientutoren Portal