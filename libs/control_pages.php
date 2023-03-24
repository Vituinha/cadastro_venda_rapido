<?php
session_start();
$page = $_POST['id'];
if($page == 1)
    $_SESSION['page'] = 'prod';
else
    $_SESSION['page'] = 'ped';