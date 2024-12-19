# FocusFlow - Laravel and Vue.js Project

This is the setup guide for the **FocusFlowAntiProcrastWebApp**, which combines **Laravel** for the backend and **Vue.js** for the frontend. And use Inertia.js as a routing library.

## Step-by-Step Setup Guide

### Step 1: Install XAMPP
1. Download and install **XAMPP** from [apachefriends.org](https://www.apachefriends.org/index.html).
2. Once installed, open the **XAMPP Control Panel** and start both **Apache** (web server) and **MySQL**

### Step 2: Set up the Database
1. Create a new database called `focusflow` in PhPMyAdmin.
2. Update the `.env` file in the **FocusFlowAntiProcrastWebApp** project with the following database settings:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=focusflow
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Install Composer

- Download and install **Composer** from https://getcomposer.org/doc/00-intro.md#globally
- Checked by `composer --version` in cmd

### Step 4: Install Node.js and NPM

- **Node.js** and **NPM** (Node Package Manager) is needed for Vue.js. Install them from [nodejs.org](https://nodejs.org/)
### Step 5: Setup for FocusFlowAntiProcrastWebApp

- cd FocusFlowAntiProcrastWebApp and then run those cmd
```
- composer install
- npm install
- copy .env.example .env
- php artisan key:generate
- php artisan migrate:fresh —seed
```


### Step 6: Running Laravel and Vue 

(required running at the same time)
- npm run dev
- php artisan serve

