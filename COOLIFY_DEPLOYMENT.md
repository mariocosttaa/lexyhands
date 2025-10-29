# Coolify Deployment Guide for LexyHands

## Quick Start

1. **In Coolify, create a new application:**
   - Repository: `https://github.com/mariocosttaa/lexyhands`
   - Branch: `master`
   - Dockerfile: `Dockerfile.prod`

2. **Configure Port:**
   - Port: `80`

3. **Set Environment Variables:**
   - Coolify will prompt you to configure `.env` variables

4. **Database Setup:**
   - Add MySQL service in Coolify (separate resource)
   - Database connection will be auto-injected

5. **Deploy!**

## Environment Variables

Configure these in Coolify's environment variable section:
```env
# Database (Coolify will auto-inject database credentials if using Coolify database)
DB_HOST=your-database-host
DB_PORT=3306
DB_NAME=lexyhands
DB_USER=your-database-user
DB_PASSWORD=your-secure-password

# Application
APP_NAME="LexyHands"
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_ENV=production
```

## Coolify Settings

### Public Directory
**IMPORTANT:** In Coolify settings, set:
- **Public Directory**: `public` (if not auto-detected)
- **Port**: `80`

This ensures Apache serves from `/var/www/html/public` (where `public/index.php` is located) instead of the root directory.

### How It Works

1. **Coolify clones the repository** from GitHub automatically
2. **Dockerfile.prod builds the application:**
   - Installs PHP extensions
   - Installs Composer dependencies
   - Regenerates autoloader (PSR-4 compliant)
   - Sets proper permissions
   - Configures Apache

3. **No manual steps needed** - everything is automated!

### PSR-4 Compliance
✅ All classes follow PSR-4 autoloading standards
✅ Namespace `App\\` maps to `app/` directory
✅ All paths are dynamic (no hardcoded values)

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

