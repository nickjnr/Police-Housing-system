<?php

require 'class/users.php';
$users= new users;

if(!empty($_POST['action']) && $_POST['action'] == 'addofficer') {
    $users->addofficer();
 }
 if(!empty($_POST['action']) && $_POST['action'] == 'update') {
    $users->Update();
 }