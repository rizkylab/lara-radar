# LaraRadar Python Workers

Python-based scanning workers for LaraRadar Extended Threat Intelligence Platform.

## Workers

### 1. Subdomain Enumeration Worker
- **Tool**: Amass
- **Endpoint**: POST /workers/subdomain/scan
- **Function**: Discover subdomains for a given domain

### 2. Port Scanning Worker
- **Tool**: Nmap
- **Endpoint**: POST /workers/port/scan
- **Function**: Scan open ports on discovered assets

### 3. Technology Detection Worker
- **Tool**: WhatWeb
- **Endpoint**: POST /workers/tech/detect
- **Function**: Identify web technologies and frameworks

### 4. Vulnerability Scanning Worker
- **Tool**: Nuclei
- **Endpoint**: POST /workers/vuln/scan
- **Function**: Detect security vulnerabilities

### 5. Screenshot Worker
- **Tool**: Selenium/Playwright
- **Endpoint**: POST /workers/screenshot/capture
- **Function**: Capture screenshots of web applications

### 6. Dark Web Scraper Worker
- **Tool**: Custom scrapers
- **Endpoint**: POST /workers/darkweb/scrape
- **Function**: Monitor dark web for credential leaks

### 7. Breach Data Crawler Worker
- **Tools**: LeakIX API, HIBP API
- **Endpoint**: POST /workers/breach/check
- **Function**: Check for data breaches

## Installation

```bash
cd workers
python3 -m venv venv
source venv/bin/activate  # Windows: venv\Scripts\activate
pip install -r requirements.txt
```

## Configuration

Create `.env` file in workers directory:

```env
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_DB=0

LARAVEL_API_URL=http://localhost:8000/api/v1
LARAVEL_API_TOKEN=your_api_token_here

# Tool paths
AMASS_PATH=/usr/local/bin/amass
NMAP_PATH=/usr/bin/nmap
WHATWEB_PATH=/usr/local/bin/whatweb
NUCLEI_PATH=/usr/local/bin/nuclei

# API Keys
LEAKIX_API_KEY=your_leakix_key
HIBP_API_KEY=your_hibp_key
```

## Running Workers

### Development Mode
```bash
uvicorn main:app --reload --port 8001
```

### Production Mode
```bash
gunicorn main:app --workers 4 --worker-class uvicorn.workers.UvicornWorker --bind 0.0.0.0:8001
```

### With Supervisor
```ini
[program:lara-radar-workers]
command=/path/to/workers/venv/bin/gunicorn main:app --workers 4 --worker-class uvicorn.workers.UvicornWorker --bind 0.0.0.0:8001
directory=/path/to/workers
user=www-data
autostart=true
autorestart=true
redirect_stderr=true
stdout_logfile=/var/log/lara-radar-workers.log
```

## API Documentation

Workers API documentation available at:
```
http://localhost:8001/docs
```

## Health Check

```bash
curl http://localhost:8001/health
```

Response:
```json
{
  "status": "healthy",
  "workers": {
    "subdomain": "online",
    "port": "online",
    "tech": "online",
    "vuln": "online",
    "screenshot": "online",
    "darkweb": "online",
    "breach": "online"
  },
  "version": "1.0.0"
}
```

## Worker Communication

Workers communicate with Laravel via:
1. **Redis Queue**: Receive scan jobs from Laravel
2. **HTTP API**: Send results back to Laravel API
3. **WebSocket** (optional): Real-time progress updates

## Security

- All worker endpoints require API token authentication
- Rate limiting applied per worker type
- Input validation on all endpoints
- Sandboxed execution environment for scanning tools

## Monitoring

Worker status is reported to Laravel every 60 seconds:
- Jobs processed count
- Jobs failed count
- Current status (online/offline/busy/error)
- Last heartbeat timestamp

## Development

### Adding a New Worker

1. Create worker file in `workers/` directory
2. Implement FastAPI endpoint
3. Add Redis queue listener
4. Register worker in `main.py`
5. Update health check endpoint
6. Add tests

### Testing

```bash
pytest tests/
```

## Troubleshooting

### Worker not receiving jobs
- Check Redis connection
- Verify queue name matches Laravel configuration
- Check worker status in Laravel admin panel

### Scanning tools not found
- Verify tool paths in `.env`
- Install missing tools
- Check file permissions

### API authentication failing
- Verify API token in `.env`
- Check Laravel API is accessible
- Review Laravel logs

## License

MIT License - See main project LICENSE file
