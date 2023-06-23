# CONTENT

- [CONTENT](#content)
- [INTRODUCE](#introduce)
  - [Requirement of system](#requirement-of-system)
    - [Introduce system](#introduce-system)
      - [Constructor system directory](#constructor-system-directory)
      - [System preconfigured services](#system-preconfigured-services)
      - [System Commands](#system-commands)
      - [Email system catching all](#email-system-catching-all)
- [User Manual](#user-manual)
  - [Preconfig when user using MacOs from M1](#preconfig-when-user-using-macos-from-m1)
  - [Basic docker commands](#basic-docker-commands)
  - [System Manual](#system-manual)
  - [Start using](#start-using)
  - [Clear data](#clear-data)
  - [Some examples](#some-examples)
    - [Initialize and run nginx php73 mysql](#initialize-and-run-nginx-php73-mysql)
    - [Enable Xdebug for php73](#enable-xdebug-for-php73)
    - [Create database with name magento](#create-database-with-name-magento)
    - [Import backup file to database magento](#import-backup-file-to-database-magento)
    - [Export database named magento](#export-database-named-magento)
    - [Drop database with name magento](#drop-database-with-name-magento)
    - [Automatically download and install Magento](#automatically-download-and-install-magento)
    - [Enable SSL for domain](#enable-ssl-for-domain)
    - [Steps to clone magento project from git](#steps-to-clone-magento-project-from-git)
    - [Create data for develop or testing](#create-data-for-develop-or-testing)

# INTRODUCE

Combo docker-compose for Magento with features like:

* Running multiple versions of PHP at the same time, you don't need to create many different docker-compose stacks for many projects, but only need to use a single docker-compose stack.
* Automatically create Virtual host for nginx, support Magento 1, Magento 2, Laravel, Wordpress.
* SSL support
* Automatically download and install Magento fresh versions as required.
* Create /Drop/Import/Export database from command.
* Turn Xdebug on and off for each PHP version.
* Automatically add used domains to /etc/hosts.
* Email catch all local, avoid sending email to the internet (of course, still remember to check the SMTP config, don't leave the configuration of prod =)))
* Support nvm, grunt.
* The nginx log is stored separately in the logs/nginx directory

Currently only testing on Ubuntu, other operating systems please find out for yourself =).

## Requirement of system

* The system needs to have docker and docker-compose installed (docker-compose needs to install the latest version through the following instructions, note do not install docker-compose via python pip - this is the old version). Installation instructions can refer to Google or:

[Instructions for installing docker](https://docs.docker.com/engine/install/)

[Instructions for installing docker-compose on Ubuntu](https://docs.docker.com/compose/install/)

* After installing docker, remember to run this command to add a user on the machine you are running, so you can run docker without typing sudo, after typing, remember to logout and then login again:

```bash
sudo usermod -aG docker $USER
```

### Introduce system

```bash
> tree                                                                                                                                                   docker-magento -> master
.
├── README.md
├── build
│   ├── mailhog
│   │   └── Dockerfile
│   ├── nginx
│   │   ├── Dockerfile
│   │   └── conf
│   │       └── nginx.conf
│   ├── php70
│   │   └── Dockerfile
│   ├── php71
│   │   └── Dockerfile
│   ├── php72
│   │   └── Dockerfile
│   ├── php73
│   │   └── Dockerfile
│   └── php74
│       └── Dockerfile
├── conf
│   ├── nginx
│   │   ├── conf.d
│   │   ├── nginx.conf
│   │   └── ssl
│   └── php
│       ├── php70
│       │   ├── 10-opcache.ini
│       │   ├── magento.conf
│       │   └── php.ini
│       ├── php71
│       │   ├── 10-opcache.ini
│       │   ├── magento.conf
│       │   └── php.ini
│       ├── php72
│       │   ├── 10-opcache.ini
│       │   ├── magento.conf
│       │   └── php.ini
│       ├── php73
│       │   ├── 10-opcache.ini
│       │   ├── magento.conf
│       │   └── php.ini
│       └── php74
│           ├── 10-opcache.ini
│           ├── magento.conf
│           └── php.ini
├── data
├── databases
│   ├── export
│   └── import
├── docker-compose.yml
├── env-example
├── images
│   ├── cert.png
│   ├── cert02.png
│   └── cert03.png
├── logs
│   └── nginx
├── scripts
│   ├── create-vhost
│   ├── database
│   ├── fixowner
│   ├── init-magento
│   ├── list-services
│   ├── mysql
│   ├── setup-composer
│   ├── shell
│   ├── ssl
│   └── xdebug
└── sources
```
#### Constructor system directory

| Directory | Functions |
|---------|------|
| build | Contains files used in the process of building containers used for the system |
| conf | Contains config files for containers to be used during user use |
| data | Contains data for containers such as mysql, rabbitMQ |
| database | Folder used for import/export database functions |
| images | Image folder of this README.md, LOL |
| logs | Folder containing nginx log for easy monitoring outside the system |
| scripts | Folder contains functional commands used for the system |
| sources | Folder containing the source folders of the project websites |

#### System preconfigured services

* The system has pre-configured the following services:

| Service name | Explanation |
|--------------|------|
| nginx | service webserver nginx |
| php70 | service php version php 7.0 |
| php71 | service php version php 7.1 |
| php72 | service php version php 7.2 |
| php73 | service php version php 7.3 |
| php74-c2 | service php version php 7.4 using composer2|
| php74 | service php version php 7.4 |
| mysql | service mysql, default uses version 8.0 |
| mailhog | service email catch all |
| elasticsearch | service Elastiscsearch |
| kibana | service Kibana |
| redis | service Redis |
| rabbitMQ | service RabbitMQ |

#### System Commands
| Command | Effect |
|---------|--------------|
| create-vhost | Automatically create virtual host for nginx services for each magento type and php version |
| database | create/drop/import/export/list databases |
| fixowner | Command used to change the owner of the source code folder to the default that the system uses |
| init-magento | Command used to automatically download and install Magento on the system |
| list-services | Command used to list services that docker-compose has initialized and is running |
| mysql | Command used to interact with mysql shell in mysql container |
| setup-composer | Composer used to setup default auth.json for Magento's repo in case of need |
| shell | Command used to access php containers with the user used to run the website, not the root user |
| ssl | Command used to create Virtual host SSL for selected domains |
| xdebug | Command used to enable/disable xdebug of a selected php service |

#### Email system catching all

* The system can be further configured to use email catch all using Mailhog to be able to test mail locally without configuring SMTP with public information.
* By default, if you don't configure SMTP, all PHP services will send email through Mailhog, so when starting the system, you need to start the Mailhog service.
* In case Mailhog has been started, you can check the email sent through Mailhog by visiting the following link in your browser: [http://localhost:8025](http://localhost:8025)
* In case you want to configure SMTP to use Mailhog for Magento, you can use the following connection information:

| | |
|---|---|
| SMTP Server | mailhog |
| SMTP Port | 1025 |


# User Manual

## Preconfig when user using MacOs from M1

* Chip M1
* Update docker-compose file, add the platform argument
```
  ...
  mysql:
    platform: linux/x86_64
  ...
```
```
  ...
  mailhog:
    platform: linux/x86_64
  ...
```
* Update php*/Dockerfile files, add platform argument
```
FROM --platform=linux/x86_64 ubuntu:bionic
```

## Basic docker commands

* Using docker, you should also know some of the following basic commands:
```bash
# View information about running docker containers
docker-compose ps

# View resource information that containers are using
docker stats

# List all serials declared in the docker-compose.yml file
docker-compose ps --services

# List all servers declared in the docker-compose.yml file that are in running state
docker-compose ps --services --filter "status=running"

# Initialize all services (containers) declared in the file docker-compose.yml
docker-compose up -d

# Check the log of a certain container (besides php, nginx), for example, logs of elasticsearch
docker-compose log elasticsearch

# Initialize and run selected services (containers), not all services (containers) declared in docker-compose.yml - Example only initialize and run nginx, php72, mysql
docker-compose up -d nginx php72 mysql

# Stop and delete all created and running services (containers) declared in the docker-compose.yml file, including volumes (excluding files in the ./data/ directory)
docker-compose down --remove-orphans

# Turn off the running services (container) declared in the docker-compose.yml file - Turn off a little bit to reduce the weight of the machine and then restart it.
docker-compose stop

# Start initialized services (containers) declared in the docker-compose.yml file - services (containers) that are not initialized before will remain uninitialized and will not be started.
docker-compose start

# Restart running services (containers)
docker-compose restart

# Get into a service to run a command - Example of going into a php72 service container to run composer
docker-compose exec php72 bash

# Restart the php container after changing some value in php.ini, for example need to restart the php72 container
docker-compose restart php72
```
* Internal services can connect to each other through the name of the service. For example, you can enter Mysql host instead of localhost as mysql. Or connect to services elasticsearch, redis instead of localhost, to be elasticsearch and redis, the connection port is still the default port, etc.

## System Manual

* Clone this repo to a local folder
* Copy the file env-example to .env
* Change the necessary information if any in the .env file before running.

**Note:**
* All commands when running on the system need to run in the directory containing the docker-compose.yml file
* Source code website needs to be placed in a separate folder in the sources folder. It is recommended to create a directory like sources/domain.com and clone the sources code into this directory. Source code should be placed directly in the sources/domain.com/ directory, not in sources/domain.com/src, in case it's in sources/domain.com/src it should be noted in the nginx virtual host creation step.
* The commands used need to be called in the form ./scripts/ten_command. Example: ./scripts/xdebug enable --php-version=php72
* The commands have their own manual, you can see the instructions by typing command in the shell, for example:

```bash
user@local:~/docker-magento$./scripts/xdebug
Docker Xdebug tools
Version 1

./scripts/xdebug [OPT] [ARG]...

    Options:
        enable                    Enable Xdebug.
        disable                   Disable Xdebug.
        status                    List all Xdebug status.
    Args:
        --php-version             PHP version used for Xdebug (php70|php71|php72|php73|php74).
        -h, --help                Display this help and exit.

    Examples:
      Disable Xdebug for PHP 7.2
        ./scripts/xdebug disable --php-version=php72
      Enable Xdebug for PHP 7.3
        ./scripts/xdebug enable --php-version=php73


                ____  __  __    _    ____ _____ ___  ____   ____
               / ___||  \/  |  / \  |  _ \_   _/ _ \/ ___| / ___|
               \___ \| |\/| | / _ \ | |_) || || | | \___ \| |
                ___) | |  | |/ ___ \|  _ < | || |_| |___) | |___
               |____/|_|  |_/_/   \_\_| \_\|_| \___/|____/ \____|



################################################################################
```

## Start using

```bash
# Clone to 1 folder
git clone https://git02.smartosc.com/tuanlh/docker-magento.git ~/docker-mangento
# Go to folder
cd ~/docker-mangento
# Create file .env
cp env-example .env
# Edit .env file information if necessary
# Initialize the system as required, for example need to run nginx, php73, mysql, mailhog
docker-compose up -d nginx php73 mysql mailhog
# Initialize more services if needed, for example the system needs to run more elasticsearch, redis
docker-compose up -d redis elasticsearch
# List of running services
./scripts/list-services
```

## Clear data

In case you want to delete all data (because I'm too free, like to create a new one, lol), you need to delete the following folders:

- Folders containing source code in: ./data/
- The nginx config files in: ./conf/nginx/conf.d/
- Stop and delete containers as well as old docker volumes, to stop containers and delete containers/volumes you can run the command:
```bash
docker-compose down -v --remove-orphans
```

## Some examples

### Initialize and run nginx php73 mysql

```bash
docker-compose up -d nginx php73 mysql mailhog elasticsearch redis
```
### Enable Xdebug for php73

```bash
./scripts/xdebug enable --php-version=php73
```

* Note: To use Xdebug with PHP Storm, you need to configure more Map path in PHP Storm setting. The Absolute path onn the server section is the path of the website in the docker container:
![PHPSTORM XDEBUG](./images/xdebug-phpstorm-01.png "PHP Storm path map for Xdebug")

### Create database with name magento

```bash
./scripts/database create --database-name=magento
```

### Import backup file to database magento

* The backup file that needs to be imported should have a .sql name. Example: backup-test.sql
* The backup file that needs to be imported should be in the ./databases/import directory
```bash
./scripts/database import --source=backup-test.sql --target=yoyoyo
```
### Export database named magento
```bash
./scripts/database export --database-name=magento
```
### Drop database with name magento
```bash
./scripts/database drop --database-name=yoyoyo
```
### Automatically download and install Magento

* Automatically download and install Magento community version 2.3.4, use domain test.com, run with php7.2
```bash
./scripts/init-magento  --php-version=php72 --domain=test.com --mangeto-version=2.3.4 --magento-edition=community
```

### Enable SSL for domain

* Enable SSL for domain magento.test
* After turning on, need to edit mangeto's databse, the URL part should use https
```bash
./scripts/ssl --domain=test-magento.com
```

### Steps to clone magento project from git

* All commands to be executed need to be in the directory containing the docker-compose.yml file
* Select the domain to use for the project, for example magento-test.com, create a folder containing the source code
```bash
mkdir -p ./sources/magento-test.com
* Clone source code from git to the directory
```bash
git clone http://gitrepo.com ./sources/magento-test.com
```

* Create a database for the website, for example: magento_db
```bash
./scripts/database create --database-name=magento_db
```

* Copy the website's DB backup file to the ./databases/import directory or auto generate by command line
* Run command import DB, for example
```bash
./scripts/database import --source=backup-test.sql --target=magento_db
```

* Auto generate database
```bash
bin/magento setup:db-schema:upgrade
```

```bash
bin/magento setup:install --base-url=http://magento.test \
--backend-frontname=admin \
--db-host=magento-mysql-1 \
--db-name=magento \
--db-user=admin \
--db-password=admin \
--admin-firstname=admin \
--admin-lastname=admin \
--admin-email=info@sample.com \
--admin-user=admin \
--admin-password=admin@123 \
--language=en_US \
--currency=EUR \
--timezone=Europe/Amsterdam \
--use-rewrites=1 \
--elasticsearch-host=magento-elasticsearch-1 \
--elasticsearch-port=9200 
```

* Select the version of php to run. In case not initialized, initialize on the system for example php version to use is php7.3
```bash
docker-compose up -d php73
```

* Create Vhost for nginx container service
* Now the root dir instead of ./sources/magento-test.com will just need to name the source code folder in the ./sources/ directory as magento-test.com. In case Magento's source code is in ./sources/magento-test.com/src then --root-dir=magento-test.com/src
```bash
./scripts/create-vhost --domain=magento-test.com --app=magento2 --root-dir=magento-test.com --php-version=php73
```

* If you run Generate, skip this step
* Copy files env.php, config.php to the correct directory, edit db connection information. Is the mysql root password declared in the .env . file
```bash
                'host' => 'mysql',
                'dbname' => 'magento_db',
                'username' => 'root',
                'password' => 'root',
```

* Access to php73 container to run build commands
```bash
./scripts/shell php73
cd magento-test.com

```
### Create data for develop or testing
```
bin/magento setup:performance:generate-fixtures /home/public_html/magento.test/setup/performance-toolkit/profiles/ce/small.xml
```