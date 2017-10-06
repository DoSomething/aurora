# Aurora [![Wercker](https://img.shields.io/wercker/ci/54fa2257ad79ab4d690003d5.svg?style=flat-square)](https://app.wercker.com/#applications/54fa2257ad79ab4d690003d5) [![StyleCI](https://styleci.io/repos/28877721/shield)](https://styleci.io/repos/28877721)

This is __Aurora__, our user admin tool. It's the graphical front-end to [Northstar](https://www.github.com/dosomething/northstar), our user & activity API.

### Getting Started

Fork and clone this repository, and [add it to your Homestead](https://github.com/DoSomething/communal-docs/blob/master/Homestead/readme.md).

```sh
# Install dependencies:
$ composer install && npm install
    
# Copy the default environment variables:
$ cp .env.example .env

# Make app key & run database migrations:
$ php artisan key:generate
$ php artisan migrate

# And finally, build the frontend assets:
$ npm run build
```

You may run unit tests locally using PHPUnit:

    $ vendor/bin/phpunit
    
### Contributing
We follow [Laravel's code style](http://laravel.com/docs/5.1/contributions#coding-style) and automatically
lint all pull requests with [StyleCI](https://styleci.io/repos/26884886). Be sure to configure
[EditorConfig](http://editorconfig.org) to ensure you have proper indentation settings.

Consider [writing a test case](http://laravel.com/docs/5.1/testing) when adding or changing a feature.
Most steps you would take when manually testing your code can be automated, which makes it easier for
yourself & others to review your code and ensures we don't accidentally break something later on!

### Security Vulnerabilities
We take security very seriously. Any vulnerabilities in Aurora should be reported to [security@dosomething.org](mailto:security@dosomething.org),
and will be promptly addressed. Thank you for taking the time to responsibly disclose any issues you find.

### License
&copy;2016 DoSomething.org. Aurora is free software, and may be redistributed under the terms specified
in the [LICENSE](https://github.com/DoSomething/aurora/blob/dev/LICENSE) file. The name and logo for
DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.
