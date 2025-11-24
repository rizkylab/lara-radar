# LaraRadar - Extended Threat Intelligence Platform

![LaraRadar Logo](https://via.placeholder.com/800x200/6366f1/ffffff?text=LaraRadar+XTI+Platform)

**LaraRadar** is a comprehensive Extended Threat Intelligence (XTI) platform inspired by SOC Radar, built with Laravel 12, MySQL, Redis, Python scanning workers, and the beautiful Mazer Admin Dashboard UI.

## 🚀 Features

### Attack Surface Management (ASM)
- **Domain Monitoring**: Track and monitor your organization's domains
- **Subdomain Enumeration**: Automated subdomain discovery using Amass
- **Port Scanning**: Comprehensive port scanning with Nmap
- **Technology Stack Detection**: Identify technologies using WhatWeb
- **Screenshot Capture**: Visual verification of discovered assets

### Vulnerability Intelligence
- **Automated Vulnerability Scanning**: Nuclei-powered vulnerability detection
- **CVE Intelligence**: Real-time CVE tracking and trending analysis
- **CVSS Scoring**: Risk assessment with CVSS v3 scores
- **Remediation Tracking**: Monitor vulnerability remediation status

### Dark Web Monitoring
- **Credential Leak Detection**: Monitor for exposed credentials
- **Breach Database Integration**: LeakIX and HIBP API integration
- **Password Strength Analysis**: Assess compromised password strength
- **PII Exposure Tracking**: Monitor personally identifiable information leaks

### Threat Hunting
- **Advanced Search**: Query across all threat intelligence data
- **Botnet Detection**: Track botnet activity and infected IPs
- **Alert Management**: Centralized alert center with severity-based prioritization

### Security & Compliance
- ✅ **Anti-SQL Injection**: Eloquent ORM with strict validation
- ✅ **Anti-XSS**: Output escaping and input sanitization
- ✅ **Anti-IDOR**: Policy-based authorization with ownership checks
- ✅ **RBAC**: Role-based access control (Superadmin, Admin, Analyst, Viewer)
- ✅ **Rate Limiting**: Endpoint-specific rate limits
- ✅ **Audit Logging**: Comprehensive activity tracking
- ✅ **CSP Headers**: Content Security Policy implementation

## 📋 Technology Stack

### Backend
- **Framework**: Laravel 12
- **Database**: MySQL 8
- **Cache & Queue**: Redis
- **Queue Management**: Laravel Horizon
- **Permissions**: Spatie Laravel Permission
- **API Documentation**: L5-Swagger (OpenAPI 3.0)

### Frontend
- **UI Template**: Mazer Admin Dashboard
- **Charts**: ApexCharts
- **Icons**: Bootstrap Icons
- **DataTables**: Responsive tables with search/filter
- **Theme**: Light/Dark mode support

### Python Workers (FastAPI)
- **Subdomain Enumeration**: Amass
- **Port Scanning**: Nmap
- **Tech Detection**: WhatWeb
- **Vulnerability Scanning**: Nuclei
- **Screenshots**: Selenium/Playwright
- **Dark Web Scraping**: Custom scrapers
- **Breach Data**: LeakIX/HIBP API integration

## 🛠️ Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Redis 6.0+
- Node.js 18+ & NPM
- Python 3.11+
- Git

### Step 1: Clone Repository
```bash
git clone git@github.com:rizkylab/lara-radar.git
cd lara-radar
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```env
APP_NAME=LaraRadar
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lara_radar
DB_USERNAME=root
DB_PASSWORD=your_password

REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

QUEUE_CONNECTION=redis
CACHE_STORE=redis
SESSION_DRIVER=redis
```

### Step 4: Database Setup
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE lara_radar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php artisan migrate

# Seed database with example data
php artisan db:seed
```

### Step 5: Install Frontend Assets
```bash
npm install
npm run build
```

### Step 6: Setup Laravel Horizon
```bash
php artisan horizon:install
php artisan horizon:publish
```

### Step 7: Setup Python Workers
```bash
cd workers
python3 -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate
pip install -r requirements.txt
```

### Step 8: Start Services

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Laravel Horizon (Queue Worker):**
```bash
php artisan horizon
```

**Terminal 3 - Python Workers:**
```bash
cd workers
source venv/bin/activate
uvicorn main:app --reload --port 8001
```

**Terminal 4 - Redis (if not running as service):**
```bash
redis-server
```

## 🎯 Default Credentials

After running seeders, use these credentials:

| Role | Email | Password |
|------|-------|----------|
| Superadmin | superadmin@lararadar.local | password |
| Admin | admin@lararadar.local | password |
| Analyst | analyst@lararadar.local | password |
| Viewer | viewer@lararadar.local | password |

## 📚 API Documentation

### Swagger UI
Access interactive API documentation at:
```
http://localhost:8000/api/docs
```

### Postman Collection
Import the Postman collection:
```
docs/api/lara-radar.postman_collection.json
```

### API Versioning
All API endpoints are versioned:
```
/api/v1/...
```

### Authentication
Use Bearer token authentication:
```bash
# Login to get token
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@lararadar.local","password":"password"}'

# Use token in subsequent requests
curl -X GET http://localhost:8000/api/v1/domains \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## 🔐 Security Features

### Input Validation
All user inputs are validated using Laravel's validation rules:
```php
$request->validate([
    'domain' => 'required|string|max:255|regex:/^[a-zA-Z0-9.-]+$/',
    'email' => 'required|email|max:255',
]);
```

### Output Escaping
All outputs are escaped using Blade's `{{ }}` syntax or `e()` helper.

### IDOR Protection
All resources are protected with policies:
```php
// DomainPolicy.php
public function view(User $user, Domain $domain)
{
    return $user->company_id === $domain->company_id;
}
```

### Rate Limiting
```php
// routes/api.php
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::post('/domains/{id}/scan', [DomainController::class, 'scan'])
        ->middleware('throttle:10,1'); // 10 requests per minute for scanning
});
```

## 📖 User Guide

Comprehensive user guide available at:
```
docs/user-guide/README.md
```

Topics covered:
- Getting Started
- Adding Domains
- Running Scans
- Viewing Vulnerabilities
- Dark Web Monitoring
- Managing Alerts
- Exporting Reports

## 👨‍💻 Developer Documentation

Developer documentation available at:
```
docs/developer/
```

Topics covered:
- Architecture Overview
- Database Schema (ERD)
- API Authentication
- Worker System
- Security Hardening
- Audit Log System
- Testing Guide

## 🧪 Testing

### Run PHPUnit Tests
```bash
php artisan test
```

### Run Security Tests
```bash
php artisan test --filter SecurityTest
```

### Code Coverage
```bash
php artisan test --coverage
```

## 📊 Database Schema

### Core Tables
- `companies` - Multi-tenant organizations
- `users` - User accounts with RBAC
- `roles` & `permissions` - Spatie permission tables
- `domains` - Monitored domains
- `subdomains` - Discovered subdomains
- `ports` - Open ports
- `tech_stacks` - Detected technologies
- `vulnerabilities` - Security vulnerabilities
- `cves` - CVE intelligence database
- `darkweb_credentials` - Credential leaks
- `botnets` - Botnet activity
- `pii_exposures` - PII leaks
- `alerts` - Security alerts
- `audit_logs` - Activity tracking
- `api_keys` - API authentication
- `worker_statuses` - Worker health monitoring

## 🔄 Cron Jobs

Add to your crontab:
```bash
* * * * * cd /path/to/lara-radar && php artisan schedule:run >> /dev/null 2>&1
```

Scheduled tasks:
- CVE database update (daily)
- Dark web scraping (hourly)
- Worker health check (every 5 minutes)
- Alert cleanup (daily)
- Audit log cleanup (weekly)

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure proper database credentials
- [ ] Setup Redis with persistence
- [ ] Configure mail driver for alerts
- [ ] Setup SSL certificate
- [ ] Configure firewall rules
- [ ] Setup automated backups
- [ ] Configure log rotation
- [ ] Setup monitoring (Horizon dashboard)

### Supervisor Configuration
```ini
[program:lara-radar-horizon]
process_name=%(program_name)s
command=php /path/to/lara-radar/artisan horizon
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/path/to/lara-radar/storage/logs/horizon.log
```

## 📝 License

This project is licensed under the MIT License.

## 🤝 Contributing

Contributions are welcome! Please read our [Contributing Guide](CONTRIBUTING.md) for details.

## 📧 Support

For support, email: support@lararadar.local

## 🙏 Acknowledgments

- **SOC Radar** - Inspiration for the platform
- **Mazer** - Beautiful admin dashboard template
- **Laravel** - The PHP framework for web artisans
- **OWASP** - Security best practices

---

**Built with ❤️ by the LaraRadar Team**
