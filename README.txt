This module is a migration example from Drupal 6 to Drupal 8.

Put the following code in your settings.php:

// Note the key 'migrate' here is important.
$databases['migrate']['default'] = array (
 // The database that contains the source data we're going to import.
 'database' => 'database_name',
 'username' => 'user',
 'password' => 'pass',
 'prefix' => '',
 'host' => 'localhost',
 'port' => '3306',
 'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
 'driver' => 'mysql',
);