CONFIG DB
RUN php artisan migrate
RUN php -S localhost:8000 -t public