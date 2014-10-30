<?php

/*
 *  AVAILABLE log levels
 *  debug, info, notice, warning, error, critical, alert, emergency
 *
 *  Its not advised to enable on debug as the log level because it can slow the pageload
 *
 */

return array(

    'log_level'         => (getenv('log_level') ?: 'error'),
    'dateformat'        => (getenv('dateformat') ?: 'H:i:s'),
    'channel_name'      => (getenv('channel_name') ?: 'livelogger'),
    'pusher_app_id'     => (getenv('pusher_app_id') ?: 'pusher_app_id'),
    'pusher_api_key'    => (getenv('pusher_api_key') ?: 'pusher_api_key'),
    'pusher_api_secret' => (getenv('pusher_api_secret') ?: 'pusher_api_secret'),
    'pusher_use_ssl'    => (getenv('pusher_use_ssl') ?: false),
);