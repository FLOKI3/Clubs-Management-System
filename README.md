<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# README: Setting up Laravel with Breeze, Tailwind CSS, Spatie Permissions, and Medialibrary

### Requirements
- PHP >= 8.3
- Composer
- MySQL or any other database
- Node.js & npm

### Steps to Download and Set Up the Project

### 1. Clone the Laravel Project
Run the following command in your terminal to clone the project repository:

```bash
git clone https://github.com/FLOKI3/Laravel.git
```

### 2. Install Composer Dependencies
After cloning the project, install the PHP dependencies using Composer:

```bash
composer install
```

### 3. Set Up Environment Variables
Create a `.env` file by copying `.env.example`:

```bash
cp .env.example .env
```

Then, generate the application key:

```bash
php artisan key:generate
```

Update your `.env` file with your database credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 4. Install Node Dependencies
Install the required JavaScript packages and build the frontend assets:

```bash
npm install
npm run build
```

### 5. Migrate the Database
Run the migrations to create tables in your database:

```bash
php artisan migrate
```

### 6. Install Breeze for Authentication
Ensure that Laravel Breeze is already installed. If not, follow the command below:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
```

### 7. Install Spatie Permissions
Ensure that the Spatie Permissions package is installed. If not, install it with:

```bash
composer require spatie/laravel-permission
```

After installing, publish the config file and migrate the tables for roles and permissions:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### 8. Set Up Role and Permission Functionality
- Make sure the role and permission system is properly integrated using the Spatie package.
- Refer to the `RoleController` and any relevant middleware you've set up to manage user roles and permissions.

### 9. Run Seeders

If you have seeders set up for initial data, you can run them with the following command:

```bash
php artisan db:seed
```


---

### Commands to Run
To ensure your project is running correctly, use the following commands:

1. **Serve the project locally:**
   ```bash
   php artisan serve
   ```

2. **Run the project in development mode:**
   ```bash
   npm run dev
   ```



