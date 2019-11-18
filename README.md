# Get Started
 After installing the project You will need to run the following commands.
 
 #### - Install Composer
```
composer install
```

#### - Set tables using the migration command
```
php artisan migrate
```

#### - Insert the necessary initial data
```
php artisan db:seed
```

#### - Generate an encryption key
```
php artisan key:generate
```

#### - Install npm packages
```
npm install
```
And you can use any command from package.json 
to start the project, for example:
```
npm run dev
npm run watch
npm run prod
```
After executing all the commands, 
You can go to the admin panel with the following credentials (admin path: site_url/admin)

```
login:  admin
pass:  01234567
```
After login You can go the way Config->Privileges, 
and configure privileges for further site configuration.

## Create permission command
If You want to add a new permissions You can use the following command.
```
php artisan auth:permission yourPermissionName [--remove]
```
This command will create the following permissions
```
view_yourPermissionName, 
create_yourPermissionName, 
update_yourPermissionName, 
delete_yourPermissionName
```
If You want to remove the permissions You need to add the [--remove] key.

## Tracking visitors

To track visitors, You need to register on the site http://api.ipstack.com
and get the token that You need to insert into the configuration file config/visit_log.php
