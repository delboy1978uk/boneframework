<?php
namespace App\Controller;

use Bone\Mvc\Request;

class IndexControllerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var IndexController */
    protected $controller;

    protected function _before()
    {
        if (!defined('APPLICATION_PATH')){
            define('APPLICATION_PATH','.');
        }
        $request = new Request([],[],[],[]);
        $this->controller = new IndexController($request);
    }

    protected function _after()
    {
        unset($this->controller);
    }

    public function testIndexAction()
    {
        $this->assertNull($this->controller->indexAction());
    }

    public function testLearnAction()
    {
        $this->assertNull($this->controller->learnAction());
    }

    public function testJsonAction()
    {
        $this->assertNull($this->controller->jsonAction());
    }
}