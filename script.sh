php artisan infyom:scaffold Users  --fromTable --tableName=users --primary=id
php artisan infyom:scaffold Roles  --fromTable --tableName=roles --primary=id --relations
php artisan infyom:scaffold UserRoles  --fromTable --tableName=users_roles --primary=id --relations

php artisan infyom:scaffold Roles --fromTable --tableName=roles --primary=id --relations --datatables=false --paginate=20