# LexyHands - Massage Therapy Website

A modern PHP web application for a massage therapy business, built with a custom MVC architecture and Docker containerization.

## 🏗️ Project Structure

```
lexyhands/
├── app/                          # Application Core (MVC Architecture)
│   ├── config/                   # Configuration files
│   │   ├── Database.php         # Database configuration
│   │   └── Global.php           # Global constants and settings
│   ├── controllers/              # Controllers (MVC - Controller Layer)
│   │   ├── AuthController.php   # Authentication handling
│   │   ├── PostsController.php  # Blog posts management
│   │   ├── ServicesController.php # Services management
│   │   ├── HomeController.php   # Homepage controller
│   │   └── ...                  # Other controllers
│   ├── models/                   # Models (MVC - Model Layer)
│   │   ├── users.php            # User model
│   │   ├── posts.php            # Posts model
│   │   ├── services.php         # Services model
│   │   ├── products.php         # Products model
│   │   └── ...                  # Other models
│   ├── services/                 # Business Logic Services
│   │   ├── Router.php           # URL routing
│   │   ├── Layout.php           # View rendering
│   │   ├── SqlEasy.php          # Database operations
│   │   ├── Migration.php        # Database migrations
│   │   ├── Seeder.php           # Database seeding
│   │   └── ...                  # Other services
│   ├── helpers/                  # Helper functions
│   │   ├── models/              # Model helpers
│   │   ├── services/            # Service helpers
│   │   └── general/             # General helpers
│   ├── Middlewares/             # Request middlewares
│   └── routes/                  # Route definitions
│       ├── web.php              # Main routes
│       ├── public.php           # Public routes
│       └── private.php          # Admin routes
├── public/                       # Public Web Directory
│   ├── index.php                # Application entry point
│   ├── assets/                   # Static assets
│   │   ├── css/                 # Stylesheets
│   │   ├── js/                  # JavaScript files
│   │   └── images/              # Images
│   ├── default/                  # Default assets (jQuery, Bootstrap, etc.)
│   └── views/                    # Views (MVC - View Layer)
│       ├── home/                # Homepage views
│       ├── posts/                # Blog post views
│       ├── services/             # Services views
│       ├── login/                # Login views
│       └── 404.php               # Error page
├── private/                      # Admin Panel
│   ├── assets/                   # Admin assets
│   └── views/                    # Admin views
├── resources/                     # Shared Resources
│   └── components/               # Reusable components
│       ├── public/               # Public components
│       └── private/              # Admin components
├── database/                      # Database Management
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── docker/                       # Docker Configuration
│   ├── apache/                   # Apache configuration
│   └── nginx/                    # Nginx configuration
├── vendor/                       # Composer dependencies
├── Dockerfile                    # Docker image definition
├── docker-compose.yml            # Development environment
├── docker-compose.prod.yml       # Production environment
├── composer.json                 # PHP dependencies
├── migrate.php                   # Migration runner
├── seed.php                      # Seeder runner
└── README.md                     # This file
```

## 🎯 MVC Architecture

### Model Layer (`app/models/`)
- **Purpose**: Data access and business logic
- **Files**: `users.php`, `posts.php`, `services.php`, `products.php`, etc.
- **Responsibilities**:
  - Database operations (CRUD)
  - Data validation
  - Business logic implementation
  - Extends `ModelHelper` for common database operations

### View Layer (`public/views/` & `private/views/`)
- **Purpose**: User interface presentation
- **Structure**:
  - `public/views/`: Frontend views (homepage, blog, services)
  - `private/views/`: Admin panel views
- **Responsibilities**:
  - HTML/CSS presentation
  - User interaction
  - Data display

### Controller Layer (`app/controllers/`)
- **Purpose**: Request handling and coordination
- **Files**: `PostsController.php`, `ServicesController.php`, `HomeController.php`, etc.
- **Responsibilities**:
  - Handle HTTP requests
  - Coordinate between Models and Views
  - Business logic orchestration
  - Extends `ControllerHelper` for common functionality

## 🗄️ Database Structure

### Core Tables
- **users**: User accounts (admin, editor, customer)
- **roles**: User roles and permissions
- **posts**: Blog posts and articles
- **posts_comments**: Post comments
- **posts_categorys**: Post categories
- **services**: Massage services offered
- **services_faq**: Service FAQ items
- **products**: Products/packages
- **product_prices**: Product pricing
- **currencies**: Currency management
- **settings**: Site configuration
- **gallery**: Image gallery

### Key Relationships
- Users → Posts (author_id)
- Users → Comments (user_id)
- Posts → Categories (category)
- Posts → Comments (post_id)
- Services → FAQ (service_id)
- Products → Prices (product_id)

## 🌱 Database Management

### Migrations (`database/migrations/`)
Database schema versioning and updates:

**Using Docker (recommended)**:
```bash
docker-compose exec app php migrate.php
```

**Manual command (without Docker)**:
```bash
php migrate.php
```

**Requirements for manual execution**:
- PHP 8.1+ installed locally
- Database credentials configured in `app/config/Database.php`
- Database server running and accessible

### Seeders (`database/seeders/`)
Populate database with initial data:

**Using Docker (recommended)**:
```bash
docker-compose exec app php seed.php
```

**Manual command (without Docker)**:
```bash
php seed.php
```

**Requirements for manual execution**:
- PHP 8.1+ installed locally
- Database credentials configured in `app/config/Database.php`
- Migrations must be run first
- Database server running and accessible

**Seeded Data Includes**:
- **Users**: Admin (ADM001) and Editor (EDT001) accounts
- **Posts**: 4 sample blog posts with proper author relationships
- **Comments**: Sample comments with user associations
- **Services**: Massage services with FAQ
- **Products**: Service packages with pricing
- **Currencies**: EUR (default), USD, GBP
- **Settings**: Site configuration

## 🚀 Getting Started

### Prerequisites
- Docker and Docker Compose
- Git

### Quick Start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd lexyhands
   ```

2. **Copy environment file**
   ```bash
   cp env.example .env
   ```
   > Note: For Docker, the application uses environment variables from `docker-compose.yml`. The `.env` file is optional but recommended for local development.

3. **Start the application**
   ```bash
   docker-compose up -d
   ```
   
   **Wait for MySQL to be ready** (important):
   ```bash
   # Wait 10-15 seconds for MySQL to fully initialize
   sleep 15
   # Or check MySQL is ready:
   docker-compose exec mysql mysqladmin ping -h localhost -u lexyhands -plexyhands123
   ```

4. **Run database migrations**

   **Using Docker** (recommended):
   ```bash
   docker-compose exec app php migrate.php
   ```
   > Note: Make sure MySQL container is fully started (wait 10-15 seconds after `docker-compose up`)
   
   **Manual (without Docker)**:
   ```bash
   php migrate.php
   ```

5. **Seed the database**

   **Using Docker** (recommended):
   ```bash
   docker-compose exec app php seed.php
   ```
   
   **Manual (without Docker)**:
   ```bash
   php seed.php
   ```

6. **Verify everything is working**
   - Check containers are running:
     ```bash
     docker-compose ps
     ```
   - Check application logs:
     ```bash
     docker-compose logs app | tail -20
     ```

7. **Access the application**
   - **Website**: http://localhost:8080
   - **Admin Panel**: http://localhost:8080/admin/dashboard
   - **phpMyAdmin**: http://localhost:8081

### Default Credentials
- **Admin**: admin@lexyhands.com / admin123
- **Editor**: editor@lexyhands.com / editor123

### Stopping the Application

**Stop containers (keeps data)**:
```bash
docker-compose stop
```

**Stop and remove containers (keeps volumes/data)**:
```bash
docker-compose down
```

**Stop and remove containers + volumes (⚠️ deletes database data)**:
```bash
docker-compose down -v
```

**Restart containers**:
```bash
docker-compose restart
```

**View running containers**:
```bash
docker-compose ps
```

**View logs**:
```bash
# View all logs
docker-compose logs -f

# View logs for specific service
docker-compose logs -f app
docker-compose logs -f db
```

## 🐳 Docker Configuration

### Development Environment (`docker-compose.yml`)
- **PHP Application**: Apache + PHP 8.1
- **Database**: MySQL 8.0
- **phpMyAdmin**: Database management
- **Ports**: 8080 (web), 8081 (phpMyAdmin), 3306 (MySQL)

### File Synchronization
O projeto está configurado com **volume bind mount** que sincroniza automaticamente os arquivos entre o container Docker e o host:

- **Arquivos criados/modificados no container** → Automaticamente refletidos no host
- **Arquivos criados/modificados no host** → Automaticamente disponíveis no container
- **Sincronização em tempo real** - Não é necessário usar `docker-compose exec`

**Diretórios sincronizados**:
- Todo o diretório do projeto (`.`) está montado em `/var/www/html` no container
- Logs, cache, uploads e todos os arquivos da aplicação são sincronizados automaticamente

**Exemplo prático**:
- Criar um arquivo no container: `echo "test" > /var/www/html/test.txt`
- O arquivo aparecerá imediatamente em `./test.txt` no host
- Criar um arquivo no host: `echo "test" > test.txt`
- O arquivo estará imediatamente disponível em `/var/www/html/test.txt` no container

### Production Environment (`docker-compose.prod.yml`)
- **Web Server**: Nginx reverse proxy
- **PHP Application**: PHP-FPM
- **Database**: MySQL 8.0
- **SSL**: Ready for HTTPS configuration

## 🛠️ Development

### Key Services

#### Router (`app/services/Router.php`)
- URL routing and request handling
- Supports RESTful routes
- Middleware integration

#### Layout (`app/services/Layout.php`)
- View rendering system
- Template management
- Asset loading

#### SqlEasy (`app/services/SqlEasy.php`)
- Database abstraction layer
- Query caching
- CRUD operations

#### Migration (`app/services/Migration.php`)
- Database schema management
- Version control
- Rollback support

#### Seeder (`app/services/Seeder.php`)
- Database population
- Sample data generation
- Relationship management

### Adding New Features

1. **Create Model** (`app/models/`)
2. **Create Controller** (`app/controllers/`)
3. **Create Views** (`public/views/` or `private/views/`)
4. **Add Routes** (`app/routes/`)
5. **Create Migration** (`database/migrations/`)
6. **Update Seeder** (`database/seeders/`)

## 📁 Key Directories

### `app/` - Application Core
- MVC architecture implementation
- Business logic
- Configuration

### `public/` - Web Root
- Entry point (`index.php`)
- Static assets
- Frontend views

### `private/` - Admin Panel
- Admin interface
- Management tools
- Protected views

### `resources/` - Shared Components
- Reusable UI components
- Layout templates
- Common elements

### `database/` - Data Management
- Schema migrations
- Data seeders
- Database initialization

## 🔧 Configuration

### Environment Variables
- Copy `env.example` to `.env`
- Configure database credentials
- Set application settings

### Database Configuration
- Edit `app/config/Database.php`
- Update connection parameters
- Configure caching settings

## 📝 Features

### Frontend
- **Homepage**: Service showcase and information
- **Blog**: Article system with categories and tags
- **Services**: Detailed service descriptions
- **Contact**: Contact information and forms
- **Responsive Design**: Mobile-friendly interface

### Admin Panel
- **Dashboard**: Overview and statistics
- **Posts Management**: Create, edit, delete blog posts
- **Services Management**: Manage service offerings
- **Products Management**: Handle products and pricing
- **Settings**: Site configuration
- **User Management**: Admin and editor accounts

### Technical Features
- **MVC Architecture**: Clean separation of concerns
- **Database Migrations**: Version-controlled schema
- **Caching System**: Performance optimization
- **User Authentication**: Secure admin access
- **SEO Friendly**: Meta tags and URL structure
- **Docker Ready**: Easy deployment and development

## 🚀 Deployment

### Development
```bash
docker-compose up -d
```

### Production
```bash
docker-compose -f docker-compose.prod.yml up -d
```

## 📊 Logging and Monitoring

### Access Logs
The application automatically logs all HTTP requests when `APP_DEBUG=true`:

**Log Location**: `app/cache/logs/`
- **Access Logs**: `access-YYYY-MM-DD.log` - All HTTP requests
- **Error Logs**: `error-YYYY-MM-DD.log` - PHP errors and exceptions

**Logged Information**:
- Timestamp
- HTTP Method (GET, POST, etc.)
- Request URI
- HTTP Status Code (200, 404, 500)
- Client IP Address
- User Agent
- Referer
- Execution Time
- Memory Usage
- Errors (if any)

### View Logs

**Command Line** (recommended):
```bash
# View access logs (last 50 entries)
docker-compose exec app php view_logs.php access 50

# View error logs (last 50 entries)
docker-compose exec app php view_logs.php error 50

# View more entries
docker-compose exec app php view_logs.php access 100
```

**Direct File Access**:
```bash
# View today's access log
docker-compose exec app tail -f app/cache/logs/access-$(date +%Y-%m-%d).log

# View today's error log
docker-compose exec app tail -f app/cache/logs/error-$(date +%Y-%m-%d).log
```

### Log Format
Logs are stored in JSON format for easy parsing:
```json
{
  "timestamp": "2025-10-29 12:30:45",
  "method": "GET",
  "uri": "/posts/massagem-terapeutica",
  "status": 200,
  "ip": "192.168.1.1",
  "user_agent": "Mozilla/5.0...",
  "referer": "https://example.com",
  "execution_time": "45.23ms",
  "memory_usage": "2.5 MB",
  "peak_memory": "3.1 MB"
}
```

### Automatic Error Logging
The system automatically logs:
- **PHP Errors**: Warnings, notices, and errors
- **Exceptions**: Uncaught exceptions with stack traces
- **Fatal Errors**: Critical PHP errors
- **404 Errors**: Route not found
- **500 Errors**: Server errors

### Log Rotation
Logs are automatically organized by date (one file per day). Old logs can be cleaned up manually or using the Logger's `clearOldLogs()` method.

## 📞 Support

For questions or issues:
- Check the code documentation
- Review the database structure
- Examine the MVC implementation
- Test with the provided seed data
- Check application logs in `app/cache/logs/`

---

**LexyHands** - Professional Massage Therapy Website
Built with PHP, MySQL, and Docker
