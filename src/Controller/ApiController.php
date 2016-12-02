<?php

namespace App\Controller;

use App\Controller\AppController;

class ApiController extends AppController
{

   public function api(){
      //header('Content-Type: application/json');
   }

   public function posts(){
      //header('Content-Type: application/json');
   }

   public function index(){
      return $this->redirect('/api/posts');
   }

}
