<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;


/* EXTRACT OF database.php */
$db['default']['hostname'] = "localhost"; // or put the IP of your SQL Server Instance
// $db['default']['hostname'] = "10.8.0.194"; // or put the IP of your SQL Server Instance
// $db['default']['port'] 	   = 1433; // or the port you configured on step 6
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'rumahruth_qa';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE; // Pay attention to this, codeigniter makes true for default
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


