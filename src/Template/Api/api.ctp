<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Network\Exception\NotFoundException;

header('Content-Type: application/json');

if(isset($this->passedArgs[0])){
   if(is_numeric($this->passedArgs[0])){
      $id = htmlentities($this->passedArgs[0]);
      $file = './../plugins/VDM/data.json';
      if(!$handle = fopen($file, "r")){
         echo '{"content": "Error data"}';
         exit;
      }
      $list = json_decode(fread($handle, filesize($file)));
      fclose($handle);

      if(isset($list[$id-1])){
         echo '{"post":'.json_encode($list[$id-1]).'}';
      }
      else{
         echo '{"content": "ID doesn\'t exist"}';
      }
   }
   else{
      echo '{"content": "ID doesn\'t exist"}';
   }
}
