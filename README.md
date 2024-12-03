# Symfony Practice Commands

| **Command**                                  | **Description**                                                                 |
|----------------------------------------------|---------------------------------------------------------------------------------|
| `symfony server:start`                       | Starts the Symfony local web server to serve your application.                 |
| `composer require --dev symfony/maker-bundle`| Installs the Symfony Maker Bundle for generating code like controllers or entities.|
| `php .\bin\console make:controller`          | Creates a new controller file.                                                 |
| `php .\bin\console debug:router`             | Displays all the routes available in the application.                          |
| `composer require symfony/orm-pack`          | Installs the Symfony ORM pack for database interactions.                       |
| `php .\bin\console doctrine:database:create` | Creates the configured database.                                               |
| `php .\bin\console make:entity product`      | Generates an entity class for a database table named `product`.                |
| `php .\bin\console make:migration`           | Creates a migration file for database schema changes.                          |
| `php .\bin\console doctrine:migrations:migrate` | Executes the migration files to update the database schema.                    |
| `composer clear-cache`                       | Clears the Composer cache to resolve potential issues or refresh dependencies. |
| `composer require --dev doctrine/doctrine-fixtures-bundle:^3.6` | Installs the Doctrine Fixtures Bundle for managing test data.                |
| `php .\bin\console doctrine:fixture:load`    | Loads data fixtures into the database.                                         |
| `php .\bin\console dbal:run-sql "SELECt * FROM product"` | Executes a raw SQL query to fetch all records from the `product` table.     |
| `composer require symfony/form`              | Installs the Symfony Form component for creating and processing forms.         |
| `composer require symfony/profiler-pack`     | Installs the Symfony Profiler Pack for debugging and performance analysis.     |
| `composer require symfony/validator`         | Installs the Symfony Validator component for validating data.                  |
