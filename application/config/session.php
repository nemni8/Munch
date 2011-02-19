<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'cookie' => array(
	  'name' => 'munch_cook',
	  'encrypted' => TRUE,
	  'lifetime' => 43200,
	),
	'native' => array(
	  'name' => 'munch_sess',
	  'encrypted' => TRUE,
	  'lifetime' => 43200,
	),
	'database' => array(
	  'group' => 'default',
	  'table' => 'table_name',
	),
);