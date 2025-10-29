# Coolify Deployment Guide for LexyHands

## Pre-Deployment Checklist

### 1. Environment Variables
Configure these in Coolify:
```env
# Database (Coolify will auto-inject database credentials)
DB_HOST=${DB_HOST}
DB_PORT=3306
DB_NAME=${DB_NAME}
DB_USER=${DB_USER}
DB_PASSWORD=${DB_PASSWORD}

# Application
APP_NAME="LexyHands"
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_ENV=production

# Security
APP_KEY=base64:generate-a-random-key-here

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### 2. Database Migration
After first deployment, run migrations:
```bash
docker-compose exec app php migrate.php
```

### 3. Seeders (Optional)
If you want to seed initial data:
```bash
docker-compose exec app php seed.php --refresh
```

### 4. File Permissions
Ensure cache directories are writable:
```bash
chmod -R 775 app/cache
chown -R www-data:www-data app/cache
```

### 5. Security Checklist
- [ ] Set `APP_DEBUG=false` in production
- [ ] Generate strong `APP_KEY` for production
- [ ] Use strong database passwords
- [ ] Enable HTTPS/SSL in Coolify
- [ ] Review and remove any hardcoded credentials
- [ ] Ensure `.env` is not committed to git (already in .gitignore)

### 6. Production Dockerfile Recommendations
- Already uses `--no-dev` flag ✅
- Already optimizes autoloader ✅
- Consider adding healthcheck

### 7. Known Issues to Fix
- Hardcoded localhost URL in `ServicesController.php` (line 26)

## Coolify-Specific Settings

### Build Command
```bash
composer install --no-dev --optimize-autoloader
```

### Start Command
```bash
apache2-foreground
```

### Public Directory
**IMPORTANT:** In Coolify settings, set:
- **Public Directory**: `public`
- **Port**: `80`

This ensures Apache serves from `/var/www/html/public` (where `public/index.php` is located) instead of the root directory.

### Autoloader Fix
If you encounter `Class "App\Services\Router" not found` errors:
1. The Dockerfile automatically regenerates the autoloader after copying files
2. The build process verifies Router class exists before finishing
3. If build fails with Router verification error, check that:
   - `app/services/Router.php` exists in the repository
   - `composer.json` has correct PSR-4 mappings: `"App\\": "app/"`
   - No files are being excluded by `.dockerignore` that shouldn't be

### Healthcheck (Optional)
Add to Dockerfile:
```dockerfile
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD curl -f http://localhost:80/ || exit 1
```

## Post-Deployment Steps

1. **Run Migrations**
   ```bash
   php migrate.php
   ```

2. **Clear Cache** (if needed)
   ```bash
   rm -rf app/cache/sqlEasy/*.cache
   rm -rf app/cache/logs/*.log
   ```

3. **Set Permissions**
   ```bash
   chmod -R 775 app/cache
   chown -R www-data:www-data app/cache app/cache/logs
   ```

4. **Test Application**
   - Visit homepage
   - Test service pages
   - Test admin login
   - Verify database connections

## Troubleshooting

### Database Connection Issues
- Verify environment variables are set in Coolify
- Check database container is running
- Ensure network connectivity between containers

### Permission Issues
- Cache directories must be writable (775)
- Log directories must be writable (775)

### Performance
- Enable OPcache in production
- Consider using Redis for cache (future enhancement)

## Backup Recommendations

Before deploying:
1. Backup current database
2. Export current data if needed
3. Save current .env configuration

## SSL/HTTPS

Coolify handles SSL automatically. Ensure:
- Domain is properly configured
- SSL certificate is valid
- All HTTP redirects to HTTPS (configure in Coolify)

