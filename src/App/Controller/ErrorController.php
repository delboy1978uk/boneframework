<?php

namespace App\Controller;
use Bone\Mvc\Controller;

class ErrorController extends Controller
{
    public function errorAction()
    {
        $this->view->error = 'Goodbye World!';
    }
}