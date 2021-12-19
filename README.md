# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kaiyum2012/socialite-auth.svg?style=flat-square)](https://packagist.org/packages/kaiyum2012/socialite-auth)
[![Total Downloads](https://img.shields.io/packagist/dt/kaiyum2012/socialite-auth.svg?style=flat-square)](https://packagist.org/packages/kaiyum2012/socialite-auth)
![GitHub Actions](https://github.com/kaiyum2012/socialite-auth/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require kaiyum2012/socialite-auth
```

Laravel without auto-discovery:
If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```base
Kaiyum2012\SocialiteAuth\SocialiteAuthServiceProvider::class,
```

## Usage
SET following `env` variables.
```php
SOCIAL_AUTH=true
SOCIAL_AUTH_PROVIDERS= #e.g. github|facebook|google|twitter
SOCIAL_AUTH_ROUTE=/auth/social
SOCIAL_AUTH_CALLBACK=/auth/social/callback

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_AUTH_CALLBACK= #example: https://finance.local/auth/social/callback/github

GOOGLE_CLIENT_ID= #
GOOGLE_CLIENT_SECRET= #
GOOGLE_REDIRECT= #example: https://finance.local/auth/social/callback/google
```

set URLs as following:
####Auth Route
```php 
route('socialite-auth.route',{'provider':{provider}})
# {provider} = github|google
# e.g route('socialite-auth.route',{'provider':'github'})
```
####Callback Route
```php
route('socialite-auth.callback',{'provider':{provider}})
# {provider} = github|google
# e.g route('socialite-auth.callback',{'provider':'github'})
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email abdulkaiyum.creatrix@gmail.com instead of using the issue tracker.

## Credits

-   [Abdulkaiyum Shaikh](https://github.com/kaiyum2012)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
