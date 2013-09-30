# Joomla CLI Application

This is distribution of the [Joomla Framework](http://github.com/joomla/joomla-framework) for you to use as a skeleton for command-line applications (CLI's).

## 1. Installation

You have two options to install the **Joomla CLI Application**.

### Use Composer (recommended)

The Joomla Framework uses [Composer](http://getcomposer.org) to manage dependencies. The easiest way to install the **Joomla CLI Application** base is to create a project for you.

If you don't have Composer, follow the installation instructions on the [http://getcomposer.org](http://getcomposer.org) site.

Then, use the `create-project` command to download and prepare your command-line application:

```bash
$ php composer.phar create-project -s dev theartofjoomla/joomla-cli-application path/to/install
```

Composer will install the project under the `path/to/install` folder and automatically download all the dependencies into the `path/to/install/vendor` folder.

## 2. Configuring the application

The application comes with based configuration support so copy or rename the `/etc/config.dist.json` file to `/etc/config.json`.

## 3. Testing the application

The _executable_ file is `/bin/run.php`.

```bash
$ php bin/run.php
[2013-09-30 14:28:35] Acme.DEBUG: It works! [] []
$
```

## 4. Extending the application

1. Rename the "Acme" string and `/src/Acme` to the name of your application.
2. Add more packages and dependencies by modifying `/composer.json`.

## 5. Features

* JSON configuration file support (`/etc/config.json`).
* Monolog logging to STDOUT.
* Exception tracing.

## 6. More help

Browse the tutorials on building a command line application at [Learn the Art of Joomla - Framework Solutions](http://learn.theartofjoomla.com/framework-solutions.html).