# Aurora

This is DoSomething GUI(Graphical User Interface) to find and display users information, activities such as campaigns signups, and reportbacks.
It works together with [Northstar](https://github.com/DoSomething/northstar).

## Requirements
* Composer
* Homestead -- preferably [DS Homestead](https://github.com/DoSomething/ds-homestead)
* Northstar repository [DoSomething Northstar](https://github.com/DoSomething/northstar)

## The local setup
1. Fork and clone this repository and install your local homestead.
2. Edit your Homestead.yml `sites` property to map this site domain name, preferably `aurora.dev` to a folder on your Homestead environment where it holds all your projects. Visit [Laravel 4](http://laravel.com/docs/4.2/homestead#installation-and-setup) for more information about how to configure your sites.
3. Add your app url name `aurora.dev`, to your `etc/hosts` file to serve it locally.
4. Boot up the virutal machine and ssh into it.
5. Add this site to Homestead environment by using `serve` command: `serve aurora.dev /home/vagrant/Code/path/to/public/directory`.
6. Run `composer intsall && npm install` to set up dependencies.
7. Run `php artisan migrate --seed` to create and migrate the database.
8. Go to root directory of your aurora app.
9. Run `gulp` to compile front-end assets into aurora app
10. Visit `aurora.dev:8000`.
11. Prosper.

## License
&copy;2015 DoSomething.org. Aurora App is free software, and may be redistributed under the terms specified in the [LICENSE](https://github.com/DoSomething/aurora/blob/master/LICENSE) file. The name and logo for DoSomething.org are trademarks of Do Something, Inc and may not be used without permission.

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
