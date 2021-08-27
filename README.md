# digital-harbor system

this digital-harbor system made by laravel framework as back end and used free only theme as front
### Step One

Clone the repository

    git clone git@github.com:coder0010/digital-harbor

or you can download it by the desktop application of github

https://github.com/coder0010/digital-harbor

Switch to the repo folder

    cd digital-harbor

### Step Two

Run This bash file **bashes/refresh.sh** at your terminal for prepare the project

Copy .env.local file and make the required configuration changes in the .env file

run this command to create main database

    php artisan server:setup   **This is the most important command for developer**

    then choose first one to create **database** and after it finished,

    choose second one to run **migrate_and_seed** and after it finished

### Step Three

    php artisan serve

You can now access the server at http://127.0.0.1:8000
