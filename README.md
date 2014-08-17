#Laravel LiveLogger
==================================================

Simple way to display live logs on a custom dashboard.

The idea behind this was to have a TV on the office wall to display the data. And in a future release to send out a sound if there is a error or similar.

This app uses Pusher.com to send the data. There will be a Websocket version also but since Pusher's free account allows up to 100k messages a day im not sure anybody is going to use it.


##Setup

In app/config/app.php

Comment the Laravel Log Service provider

```php
    //'Illuminate\Log\LogServiceProvider',
```

And add this one:
```php
    'Igormatkovic\Livelogger\LiveloggerServiceProvider',
```


Also change the Log alias:

From: 
```php
    'Log'       => 'Illuminate\Support\Facades\Log',
```
To:
```php
    'Log'       => 'Igormatkovic\Livelogger\Facades\Livelogger'
```

From the command line publish and edit the config:

```bash
    php artisan config:publish igormatkovic/laravel-livelogger
```

And insert your app data from Pusher.com

```php
return array(

    'log_level'         => 'notice',
    'dateformat'        => 'H:i:s',
    'pusher_app_id'    => (getenv('pusher_app_id') ?: 'my_pusher_app_id'),
    'pusher_api_key'    => (getenv('pusher_api_key') ?: 'my_pusher_api_key'),
    'pusher_api_secret'    => (getenv('pusher_api_secret') ?: 'my_pusher_api_secret'),
    'pusher_use_ssl'    => false
);
```
Or you can just insert the data in your .env.php to keep it more secure


Notice: Dont set the log_level to debug. It can slow down the site!




