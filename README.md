<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating single page apps with Restful web services.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands
      config/             contains application configurations
      controllers/        contains web controller classes
      docker/             contains docker volumes
      mail/               contains view files for e-mails
      migrations/         contains migration classes
      models/             contains model classes
      modules/            comtains module directories
      npm/                contains package.json 
      runtime/            contains files generated during runtime
      tests/              contains codeception configuration and tests
      themes/             contains module view files
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      widgets/            conatins widgets


INSTALLATION
------------

### Install with Docker

Update your vendor packages

```
docker-compose run --rm php composer update --prefer-dist
```
    
Run the installation triggers (creating cookie validation code)

```
docker-compose run --rm php composer install  
```
    
Start the container

```
docker-compose up -d
```
    
You can then access the application through the following URL:

    http://127.0.0.1:8080

 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` and `config/test-db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### Mailer

Edit the file `config/mail.php` with real data, for example:

```php
return [
    'class' => 'yii\swiftmailer\Mailer',
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.gmail.com',
        'username' => 'yii2-boilerplate-app.com',
        'password' => 'password',
        'port' => '465',
        'encryption' => 'ssl',
    ],
    'messageConfig' => [
        'from' => ['info@yii2-boilerplate-app.com' => 'yii2-boilerplate-app.com'],
        'charset' => 'UTF-8',
    ]
];
```

### JWT

Edit the file `config/jwt.php` with real data, for example:

```php
return [
    'class' => 'sizeg\jwt\Jwt',
    'key' => 'generate-secret-signing-key'
];
```

Yii Commands
------------

(database migrations, type definitions and fixture data)

```
# Open shell for php container (replace <container-id> with php conatiner id)
docker exec -it <container-id> bash

```

```
# Run docker.sh from /app/ directory
cd /app/
./docker.sh
```

Javascript and Stylesheets
--------------------------

### Install

```
cd npm/

npm install

```

### Build production

```
# Run once to create lib files
npm run gulp prod

```

### Build development

```
# Creates js source maps
npm run gulp dev

```

### Watch files

```
npm run gulp watch
```

TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 4 test suites:

- `unit`
- `functional`
- `api`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```


### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run -- --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit -- --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit -- --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.
