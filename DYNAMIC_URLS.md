# Dynamic URL Configuration

## Overview
The application now uses dynamic URL generation instead of hardcoded paths. This makes it deployment-ready for any environment.

## Environment Variables

### Required
```env
APP_URL=https://yourdomain.com
```

### Optional (Auto-detected if not set)
- The application will auto-detect the base URL from the server environment
- Works with subdirectories automatically
- Supports both HTTP and HTTPS

## URL Helper Functions

### Available Functions
```php
// Get base URL
$baseUrl = getBaseUrl();

// Generate full URL
$url = url('/services'); // https://yourdomain.com/services

// Generate asset URL
$assetUrl = asset('images/logo.png'); // https://yourdomain.com/assets/images/logo.png

// Check if current page is active
$isActive = isActive('/services');

// Get current URL
$current = currentUrl();

// Redirect
redirect('/services');
```

## Migration from Hardcoded URLs

### Before
```php
<a href="/projects/lexyhands/services">Services</a>
<img src="/assets/images/logo.png" alt="">
```

### After
```php
<a href="<?php echo url('/services') ?>">Services</a>
<img src="<?php echo asset('images/logo.png') ?>" alt="">
```

## Deployment

### Local Development
```env
APP_URL=http://localhost:8080
```

### Production
```env
APP_URL=https://yourdomain.com
```

### Subdirectory Deployment
```env
APP_URL=https://yourdomain.com/subfolder
```

## Benefits

1. **Deployment Ready**: Works in any environment without code changes
2. **Subdirectory Support**: Automatically handles subdirectory deployments
3. **Protocol Detection**: Automatically uses HTTP/HTTPS based on server config
4. **Maintainable**: Single source of truth for URL generation
5. **SEO Friendly**: Consistent URL structure across environments

## Files Updated

- `app/helpers/general/urlHelper.php` - New URL helper functions
- `composer.json` - Added URL helper to autoload
- All view files - Updated to use dynamic URLs
- Controllers - Updated file upload paths
- Environment files - Simplified to only use APP_URL
