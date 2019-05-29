<?php
namespace App\Controller;

use Bone\Mvc\Registry;
use Codeception\TestCase\Test;
use Zend\Diactoros\ServerRequest;
use Zend\I18n\Translator\Loader\Gettext;

class IndexControllerTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var IndexController */
    protected $controller;

    /**
     * @throws \Exception
     */
    protected function _before()
    {
        if (!defined('APPLICATION_PATH')){
            define('APPLICATION_PATH','.');
        }

        Registry::ahoy()->set('i18n', [
            'translations_dir' => 'data/translations',
            'type' => Gettext::class,
            'default_locale' => 'en_GB',
            'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'],
        ]);

        $request = new ServerRequest();
        $this->controller = new IndexController($request);
        $this->controller->setParam('locale', 'en_PI');
    }

    protected function _after()
    {
        unset($this->controller);
    }


    public function testInit()
    {
        $this->assertNull($this->controller->init());
        $this->assertEquals('en_GB', $this->controller->getTranslator()->getLocale());
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