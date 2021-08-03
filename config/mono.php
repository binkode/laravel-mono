<?php

return [
    "secret_key"    => env("MONO_SECRET_KEY", 'yes'),
    "url"           => env("MONO_URL", 'https://api.withmono.com'),

    "routes" => [
        "middleware"    => null, // For injecting middleware to the package's routes
    ],
];
