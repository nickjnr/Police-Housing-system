<?php
require "class/houses.php";
$house=new houses();

if(!empty($_POST['action']) && $_POST['action'] == 'listapplication') {
   $suppliers->applications();
}


if(!empty($_POST['action']) && $_POST['action'] == 'addbuilding') {
   $house->add();
}

if(!empty($_POST['action']) && $_POST['action'] == 'update') {
   $house->updatestatus($_POST['house'],$_POST['building']);
}


if(!empty($_POST['action']) && $_POST['action'] == 'getstatus') {
   $house->housestatus($_POST['house'],$_POST['id']);
}

 if(!empty($_POST['action']) && $_POST['action'] == 'editofficer') {
   $house->data($_POST['Id']);
}


if(!empty($_POST['action']) && $_POST['action'] == 'data') {
   $house->getHouses($_POST['type']);
}

if(!empty($_POST['action']) && $_POST['action'] == 'listhousedetails') {
   $house-> listhousedetails($_POST['id']);
}
 
 
if(!empty($_POST['action']) && $_POST['action'] == 'housedata') {
    $house->getHouseNo($_POST['type']);
 }
 if(!empty($_POST['action']) && $_POST['action'] == 'listhouses') {
   $house->listHouses();
}

if(!empty($_POST['action']) && $_POST['action'] == 'listofficers') {
   $house-> listOfficers();
}


 if(!empty($_POST['action']) && $_POST['action'] == 'setPrice') {
   $suppliers->SetPrice($_POST['price'],$_POST['application_id']);
}


?>