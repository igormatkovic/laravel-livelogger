#Laravel LiveLogger
==================================================

Simple way to display live logs on a custom dashboard.

The idea behind this was to have a TV on the office wall to display the data. And in a future release to send out a sound if there is a error or similar.

This app uses Pusher.com to send the data. There will be a Websocket version also but since Pusher's free account allows up to 100k messages a day im not sure anybody is going to use it.

##Composer

```js
    "require": {
		"igormatkovic/laravel-livelogger": "~1.0"
    }
```
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

    'log_level'         => (getenv('log_level') ?: 'error'),
    'dateformat'        => (getenv('dateformat') ?: 'H:i:s'),
    'channel_name'      => (getenv('channel_name') ?: 'livelogger'),
    'pusher_app_id'     => (getenv('pusher_app_id') ?: 'pusher_app_id'),
    'pusher_api_key'    => (getenv('pusher_api_key') ?: 'pusher_api_key'),
    'pusher_api_secret' => (getenv('pusher_api_secret') ?: 'pusher_api_secret'),
    'pusher_use_ssl'    => (getenv('pusher_use_ssl') ?: false),
);
```
Or you can just insert the data in your .env.php to keep it out of GIT


Once you have added your data, just generate the livelogger dash html
```bash
    php artisan livelogger:generate
```



Then just open your $domain.com/livelogger.html to see whats getting logged

I would recommend using that URL as a iframe so you can put it in your custom dashboard.

But you can just integrate it directly into your own view:



```html
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript">

    var pusher = new Pusher('{{ $pusher_api_key }}');
    var channel = pusher.subscribe('{{ $chanel_name }}');
    channel.bind('log', function(data) {
        $('#notify-messages').prepend('<li class="message level_'+data.level+'">['+data.date+'] '+data.message+'</li>');
    });
</script>
```

Don't forget to set your chanel_name and pusher_api_key


Keep in mind. The more log pushes you have the slower the site is going to be! 

This app is for more critical parts of the app.


###TO DO
*   Unit tests.
*   Sound for critical events.
*   Secure the URL with a token or something.
*   Design a better output interface, this one sucks.





