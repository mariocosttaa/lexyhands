# Docker Production Deployment

This guide explains how to deploy LexyHands using the production Dockerfile.

**Note:** For Coolify deployments, the platform handles Git cloning automatically. The Dockerfile.prod is optimized for this workflow.

## Quick Start

### Option 1: Using Docker Compose (Recommended)

```bash
# Clone or download this repository
git clone https://github.com/mariocosttaa/lexyhands.git
cd lexyhands

# Create .env file with your configuration
cp env.example .env
# Edit .env with your settings

# Build and start containers
docker-compose -f docker-compose.prod.standalone.yml up -d --build

# Run migrations
docker-compose -f docker-compose.prod.standalone.yml exec app php migrate.php

# Run seeders (optional)
docker-compose -f docker-compose.prod.standalone.yml exec app php seed.php --refresh
```

### Option 2: Using Dockerfile Directly (for local builds)

```bash
# Build the image (files should be in current directory)
docker build \
  --file Dockerfile.prod \
  --tag lexyhands:prod \
  .

# Run the container
docker run -d \
  --name lexyhands_prod \
  -p 80:80 \
  -e DB_HOST=mysql_host \
  -e DB_PORT=3306 \
  -e DB_NAME=lexyhands \
  -e DB_USER=lexyhands \
  -e DB_PASSWORD=your_password \
  -e APP_URL=https://yourdomain.com \
  -e APP_DEBUG=false \
  lexyhands:prod
```

## For Coolify Deployment

Coolify automatically:
- Clones the repository from GitHub
- Sets up environment variables
- Configures ports
- Handles database connections (if using Coolify database service)

You just need to:
1. Point to repository: `https://github.com/mariocosttaa/lexyhands`
2. Select Dockerfile: `Dockerfile.prod`
3. Configure port: `80`
4. Set environment variables in Coolify UI
5. Deploy!

See `COOLIFY_DEPLOYMENT.md` for detailed Coolify setup instructions.

## Environment Variables

Create a `.env` file or set these environment variables:

```env
# Database (Required)
DB_HOST=mysql
DB_PORT=3306
DB_NAME=lexyhands
DB_USER=lexyhands
DB_PASSWORD=your_secure_password

# MySQL Root (For docker-compose)
MYSQL_ROOT_PASSWORD=root_secure_password

# Application (Required)
APP_NAME=LexyHands
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_ENV=production

# Optional
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

## Post-Deployment Steps

### 1. Run Migrations

```bash
# Using docker-compose
docker-compose -f docker-compose.prod.standalone.yml exec app php migrate.php

# Using docker directly
docker exec lexyhands_prod php migrate.php
```

### 2. Seed Database (Optional)

```bash
# Using docker-compose
docker-compose -f docker-compose.prod.standalone.yml exec app php seed.php --refresh

# Using docker directly
docker exec lexyhands_prod php seed.php --refresh
```

### 3. Set File Permissions

```bash
# Using docker-compose
docker-compose -f docker-compose.prod.standalone.yml exec app chmod -R 775 app/cache

# Using docker directly
docker exec lexyhands_prod chmod -R 775 /var/www/html/app/cache
```

## Docker Compose Services

The `docker-compose.prod.standalone.yml` includes:

1. **app** - PHP 8.1 with Apache (clones from GitHub)
2. **mysql** - MySQL 8.0 database (optional, can use external DB)

## Production Considerations

### Security

1. **Never commit `.env` files** - Use environment variables
2. **Set `APP_DEBUG=false`** in production
3. **Use strong passwords** for database
4. **Enable HTTPS** via reverse proxy (Nginx, Traefik, etc.)
5. **Keep dependencies updated**: `composer audit`

### Performance

1. **Use PHP OPcache** (enabled by default in PHP 8.1)
2. **Optimize Composer autoloader**: Already included in Dockerfile
3. **Cache configuration**: Set `CACHE_DRIVER=redis` for better performance
4. **Database connection pooling**: Configure in your database

### Monitoring

1. **Health checks**: Built-in healthcheck endpoint at `/`
2. **Logs**: 
   ```bash
   docker-compose -f docker-compose.prod.standalone.yml logs -f app
   ```
3. **Container status**:
   ```bash
   docker-compose -f docker-compose.prod.standalone.yml ps
   ```

## Updating Application

### Method 1: Rebuild Container

```bash
# Stop current container
docker-compose -f docker-compose.prod.standalone.yml down

# Rebuild with latest code
docker-compose -f docker-compose.prod.standalone.yml build --no-cache

# Start again
docker-compose -f docker-compose.prod.standalone.yml up -d
```

### Method 2: Build with Specific Commit

```bash
# Build with specific commit SHA
docker-compose -f docker-compose.prod.standalone.yml build \
  --build-arg GIT_COMMIT=abc123def456

# Restart
docker-compose -f docker-compose.prod.standalone.yml up -d
```

## Troubleshooting

### Container Won't Start

```bash
# Check logs
docker-compose -f docker-compose.prod.standalone.yml logs app

# Check if Router class exists
docker-compose -f docker-compose.prod.standalone.yml exec app \
  php -r "require 'vendor/autoload.php'; var_dump(class_exists('App\Services\Router'));"
```

### Database Connection Issues

```bash
# Test database connection from container
docker-compose -f docker-compose.prod.standalone.yml exec app \
  php -r "require 'vendor/autoload.php'; \$pdo = App\Config\Database::conn(); echo 'Connected!';"
```

### Permission Issues

```bash
# Fix cache permissions
docker-compose -f docker-compose.prod.standalone.yml exec app \
  chown -R www-data:www-data /var/www/html/app/cache && \
  chmod -R 775 /var/www/html/app/cache
```

## CI/CD Integration

### GitHub Actions Example

```yaml
name: Build and Push Docker Image

on:
  push:
    branches: [master]

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - name: Build Docker Image
        run: |
          docker build \
            --file Dockerfile.prod \
            --build-arg GIT_REPO=https://github.com/mariocosttaa/lexyhands.git \
            --build-arg GIT_BRANCH=master \
            --build-arg GIT_COMMIT=${{ github.sha }} \
            --tag lexyhands:${{ github.sha }} \
            .
```

## Notes

- The Dockerfile clones from GitHub, so no local files needed (except docker-compose and .env)
- All Composer dependencies are installed during build
- Autoloader is regenerated after all files are in place
- Router class is verified before build completes
- Healthcheck ensures container is running correctly

