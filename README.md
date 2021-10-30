
Installation of the project in local

After clonning the project from github do the follwoing
1)run composer install
2) create .env file copying .env.example file in the root directory and setup configuration for your own database and mail configurations.
3) do php artisan migrate
4) run the following command to generate the seeded data
 php artisan db:seed




