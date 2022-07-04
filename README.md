# Population of USA

_Application that allows obtaining the population of the USA in recent years_

## 🚀 Getting Started

Just place the following line in your terminal to download the project:

```
git clone https://github.com/memuxit/focus-test-laravel.git
```

See **Deployment** for notes on how to deploy the project on a live system.


### 📋 Pre-requisites

To execute this project, it is necessary to have the following software installed:

```
Apache 2.4.54
MySQL 5.7.37
PHP 8.1.7
```

### 🔧 Installing

_It is assumed that you already have the prerequisites installed, so the installation of the tools and the configuration of the project for its correct operation are briefly explained._

##### Composer

The steps to install composer are different depending on the operating system, but the most appropriate is to visit the [official page](https://getcomposer.org/), download and install the tool, then check the installation by entering the console and running:

```
composer --version

In my case, executing the previous command returns me the following output:

Composer version 2.3.7 2022-06-06 16:43:28
```

In your case it may be different version.

##### Node

The steps to install node are different depending on the operating system, but the most appropriate is to visit the [official page](https://nodejs.org/), download and install the tool, then check the installation by entering the console and running:

```
node --version

In my case, executing the previous command returns me the following output:

v16.15.0
```

```
npm --version

In my case, executing the previous command returns me the following output:

8.10.0
```

In your case it may be different version.

##### Installing PHP dependencies

Once the tools are installed, and the project has been downloaded, we enter the root of it, and execute the following command, which installs all the necessary dependencies for the correct operation of the project:

```
composer install
```

##### Installing NPM dependencies

Once the tools are installed, and the project has been downloaded, we enter the root of it, and execute the following command, which installs all the necessary dependencies for the correct operation of the project:

```
npm install
```

_With the above, we already have the dependencies installed, only some configurations are needed._

##### Configuring application

We create a file called .ENV at the root of the project, we visit [this site](https://github.com/laravel/laravel/blob/9.x/.env.example) and we can see the basic configuration, so just copy and paste that information and adapt it to our need.

It is important to emphasize that certain values have been used for the application to work correctly with HTTP requests and websockets, so I share that information so that it can be added and/or updated to the .ENV file.

```
POPULATION_URL=https://datausa.io/api/data
GUZZLE_TIMEOUT=5
CACHE_LIFETIME=120
VITE_CHANNEL=population
VITE_EVENT=population-updated

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=1432032
PUSHER_APP_KEY=15e39392bfa18eeefd67
PUSHER_APP_SECRET=00798034f8e4cde34d71
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=us2
```

## 📦 Execution

- The first thing is that we must have installed the prerequisites, tools, dependencies and configured the application.
- Then we must create a database, in the repository a script for its creation is attached in case you want to use it.
- Next we must execute the respective migrations, we do that with the command:
```
php artisan migrate
```
- Now we can run the laravel command to get the population of USA:
```
php artisan population:get
```
- We must compile the assets to have the styles and scripts functional, for this we execute the following command:
```
npm run build
``` 
- We can run the application locally to see the results of that information using the following command:
```
php artisan serve
```
- With the previous command we can access the application through the following link: [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

***Important:*** *The application has a button in case you need to refresh the information, in addition to that, every time the command is executed to obtain the population, the application will be automatically updated through websockets*

## ⚒️ Built With

* [Laravel](https://laravel.com/) - Web framework used
* [Composer](https://getcomposer.org/) - PHP dependency manager
* [Node](https://nodejs.org/) - JavaScript execution environment

## Authors ✒️

* **Guillermo Rafael Vasquez Castaneda** - *Project developer* - [MeMuXiT](https://github.com/memuxit)
