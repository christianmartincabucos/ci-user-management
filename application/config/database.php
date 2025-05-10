<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   $active_group = 'development';
   $query_builder = TRUE;
   $db['development'] = array(
      'dsn' => '',
      'hostname' => 'db',
      'username' => 'test_user', // update with your actual username
      'password' => 'test_password', // update with your actual password
      'database' => 'test_db', // update with your actual database name
      'dbdriver' => 'mysqli',
      'dbprefix' => '',
      'pconnect' => FALSE,
      'db_debug' => TRUE,
      'cache_on' => FALSE,
      'cachedir' => '',
      'char_set' => 'utf8',
      'dbcollat' => 'utf8_general_ci',
      'swap_pre' => '',
      'encrypt' => FALSE,
      'compress' => FALSE,
      'stricton' => FALSE,
      'failover' => array(),
      'save_queries' => TRUE
   );