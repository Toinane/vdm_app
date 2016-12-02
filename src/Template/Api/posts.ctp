<?php
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Network\Exception\NotFoundException;

$file = substr(App::path('')[0], 0, -5).'plugins\VDM\data.json';
if(!$handle = fopen($file, "r")){
   echo '{"content": "Error data"}';
   exit;
}
$list = json_decode(fread($handle, filesize($file)));
fclose($handle);

if(isset($this->request->query) && !empty($this->request->query)){
   if(isset($this->request->query['author']) && !empty($this->request->query['author'])){
      $author = htmlentities($this->request->query['author']);
      $posts = array(); $counts = 0;
      foreach ($list as $key){
         if(htmlentities($key->author) == $author){
            $posts[] = $list[($key->id-1)];
            $counts++;
         }
      }
      if(!empty($posts)){
         echo '{"posts":['.json_encode($posts).'], "count": "'.$counts.'"}';
      }
      else{
         echo '{"content": "No result found"}';
      }

   }
   else if(isset($this->request->query['from']) && !empty($this->request->query['from'])){
      if(isset($this->request->query['to']) && !empty($this->request->query['to'])){
         $from = strtotime($this->request->query['from']);
         $to = strtotime($this->request->query['to']);
         if($from > $to){
            $from = strtotime($this->request->query['to']);
            $to = strtotime($this->request->query['from']);
         }
         $posts = array(); $counts = 0;
         foreach ($list as $key){
            $date = strtotime(substr($key->date, 0, 10));
            if($date >= $from && $date <= $to){
               $posts[] = $list[($key->id-1)];
               $counts++;
            }
         }
         if(!empty($posts)){
            echo '{"posts":['.json_encode($posts).'], "count": "'.$counts.'"}';
         }
         else{
            echo '{"content": "No result found"}';
         }

      }
      else{
         $from = htmlentities($this->request->query['from']);
         $posts = array(); $counts = 0;
         foreach ($list as $key){
            $date = substr($key->date, 0, 10);
            if($date == $from){
               $posts[] = $list[($key->id-1)];
               $counts++;
            }
         }
         if(!empty($posts)){
            echo '{"posts":['.json_encode($posts).'], "count": "'.$counts.'"}';
         }
         else{
            echo '{"content": "No result found"}';
         }
      }
   }
   else{
      echo '{"content": "No result found"}';
   }
}
else{
   echo '{"posts":['.json_encode($list[0]).'], "count": "1"}';
}
