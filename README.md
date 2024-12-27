<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1 align="center">Dashboard for Clubs Management</h1>

### Requirements
- PHP >= 8.3
- Composer
- MySQL or any other database
- Node.js & npm

<h2>Steps to Download and Set Up the Project</h2>

### 1. Clone the Laravel Project
Run the following command in your terminal to clone the project repository:

```bash
git clone --branch master https://github.com/FLOKI3/Laravel.git
```

After cloning, go into the project directory:
```bash
cd Laravel
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
Run the migrations to set up your database schema and seed the database:

```bash
php artisan migrate:fresh --seed
```

### 6. Start the Development Server
Finally, start the Laravel development server::

```bash
php artisan serve
```

### Accounts

- **Admin Account**  
  - **Email:** `admin@gmail.com`  
  - **Password:** `password`  
- **Manager Account**  
  - **Email:** `club@devaga.com`  
  - **Password:** `password`    
- **Coach Account**  
  - **Email:** `ahmed.bennani@gmail.com`  
  - **Password:** `password`  
  - **Email:** `hind.elmansouri@gmail.com`  
  - **Password:** `password`  
  - **Email:** `rachid.elfassi@gmail.com`  
  - **Password:** `password`  
  - **Email:** `karima.amrani@gmail.com`  
  - **Password:** `password`  
  - **Email:** `mohamed.alaoui@gmail.com`  
  - **Password:** `password`  
  - **Email:** `fatima.zahra@gmail.com`  
  - **Password:** `password`  
  - **Email:** `youssef.haddadi@gmail.com`  
  - **Password:** `password`  
  - **Email:** `salma.bouhriz@gmail.com`  
  - **Password:** `password`  
