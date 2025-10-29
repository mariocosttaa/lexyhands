# Complete Coolify Deployment Guide

## 🎯 Simple PHP/Apache Deployment - No Migrations, No Seeding

This guide shows you how to deploy LexyHands to Coolify using **only** the Dockerfile. MySQL will be in a **separate resource**. Migrations and seeding will be done **manually after deployment**.

---

## 📋 Pre-Deployment Checklist

### 1. Repository Setup
- ✅ Repository: `https://github.com/mariocosttaa/lexyhands`
- ✅ Branch: `master`
- ✅ Dockerfile exists: `Dockerfile` (in root directory)

### 2. Coolify Application Configuration

#### In Coolify, when creating/editing your application:

**General Tab:**
- **Build Pack:** Select **"Dockerfile"** (NOT Nixpacks!)
- **Base Directory:** `/` (root)
- **Port:** `80`
- **Publish Directory:** Leave empty (or `/`)

**Environment Variables Tab:**
Add these required variables:
```env
# Database (will connect to external MySQL resource)
DB_HOST=your-mysql-host-or-ip
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

**Advanced Tab:**
- **Pre-deployment Command:** Leave **EMPTY** (no migrations during build)
- **Post-deployment Command:** Leave **EMPTY** (we'll do manually)

**Ports:**
- **Port Exposes:** `80`
- **Port Mappings:** Coolify handles this automatically

---

## 🚀 Deployment Steps

### Step 1: Create Application in Coolify

1. Go to **Projects** → **New Application**
2. Enter repository: `https://github.com/mariocosttaa/lexyhands`
3. Select branch: `master`
4. Select Build Pack: **"Dockerfile"**
5. Port: `80`

### Step 2: Configure Environment Variables

1. Go to **Environment Variables** tab
2. Add all the variables listed above
3. Save

### Step 3: Deploy

1. Click **"Deploy"** button (▷ Deploy)
2. Wait for build to complete
3. Check deployment logs for any errors

### Step 4: Verify Build Success

In the deployment logs, you should see:
```
SUCCESS: Router class found
```

If you see `ERROR: Router class not found!`, there's an autoloader issue.

---

## 📝 Post-Deployment (Manual Steps)

After the Docker image is successfully deployed:

### 1. Access Terminal

1. Go to your application in Coolify
2. Click **"Terminal"** tab
3. This opens a shell inside your running container

### 2. Run Migrations

```bash
php migrate.php
```

This will create all database tables.

### 3. Run Seeders (Optional)

If you want initial data:

```bash
php seed.php --refresh
```

### 4. Verify Permissions

Check cache directories are writable:

```bash
ls -la app/cache
chmod -R 775 app/cache
chmod -R 775 app/cache/logs
```

---

## 🔍 Troubleshooting

### Error: `Class "App\Services\Router" not found`

**Cause:** Autoloader not generated correctly during build.

**Solution:**
1. Check deployment logs - do you see "SUCCESS: Router class found"?
2. If not, the build is failing. Check:
   - Are all files being copied correctly?
   - Is `composer.json` correct?
   - Are there any errors in the build logs?

**Fix if needed:**
1. Stop the application
2. Go to **Advanced** tab
3. Add to **Pre-deployment Command:**
   ```bash
   composer dump-autoload --optimize --no-dev
   ```
4. Redeploy

### Error: 404 Not Found on Routes

**Cause:** Apache `.htaccess` not working or routing not configured.

**Check:**
1. Verify `public/.htaccess` exists
2. Check Apache `mod_rewrite` is enabled (it is in Dockerfile)
3. Verify DocumentRoot is `/var/www/html/public`

**Fix:**
1. Check via Terminal:
   ```bash
   cat /etc/apache2/sites-available/000-default.conf
   ```
   Should show `DocumentRoot /var/www/html/public`

2. Restart Apache (if needed):
   ```bash
   service apache2 restart
   ```

### Database Connection Errors

**Check:**
1. Environment variables are set correctly
2. MySQL resource is running
3. Network connectivity between containers
4. Database credentials are correct

**Test connection via Terminal:**
```bash
php -r "
\$pdo = new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USER'), getenv('DB_PASSWORD'));
echo 'Connected successfully';
"
```

---

## 🗄️ Separate MySQL Resource Setup

Since MySQL is in a **separate resource**, you need to:

1. **Create MySQL service** in Coolify (separate from your app)
2. **Note the connection details:**
   - Host (might be a service name like `mysql-service` or an IP)
   - Port (usually `3306`)
   - Database name
   - Username
   - Password

3. **Use these details** in your application's environment variables

4. **Ensure network connectivity** - both services should be on the same network or Coolify should handle this automatically

---

## ✅ Verification Checklist

After deployment, verify:

- [ ] Build completes successfully with "Router class found"
- [ ] Application container is running
- [ ] Can access homepage (no 500 errors)
- [ ] Routes work (`/services`, `/posts`, etc.)
- [ ] Database connection works (after running migrations)
- [ ] Cache directories are writable
- [ ] Logs are being written

---

## 📚 Files Used

- **Dockerfile** - Production Dockerfile (PHP 8.1 + Apache)
- **composer.json** - PSR-4 autoloading configuration
- **public/index.php** - Application entry point
- **app/routes/web.php** - Main routing file

---

## 🎉 Success!

Once everything is deployed:
- Your app will be running on the domain you configured
- MySQL is separate (manage via Coolify MySQL resource)
- Migrations/seeding done manually via Terminal
- All paths are dynamic (no hardcoded values)
- PSR-4 compliant autoloading

---

## 📞 Quick Reference

**Coolify Settings:**
- Build Pack: `Dockerfile`
- Port: `80`
- Branch: `master`
- Pre/Post deployment: EMPTY

**Manual Commands (after deployment):**
```bash
# In Coolify Terminal
php migrate.php          # Create tables
php seed.php --refresh   # Seed initial data (optional)
```

**Environment Variables (required):**
```
DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD
APP_DEBUG=false
APP_URL=https://your-domain.com
```

