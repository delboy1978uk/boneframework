<?php

namespace App\Controller;
use Bone\Mvc\Controller;

class ErrorController extends Controller
{
    public function errorAction()
    {
        $this->view->error = 'Goodbye World!';
    }

    public function notFoundAction()
    {
        $this->view->error = 'Lost at sea!';
    }

    public function notAuthorisedAction()
    {
        $this->view->error = 'Lost at sea!';
    }
}