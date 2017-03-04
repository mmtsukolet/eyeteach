<?php

return 'disks' => [
    'local' => [
        'driver' => 'local',
        'root'   => storage_path(),
    ],
    'uploads' => [
        'driver' => 'local',
        'root'   => public_path() . '/uploads',
    ],
];