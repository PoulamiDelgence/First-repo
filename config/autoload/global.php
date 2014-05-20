<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
//added by Poulami
return array(
    'db' => array(
     'driver' => 'Pdo',
     'dsn' => 'mysql:dbname=sfp_staging;host=54.72.188.10',
     'username'       =>'root',
     'password'      =>'',
     'driver_options' => array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
     ),
 ),
 'service_manager' => array(
     'factories' => array(
         'Zend\Db\Adapter\Adapter'
         => 'Zend\Db\Adapter\AdapterServiceFactory',
     ),
  ),
);
