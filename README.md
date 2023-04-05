# excuses-de-dev
application that sends excuses randomly according to a database created

1. use Symfony 5.4.19
2. DataBase: MySQL

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed
3. Check Symfony is installed

### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`
4. Run `yarn encore dev` to build assets

### Working

1. Run `symfony server:start` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets (or `yarn dev-server` do the same with Hot Module Reload activated)

### DataBase

1. You will therefore have to configure the connection to your database:

Locally on your development machine, this will happen in the .env.local file at the root of your project.
To do this, you must duplicate the .env file and copy it into your .env.local file that you will have created at the root

Attention, by default Symfony offers a preconfigured line for the PostgreSQL DBMS and not for MySQL.
We choose to stay on MySQL, you must instead use the commented line just above and starting with mysql, and remember to comment the line for PostgreSQL.

In your file .env.local
DATABASE_URL="mysql://your_username:your_pwd@127.0.0.1:3306/your_dbname?serverVersion=8.0"


2. Once that's done, all you have to do is check if everything is well "wired" by creating the database, using the command:

symfony console doctrine:database:create

3. Check that everything works by playing the fixtures with the command:

symfony console doctrine:fixtures:load

4. Wait a moment and visit http://localhost:8000
