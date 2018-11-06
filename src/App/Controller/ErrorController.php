<?php

namespace App\Controller;

use Bone\Mvc\Controller;
use Exception;

class ErrorController extends Controller
{

    public function errorAction()
    {
        /** @var Exception $e */
        $e = $this->getParam('error', null);

        $this->view->message = $e ? $e->getMessage() : '';
        $this->view->code = $e ? $e->getCode() : '';
        $this->view->trace = $e ? $e->getTrace() : '';

    }

    public function notFoundAction(){}

    public function notAuthorisedAction(){}
}