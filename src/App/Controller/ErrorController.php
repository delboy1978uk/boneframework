<?php

namespace App\Controller;
use Bone\Mvc\Controller;
use Bone\Mvc\Exception;

class ErrorController extends Controller
{
    public function errorAction()
    {
        /** @var Exception $e  */
        $e = $this->getParam('error');
        $this->view->message = $e->getMessage();
        $this->view->code = $e->getCode();
        $this->view->trace = $e->getTrace();
    }

    public function notFoundAction(){}

    public function notAuthorisedAction(){}
}