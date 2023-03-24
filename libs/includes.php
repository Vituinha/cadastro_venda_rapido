<?php
$database = 'senioridade';
$password = '';
$user     = 'root';

$mysqli = new mysqli("localhost", $user, $password, $database);
$mysqli->select_db($database) or die( "Falha de conexão com o banco de dados!");