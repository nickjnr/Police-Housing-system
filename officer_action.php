<?php
require "class/houses.php";
$house=new houses();

if(!empty($_POST['action']) && $_POST['action'] == 'listapplication') {
   $suppliers->applications();
}
