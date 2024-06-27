## Event Reminder setup/installation guides
Please Follow the guideline to set up locally.

- Laravel 11 (php 8.3/8.2)

### Installation process after cloning from git

1. composer install
2. cp .env.example .env
3. set your desired timezone to send email before 30 minutes of an event `APP_TIMEZONE=Asia/Dhaka` in .env
4. set environment for sending mail (example: mail trap) in .env
5. php artisan key:generate
6. set database mysql and update related things in .env (for example your database name, password)
7. php artisan migrate
8. run this command for queue run `php artisan queue:work`
9. run this command for schedule work in local `php artisan schedule:work`
10. for import event data in csv I attached an example format in event-reminder directory `events.csv`
