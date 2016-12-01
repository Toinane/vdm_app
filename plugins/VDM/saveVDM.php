<?php

/* CALLBACK HERE */
/* CHANGE THE VALUE HERE TO HAVE MORE OR LESS VDM */
saveVDM(200);


/*
   Function GetVDM : get vdm from the website and save it into array
   {param} INT $max_vdm : Max VDM the function will get
   {param} ARRAY $json : Array who have all VDM
   {param} INT $page : the actual page of the website
   {param} INT $total_vdm : the actual number of VDM in progress
   {return} ARRAY : le number of VDM into an array
*/
function getVDM($max_vdm, &$json = array(), $page = 0, $total_vdm = 0){
   if(!$source = file_get_contents("http://www.viedemerde.fr/?page=".$page)){
      echo "[ERROR] Unable to get VDM on the website!\n[ERROR] Are you Online?\n";
      exit;
   }

   $regPost = '/(?<=class="fmllink">).*(?=<\/a><\/p><div class="cf">)/';
   $regAuthor = '/(?<=Vécue par ).*(?= <a href)|(?<=Vécue par ).*(?= \/ [0-9])/';
   $regDate = '/(?<=<\/i><\/a> \/ ).*(?= \/ )|(?<= \/ ).*(?= \/ [A-Z])|(?<=[a-z]  \/ ).*(?= \/ )|(?<=[a-z] \/ ).*(?= \/ )/';

   preg_match_all($regPost, $source, $posts);
   preg_match_all($regAuthor, $source, $authors);
   preg_match_all($regDate, $source, $dates);

   for($i = 0; $i < sizeof($posts[0]); $i++){
      if($total_vdm >= $max_vdm | !isset($dates[0][$i])){ continue; }
      $id = [
         'id' => $total_vdm,
         'content' => $posts[0][$i],
         'date' => substr(str_replace(" à","", $dates[0][$i]), 0, 16),
         'author' => trim($authors[0][$i])
      ];
      $json[] = $id;
      $total_vdm++;
      echo ".";
   }


   if($total_vdm < $max_vdm){
      getVDM($max_vdm, $json, $page+1, $total_vdm);
   }
   if(!is_null($json)){return $json;}
}


/*
   Function GetVDM : get vdm from the website and save it into array
   {param} INT $number_vdm : Max VDM you want to save
   {return} BOOLEAN : return true if the programm has finished
*/
function saveVDM($number_vdm){
   echo "[LOG] Prepare to get ".$number_vdm." VDM\n";
   $data = getVDM($number_vdm);

   if(!$handle = fopen("plugins/VDM/data.json", "w+")){
      echo "[ERROR] Unable to create/open data.json\n";
      exit;
   }
   if(fwrite($handle, json_encode($data)) === FALSE) {
      echo "[ERROR] Unable to write into data.json\n";
      exit;
   }
   fclose($handle);
   echo "\n[LOG] data.json file created with ".$number_vdm." VDM!\n";
   return true;
}
