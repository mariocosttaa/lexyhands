# Coolify Setup - Step by Step Configuration

Based on your current Coolify interface, here are the exact changes you need to make:

## 1. Build Pack Selection

**Current:** ✓ Nixpacks (selected)
**Change to:** Select **"Dockerfile"**

This is the most important change! You need to select "Dockerfile" instead of "Nixpacks" to use your `Dockerfile.prod`.

## 2. Branch

**Current:** `main`
**Change to:** `master`

Your repository uses `master` branch, not `main`.

## 3. Base Directory

**Current:** `/`
**Keep as:** `/` ✅

This is correct - the Dockerfile works from the root directory.

## 4. Port Configuration

**Port Exposes:** `80` ✅ (correct)
**Port Mappings:** This will be handled automatically by Coolify

## 5. Pre/Post Deployment Commands

**Current Pre-deployment:** `php artisan migrate` ❌
**Change to:** `php migrate.php`

**Current Post-deployment:** `php artisan migrate` ❌  
**Change to:** (leave empty, or use `php migrate.php` if needed after deployment)

> **Note:** Your app uses `php migrate.php`, not Laravel's `php artisan migrate`

## 6. Dockerfile Name (when Build Pack = Dockerfile)

When you select "Dockerfile" as the build pack, Coolify looks for a file named `Dockerfile` in the root directory by default.

**Good news:** Your `Dockerfile` is already production-ready and matches `Dockerfile.prod` (both are optimized). So you can use either:

- **Option A:** Use the default `Dockerfile` (recommended - simpler)
- **Option B:** If Coolify has an "Advanced" setting that allows specifying a custom Dockerfile path, you can use `Dockerfile.prod`

**Note:** Both files are essentially the same and optimized for production. The `Dockerfile` will work perfectly with Coolify.

## 7. Publish Directory

**Current:** `/`
**Should be:** `/` or leave empty

Since Apache serves from `/var/www/html/public` inside the container (configured in Dockerfile.prod), you don't need to set a publish directory.

## 8. Environment Variables

Make sure these are set in the "Environment Variables" tab:

```env
DB_HOST=your-mysql-host
DB_PORT=3306
DB_NAME=lexyhands
DB_USER=your-database-user
DB_PASSWORD=your-secure-password
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_ENV=production
```

## Summary of Changes Needed:

1. ✅ **Build Pack:** Change from "Nixpacks" to **"Dockerfile"**
2. ✅ **Branch:** Change from "main" to **"master"**
3. ✅ **Pre-deployment:** Change from `php artisan migrate` to **`php migrate.php`**
4. ✅ **Post-deployment:** Change from `php artisan migrate` to **(empty or `php migrate.php`)**
5. ✅ **Dockerfile:** Specify `Dockerfile.prod` (if the option appears)

## After Making These Changes:

1. Click **"Save"** in the General configuration
2. Click **"▷ Deploy"** button to start the deployment
3. Monitor the deployment logs to ensure everything builds correctly
4. After successful deployment, run migrations via the Terminal tab if needed:
   ```bash
   php migrate.php
   ```

