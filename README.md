# VDM App

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![License](https://img.shields.io/packagist/l/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A VDM app with [CakePHP](http://cakephp.org) 3.x.

---

## Installation

1. git clone https://github.com/Toinane/vdm_app.git
2. cd vdm_app
3. composer install

### Hide the debug tool in CakePHP
> Go to config/app.php and set to false this : env('DEBUG', true)

### Create data.json
the data.json is your database of all VDM.
By default, the PHP script will get 200 VDM. You can change this number into plugins/VDM/saveVDM.php.

To create the data.json, use this command :
> php plugins/VDM/saveVDM.php

### Use the API
By default, the link access is
> vdm_app/api/posts

Params :
- from (optionnal) ­ Start date
- to (optionnal) ­ End date
- author (optionnal) ­ Author

Uses :  
- vdm_app/api/posts 
- vdm_app/api/posts?from=29-11-2016
- vdm_app/api/posts?from=29-11-2016&to=30-11-2016
- vdm_app/api/posts?author=Genius
- vdm_app/api/posts/{id}

#### warning
To use the API, you should first create the data.json before make your requests.


### Testing with PHPUnit
To test the API, you have to use
> vendor/bin/phpunit
> vendor\\bin\\phpunit on windows

The latest Units test :
> Time: 251 ms, Memory: 12.00MB
> OK (9 tests, 82 assertions)


 Have a great day :D
