# (DRAFT) Socialite Auth for Laravel Application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kaiyum2012/socialite-auth.svg?style=flat-square)](https://packagist.org/packages/kaiyum2012/socialite-auth)
[![Total Downloads](https://img.shields.io/packagist/dt/kaiyum2012/socialite-auth.svg?style=flat-square)](https://packagist.org/packages/kaiyum2012/socialite-auth)
![GitHub Actions](https://github.com/kaiyum2012/socialite-auth/actions/workflows/main.yml/badge.svg)

Supported social providers

- Google
- GitHub and

more on the way!

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

Set following `env` variables.

```php
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

Set URLs as following:

#### Auth Route

```php 
route('socialite-auth.route',{'provider':{provider}})
# {provider} = github|google
# e.g route('socialite-auth.route',{'provider':'github'})
```

#### Callback Route

```php
route('socialite-auth.callback',{'provider':{provider}})
# {provider} = github|google
# e.g route('socialite-auth.callback',{'provider':'github'})
```

#### Migration

```php
php artisan migrate
```

#### Configuration

`User` Model should implement `Sociable` Contract

```
class User implements Sociable
```

and use `HasSocialAccounts` trait to implement `Sociable` Contract

```
use HasSocialAccounts;
```

For some reason if you would like to override New user creation using social account can be done as following:

``` 
 public function createUserUsing(array $attributes = []): Sociable
 {
      return $this->fill($attributes);
 }
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

If you discover any security related issues, please email abdulkaiyum.creatrix@gmail.com instead of using the issue
tracker.

## Credits

- [Abdulkaiyum Shaikh](https://github.com/kaiyum2012)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

Special Thanks to [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
