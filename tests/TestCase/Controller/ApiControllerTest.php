<?php

namespace App\Test\TestCase\Controller;

use App\Controller\PagesController;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;

/**
 * PagesControllerTest class
 */
class ApiControllerTest extends IntegrationTestCase
{
    /**
     * api method
     *
     * @return void
     */
     public function testApi(){
        $this->get('/api/posts/42');
        $this->assertResponseOk();
        $this->get('/api/posts/304');
        $this->assertResponseOk();
        $this->get('/api/posts/-92');
        $this->assertResponseOk();
        $this->get('/api/posts/badrequest');
        $this->assertResponseOk();
     }


     /**
      * testDisplay method
      *
      * @return void
      */
      public function testPosts()
     {
        $this->get('/api/posts?author=Anonyme');
        $this->assertResponseOk();
        $this->get('/api/posts?author=test');
        $this->assertResponseOk();
        $this->get('/api/posts?bad=request');
        $this->assertResponseOk();
        $this->get('/api/posts?from=request');
        $this->assertResponseOk();
        $this->get('/api/posts?from=10-11-2016');
        $this->assertResponseOk();
        $this->get('/api/posts?from=10-11-2016&to=13-11-2016');
        $this->assertResponseOk();
     }


     /**
      * testDisplay method
      *
      * @return void
      */
      public function testIndex()
     {
        $this->get('/api/posts');
        $this->assertResponseOk();
        $this->get('/');
        $this->assertResponseOk();
     }


}
