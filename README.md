# Blogging System
Simple Blogging System.

# What did I use in this project?
+ Laravel 5.8
+ PHP 7.2
+ MariaDB 
+ Bootstrap 4
+ TinyMCE (Rich text editor)
+ Laravel Debugbar Package (Extermely helpful in debugging & tracking the application behind the scenes)

# How to install?
I will be using Nginx, MariaDB & PHP 7.2 on Ubuntu machine.

## Nginx Installation 
+ First make sure to keep the system up-to-date to do so execute this command `sudo apt-get update`
+ `sudo apt install nginx -y` 
+ Note: if you are using firewall you need to allow ports (80, 443)

## MariaDB Installation
+ `sudo apt install mariadb-server -y`
+ `mysql_secure_installation`
+ Move on with the process and make sure to enter a root password & reload all the privileges (Note: I do not recommended to use root user)

## PHP Installation
First let's add universe repositories to /etc/apt/sources.list
```
deb http://archive.ubuntu.com/ubuntu bionic main multiverse restricted universe
deb http://archive.ubuntu.com/ubuntu bionic-security main multiverse restricted universe
deb http://archive.ubuntu.com/ubuntu bionic-updates main multiverse restricted universe
```
+ `sudo apt install php7.2 php7.2-fpm php7.2-cgi php7.2-mysql php7.2-mbstring php7.2-xml php7.2 composer unzip` To install PHP
+ `sudo nano /etc/nginx/sites-available/YOUR.DOMAIN.COM` and add the following
```
server {
    listen 80;
    server_name --YOUR DOMAIN--;
    root --PUBLIC FOLDER PATH--;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
+ `sudo ln -s /etc/nginx/sites-available/YOUR.DOMAIN.COM /etc/nginx/sites-enabled/` to create symlink to enabled sites
+ `sudo unlink /etc/nginx/sites-enabled/default` to remove default link
+ `sudo nginx -t` test the whole config
+ `sudo systemctl reload nginx` to apply all changes

## Laravel Installation
+ `mysql -u root -p` Login to create the database
+ `CREATE DATABASE redic;`
+ `cd /var/www/html/`
+ `git clone https://github.com/crayon1337/Redic-Blogging.git` clone the repo
+ `cd Redic-Blogging` Navigate to the project
+ `composer install`
+ `cp .env.example .env` & edit the database credentials
+ `php artisan migrate`
+ `php artisan key:generate`
+ `sudo chgrp -R www-data storage bootstrap/cache` fix permissions
+ `sudo chmod -R ug+rwx storage bootstrap/cache` fix permissions
+ `sudo chmod -R 755 /var/www/html/first-project` fix permissions
+ `chmod -R o+w /var/www/html/first-project/storage/` fix permission
+ `php artisan optimize`

If you would like to deploy the application for production use you have to edit the APP_ENV in .env to be ``APP_ENV=production`` & ``APP_DEBUG=false``

## Create an Admin user
First you have to register a user using /login URL.
To add a post/category and modify users role you need to be an admin. Lets login to mysql
+ `mysql -u root -p` & enter root pw
+ `USE redic;`
+ `UPDATE users SET isAdmin = 1 WHERE email = 'YOUR EMAIL';`


## Useful linux softwares
+ `apt install htop` I really like to use this piece of software to monitor the server resources.

## Public Trello Board
I have used this ['board'](https://trello.com/b/S5arAs6y) during the development of this blogging system to organize and priotrize the Todos.

## Conclusion
So this is it. Now you should have a simple blogging system working completely fine. If you need any help building the project contact me =)
