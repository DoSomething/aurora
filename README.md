# Aurora [![wercker status](https://app.wercker.com/status/6941ef894ee169cc7cf72297186e107d/s/master 'wercker status')](https://app.wercker.com/project/byKey/6941ef894ee169cc7cf72297186e107d) [![StyleCI](https://styleci.io/repos/28877721/shield)](https://styleci.io/repos/28877721)

This is **Aurora**, our member admin tool. It's the graphical front-end to [Northstar](https://www.github.com/dosomething/northstar), our user & identity API.

### Getting Started

Clone this repository, and [add it to your Homestead](https://github.com/DoSomething/communal-docs/blob/master/Homestead/readme.md).

```sh
# Install dependencies:
$ composer install && npm install

# Configure application & run migrations:
$ php artisan aurora:setup

# And finally, build the frontend assets:
$ npm run build
```

You may run unit tests locally using PHPUnit:

    $ phpunit

### Contributing

We follow [Laravel's code style](https://laravel.com/docs/6.x/contributions#coding-style) and automatically
format PHP code with [Prettier PHP](https://github.com/prettier/plugin-php). Be sure to configure
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
