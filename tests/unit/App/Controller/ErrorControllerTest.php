<?php
namespace App\Controller;

use Bone\Mvc\Request;
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
        $request = new Request([],[],[],[]);
        $request->setParam('error',new Exception('garrr'));
        $this->controller = new ErrorController($request);
    }

    protected function _after()
    {
    }

    // tests
    public function testErrorAction()
    {
        $this->assertNull($this->controller->errorAction());
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