GitHub Europe
=============

This project highlights GitHub usage in Europe. It was inspired from [codeafrica.org](http://codeafrica.org).
See the top ten GitHub users of every city dependent of the number of followers.

Methodology
-----------

The scripts use GitHub API's to search for all GitHub users who have a european country or city listed in their profile.
All european cities with a population count above 150.000 are queried (with small exceptions due to errors in the data).

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
* Add your username and password (in clear) to `config.php`
* Launch `./loadCities.php` to import cities into MongoDB
* Launch `./fetchUsers.php` to query GitHub users
* Launch `./generateGeoJSON.php` to generate a GeoJSON file

Finally open `index.html` in the browser of your choice.
