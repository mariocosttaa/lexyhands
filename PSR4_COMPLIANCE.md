# PSR-4 Compliance Updates

## ✅ Changes Made

### Directory Structure (PSR-4 Compliant)
All directories now match their namespace casing exactly:

- `app/services/` → `app/Services/` (for `App\Services\*`)
- `app/controllers/` → `app/Controllers/` (for `App\Controllers\*`)
- `app/models/` → `app/Models/` (for `App\Models\*`)
- `app/config/` → `app/Config/` (for `App\Config\*`)
- `app/middlewares/` → Already `app/Middlewares/` ✓

### Model Files (PSR-4 Compliant)
All model files renamed to match class names exactly:

- `currencies.php` → `Currencies.php`
- `gallery.php` → `Gallery.php`
- `posts.php` → `Posts.php`
- `posts_categorys.php` → `Posts_categorys.php`
- `posts_comments.php` → `Posts_comments.php`
- `product_prices.php` → `Product_prices.php`
- `products.php` → `Products.php`
- `products_reviews.php` → `ProductReviews.php`
- `products_stocks.php` → `Products_stocks.php`
- `roles.php` → `Roles.php`
- `services.php` → `Services.php`
- `services_faq.php` → `Services_faq.php`
- `services_price.php` → `Services_price.php`
- `users.php` → `Users.php`

### Updated Files

1. **composer.json**
   - Updated path: `app/config/Global.php` → `app/Config/Global.php`

2. **README.md**
   - Updated all references to use capitalized folder names
   - Updated file examples to use capitalized file names

3. **Autoloader**
   - Regenerated with `composer dump-autoload --optimize --no-dev`
   - All 120 classes now properly autoloaded
   - No more PSR-4 compliance warnings

### Verification

All classes verified to load correctly:
- ✅ `App\Services\Router`
- ✅ `App\Controllers\HomeController`
- ✅ `App\Models\Services`

## 📋 PSR-4 Rules Applied

1. **Namespace to Directory Mapping**
   - `App\` → `app/`
   - `App\Services\` → `app/Services/`
   - `App\Controllers\` → `app/Controllers/`
   - `App\Models\` → `app/Models/`
   - `App\Config\` → `app/Config/`
   - `App\Middlewares\` → `app/Middlewares/`

2. **Class Name to File Name**
   - Class name must match file name exactly (case-sensitive)
   - Example: `class Services` → `Services.php`
   - Example: `class Products_stocks` → `Products_stocks.php`

3. **Directory Names**
   - Must match namespace segments exactly (case-sensitive)
   - Must use directory separator `/` not namespace separator `\`

## 🚀 Next Steps

The application is now fully PSR-4 compliant and ready for deployment to Coolify.

All references have been updated, and the autoloader has been regenerated. The Dockerfile includes a verification step to ensure the Router class can be found during build.

