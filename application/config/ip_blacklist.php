<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| IP Blacklist Configuration
| -------------------------------------------------------------------------
| Lista de IPs bloqueadas permanentemente
| Agregar IPs maliciosas detectadas manualmente
|
| Ejemplo:
| $config['ip_blacklist'] = array(
|     '192.168.1.100',
|     '10.0.0.50',
| );
*/

$config['ip_blacklist'] = array(
	// Agregar IPs maliciosas aquí
	// Ejemplo: '123.456.789.0',
);
