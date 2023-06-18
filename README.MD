## INFO:

### This is a simple Symfony6 form. 

## Installation


```bash

git clone git@github.com:erbalee/symfony6-form.git

cd symfony6-form

composer install

npm install

# Default  MySQL  -> DB: symfony with root user and without password.
# You can edit the DB connection in .env file. 
php bin/console doctrine:migrations:migrate

npm run build

symfony server:start


```
