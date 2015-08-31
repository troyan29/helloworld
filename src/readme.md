# HiFramework
## Please don't use in production! Unstable version for only didactic purposes. Under Refactoring
### Easy coding

Very fast and simple:

```php
require 'vendor/autoload.php';

$hi = new Hi\Core\App();

$hi->get('/welcome/:name', function($name) {
    echo "Hello $name, welcome to HiFramework !";
});

$hi->run();
```

HiFramework is a lightweight PHP framework built to create stupid simple php applications.

  - Very Simple
  - MVC based
  - Beautiful routing system
  - Middlewares

**Hi Framework** Motto:

> A stupidly easy and lightweight PHP micro framework

This is a simple php framework still in development release, we're gonna design better software structure using PHP best practices and design patterns  

### Version
Alpha - 0.0.2

### Requirements

HiFramework needs few configurations to run properly

* PHP 5.3.0+ while using **Closures** anonymous functions.
* [Composer](http://getcomposer.org) Dependency manager for PHP.

### Installation

#### Download

How to install ? It's too easy!

Open your favorite Terminal and run this command:


```sh
$ git clone https://github.com/diegomariani/hiframework
$ composer install
```

Or download [here](https://github.com/diegomariani/HiFramework/tarball/master)

#### Configuration

You must be sure that the `.htaccess` file is well configured as
```.htaccess
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_URI} !^/assets$
RewriteRule ^(.*)$ index.php [NC,L]
```

### Documentation

View full documentation [Hi Framework Docs](http://hiframework.diegomariani.com/docs)

### Official website

Visit official [Hi Framework website](http://diegomariani.github.io/HiFramework)

### Coding Standards

This project is written respecting [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) Coding Standards

### Contribute 

Contribute to the project and getting grow togheter, fork and follow.

### Author

This project is maintaned by [Diego Mariani](http://diegomariani.com) PHP developer from Italy. Follow the author on Twitter to get latest updates on HiFramework - [@hidiegomariani](https://twitter.com/hidiegomariani).


License
----

MIT -
**Free Software, Hell Yeah!**

[PHP]:http://php.net/

