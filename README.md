# Cinema API
Example API REST for cinema, developed in Laravel
### Required tools
 - PHP >= 7.3
 - Composer
 - MySql
 ### Setup 
 1. Clone repository `git clone https://github.com/agus757/cinema-api`
 2. Go to project folder `cd cinema-api` 
 3. Install dependencies `composer install`
 4. Create local environment file `cp .env .env.example`
 5.  Generate application key `php artisan key:generate`
 6. Fill `DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD` 
 7. Create `cinema and cinema_api` databases
 8. Create tables `php artisan migrate`
 9. Seed with random data `php artisan db:seed --class=MovieSeeder`

### Let's get started
We have all done, now it's time to serve the application, run the following command to do it on local environment 

    php artisan serve
