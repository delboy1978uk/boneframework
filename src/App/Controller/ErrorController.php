<?php

namespace App\Controller;
use Bone\Mvc\Controller;

class ErrorController extends Controller
{
    public function errorAction()
    {
        echo 'Goodbye World!';
    }
}