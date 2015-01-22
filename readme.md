## Aurora

This is the DoSomething front facing user tool.
It works together with [Northstar](https://github.com/DoSomething/northstar) to find and display user data.

### Requirements
1. Composer
2. Homestead -- preferably [DS Homestead](https://github.com/DoSomething/ds-homestead)

### The local setup
1. Clone the repo
2. Edit your Homestead.yml file to include this new info
3. Add your app url (aurora.dev) to your `etc/hosts` file
4. ssh into the vm
5. Run `composer intsall && php artisan migrate --seed` to install packages and create the database
6. Visit `aurora.dev:8000`
7. Prosper 

### License

This framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


