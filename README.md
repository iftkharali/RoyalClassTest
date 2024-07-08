- Composer install
- php artisan migrate
- php artisan db:seed
- php artisan passport:client --personal 


- Used passport for use auth and jwt token generation
- Added logic for single device login in the login controller
- used policy for the user permissions (Not fully implemented - continue)
- Add service and middleware for bad words filtration for each post (title and description) we can use the OBSERVERS or TRAIT as well for this functioanlity 