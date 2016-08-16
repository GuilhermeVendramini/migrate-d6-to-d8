Obs.: Caso a migração seja feita apartir do SQL, colocar o seguinte código no settings.php, informando o database que será migrado:

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