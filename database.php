<?php
declare(strict_types=1);

include_once "myDB.php";

if (isset($_POST['nom'], $_POST['url'], $_POST['categorie'])) {
    $db = new myDB();
    $db->addCategory($_POST['nom'], $_POST['url'], $_POST['categorie']);
    header('Location: index.php');
}
else {
   var_dump($_POST);
}



