<?php

return [
    "secret_key"    => env("MONO_SECRET_KEY"),
    "url"           => env("MONO_URL", 'https://api.withmono.com'),

    "route" => [
        "middleware"    => ['api'], // For injecting middleware to the package's routes
        "prefix"    => 'api', // For injecting middleware to the package's routes
    ],
];
