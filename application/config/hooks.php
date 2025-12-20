<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

/*
| -------------------------------------------------------------------------
| Security Firewall Hook
| -------------------------------------------------------------------------
| Este hook se ejecuta ANTES de cargar CodeIgniter (pre_system)
| Protege contra DDoS, scraping y ataques automatizados
*/
$hook['pre_system'] = array(
	'class'    => 'SecurityFirewall',
	'function' => 'run',
	'filename' => 'SecurityFirewall.php',
	'filepath' => 'hooks'
);
