<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'avatars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/users/avatars'),
            'url' => env('USER_AVATARS_URL'),
            'visibility' => 'public',
        ],

        'logos' => [
            'driver' => 'local',
            'root' => storage_path('app/public/projects/logos'),
            'url' => env('PROJECT_LOGOS_URL'),
            'visibility' => 'public',
        ],

        'banners' => [
            'driver' => 'local',
            'root' => storage_path('app/public/projects/banners'),
            'url' => env('PROJECT_BANNERS_URL'),
            'visibility' => 'public',
        ],

        'media' => [
            'driver' => 'local',
            'root' => storage_path('app/public/projects/media'),
            'url' => env('PROJECT_MEDIA_URL'),
            'visibility' => 'public',
        ],

        'releases' => [
            'driver' => 'local',
            'root' => storage_path('app/public/projects/releases'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
