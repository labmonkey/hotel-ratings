### Requirements
1. Apache Server
2. PHP (Tested on 5.5)
3. Make sure that `includes/model/database/db.sqlite` is writeable

### Installation
1. Copy files into preferred PHP server public folder
3. That's it! It's ready to use.

### Development
1. `composer update`
2. `cd views`
3. `npm install`
4. `bower install`
5. `gulp` - run each time

##### Database
In order to update database simply run `sudo sh includes/model/commands/update-db.sh`

This repository includes database file itself with populated sample data (all below commands were done).

+ In order to Update the database schema or generate entities from mappings run `sudo includes/model/commands/update-db.sh`
+ In order to delete database content run `sudo includes/model/commands/drop-db.sh`
+ In order to populate database with sample data set `define( 'LOAD_SAMPLE_DATA', true );` in `includes/app-config` and open the application root url. Do it only once and set back to `false` afterwards!

### Libraries used
##### PHP
+ composer - Package manager
+ twig - Templating engine
+ doctrine - Database + orm
##### JS
+ bower - Package manager
+ gulp - Package manager
+ jquery - Javascript framework
##### CSS
+ sass - CSS preprocessor
+ twitter bootstrap - CSS framework
#### Other
+ SQLite - Database engine

### About the application
This is a simple application based on PHP and most popular frameworks and libraries.

Application lets users review Hotels and access their account data. Administrators can moderate the reviews.

- Most of the logic is **custom made** excluding the mentioned libraries.
- Application was designed with simplicity in mind (both usage and installation)
- Application follows **MVC** design pattern
- Authentication is based on Session variables
- Login and Registration validation is done both on frontend and backend side