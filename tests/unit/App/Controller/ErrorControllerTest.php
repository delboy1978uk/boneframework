<?php
namespace App\Controller;

use Zend\Diactoros\ServerRequest;
use ReflectionClass;
use Exception;

class ErrorControllerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var ErrorController */
    protected $controller;

    protected function _before()
    {
        if (!defined('APPLICATION_PATH')){
            define('APPLICATION_PATH','.');
        }
        $request = new ServerRequest();

        $this->controller = new ErrorController($request);
        $this->controller->setParam('error', new Exception('bang!'));
    }

    protected function _after()
    {
    }

    // tests
    public function testErrorAction()
    {
        $this->controller->errorAction();
        $this->assertEquals('bang!', $this->controller->view->message);
    }

    public function testNotFoundAction()
    {
        $this->assertNull($this->controller->notFoundAction());
    }
    public function testNotAuthorisedAction()
    {
        $this->assertNull($this->controller->notAuthorisedAction());
    }


    /**
     * @param $object
     * @param $property
     * @param $value
     * @return mixed
     */
    public function setPrivateProperty(&$object, $property, $value)
    {
        $reflection = new ReflectionClass(get_class($object));
        $prop = $reflection->getProperty($property);
        $prop->setAccessible(true);
        $prop->setValue($object,$value);
        return $value;
    }
}