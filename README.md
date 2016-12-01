# VDM App

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![License](https://img.shields.io/packagist/l/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A VDM app with [CakePHP](http://cakephp.org) 3.x.

---

## Installation

- git clone https://github.com/Toinane/vdm_app.git
- cd vdm_app
- composer install

### Create data.json
the data.json is your database of all VDM.
By default, the PHP script will get 200 VDM. You can change this number into plugins/VDM/saveVDM.php.

To create the data.json, use this command :
> php plugins/VDM/saveVDM.php
