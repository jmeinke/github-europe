GitHub Europe
=============

Project to help highlight GitHub usage in Europe, this project was forked and inspired from [codeafrica.org](http://codeafrica.org).

Methodology
-----------

Using GitHub API's we search for all GitHub who have a european country or city listed in their profile.


Usage
-----
* Download and install the following prerequisites:
  * [PHP](http://php.net/)
  * [MongoDB](https://www.mongodb.org/)
  * [Composer](http://getcomposer.org)
* Execute the following code to install [php-github-api](https://github.com/KnpLabs/php-github-api):
```bash
$ php composer.phar install
```
or, if you have symlinked composer already, just
```bash
$ composer install
```
* Add your username and password (in clear) to `config.php`
* Launch `./fetchUsers.php` to populate the MongoDB collections
