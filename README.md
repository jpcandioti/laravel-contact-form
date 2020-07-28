# Laravel Contact Form

## Configuration

~~~~
$ cp .env.dist .env
$ php artisan key:generate
~~~~

### Parameters

- **CONTACT_TO**: Email address where the contact form is sent.
- **RECAPTCHA_SITE_KEY**: Google reCAPTCHA API site key.
- **RECAPTCHA_SECRET_KEY**: Google reCAPTCHA API secret key.


## Install third-party libraries

~~~~
$ composer install
~~~~


## Install DB

~~~~
$ php artisan migrate
$ php artisan db:seed
~~~~
