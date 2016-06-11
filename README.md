# Install

##1)Make changes at composer.json

"require": {

	....

	"rushix/LaravelProducts": "v1.0.*",
        "laravelcollective/html": "^5.2"
}


"repositories": [

	....

	{
            "type": "vcs",
            "url": "https://github.com/rushix/LaravelProducts"
        }
]


"autoload": {

	....

        "classmap": [
            "database"
        ],
        "psr-4": {
            "App\\": "app/",
            "Rushix\\LaravelProducts\\": "packages/Rushix/LaravelProducts/src/",
            "Rushix\\LaravelProducts\\Models\\": "packages/Rushix/LaravelProducts/src/models/"
        }
}

##2)Make changes at config/app.php

'providers' => [

	....

	      Collective\Html\HtmlServiceProvider::class,
        Rushix\LaravelProducts\LaravelProductsServiceProvider::class,

]


'aliases' => [

	....

        'Html' => Collective\Html\HtmlFacade::class,
        'Form' => Collective\Html\FormFacade::class,
        'LaravelProducts' => Rushix\LaravelProducts\LaravelProductsFacade::class,

]

##3)Execute the following commands

composer update

php artisan vendor:publish

php artisan migrate

##4)View results at <server>/products/
