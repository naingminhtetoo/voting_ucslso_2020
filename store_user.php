<?php 

  $name = $_POST['name'];
  $email = $_POST['email'];
  $id = $_POST['userid'];
  //echo $name." ".$email." ".$id;
    
    require __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Factory;
$acc=\Kreait\Firebase\ServiceAccount::fromJsonFile(__DIR__.'/mykey/key.json');
     $firebase=(new Factory)->withServiceAccount($acc)->create();
     $database=$firebase->getDatabase();
      $dbname='User';
            if(!$database->getReference($dbname)->getSnapshot()->exists()){
               $database->getReference($dbname)->getChild($id)->getChild('name')->set($name);
               $database->getReference($dbname)->getChild($id)->getChild('id')->set($id);
               $database->getReference($dbname)->getChild($id)->getChild('email')->set($email);
               
             }
             else {
                
             }
            