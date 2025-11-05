# Zexon zadanie - ping app
## Laravel - Inertia js - Vue 
Dockerized , running on sail 


How to run: 

## Requirements

- Docker Desktop
- Git

### 1. Clone repo
```bash
mkdir zexon-ping
git clone https://github.com/roboT-23/zexon-ping.git
cd zexon-ping
```

### 2. Install PHP dependencies, also sail
```bash
composer install
```

### 3. Copy environment file
```bash
cp .env.example .env
```
### 4. Start Docker containers
```bash
./vendor/bin/sail up -d
```

### 5. Generate application key
```bash
./vendor/bin/sail artisan key:generate
```

### 6. Run migrations
```bash
./vendor/bin/sail artisan migrate
```

### 7. Install Node dependencies
```bash
./vendor/bin/sail npm install
```

### 8. Start frontend
```bash
./vendor/bin/sail npm run dev
```

### If something is not loading properly
clear caches and configs
```bash
./vendor/bin/sail composer-dump-autoload
./vendor/bin/sail artisan optimize:clear
```

## Usage

Open: **http://localhost**

## Stop
```bash
./vendor/bin/sail down
```



-----

Structure:

Project has Home controller where we call for Ping.vue with form.

Then we send post with form to /api/ping , get the result OK or error
