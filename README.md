# Mikrotik External Captive Portal

The captive portal web server can be setup using the instructions given [here](https://gist.github.com/nasirhafeez/d47c9d68742227a23f1011455a190490).

The following actions are required to use the code given in this repo:
 
Rename the `.env.example` file to `.env` and set the values of the given project-wide environment variables in it.

Rename the `parameters.php.example` file to `parameters.php` and set the values of variables according to the current site.

*Install Composer*

Then run `php composer.phar install` to install the packages given in `composer.json`.
