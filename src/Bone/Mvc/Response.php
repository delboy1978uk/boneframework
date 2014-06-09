<?php

namespace Bone\Mvc;

use Bone\Filter;

class Response
{
    protected $body;

    /**
     *  Load the cannons darn ye!
     *
     * @param Request $request controller
     */
    public function __construct(Request $request)
    {
        // what be we talkin about?
        $filtered = Filter::filterString($request->getController(),'DashToCamelCase');
        $controller_name = '\App\Controller\\'.ucwords($filtered).'Controller';

        $filtered = Filter::filterString($request->getAction(),'DashToCamelCase');
        $action_name = $filtered.'Action';
        $controller = $request->getController();
        $action = $request->getAction();

        // can we find th' darned controller?
        if(!class_exists($controller_name))
        {
            $controller_name = '\App\Controller\ErrorController';
            $action_name = 'errorAction';
            $controller = 'error';
            $action = 'not-found';
            $dispatch = new $controller_name($request);
        }
        else
        {
            $dispatch = new $controller_name($request);
            if(!method_exists($dispatch,$action_name))
            {
                $controller_name = '\App\Controller\ErrorController';
                $action_name = 'errorAction';
                /** @var Controller $dispatch  */
                $dispatch = new $controller_name($request);
                $controller = 'error';
                $action = 'not-found';
            }
        }

        $dispatch->init();
        $dispatch->$action_name();
        $dispatch->postDispatch();

        /** @var \stdClass $view_vars  */
        $view_vars = (array) $dispatch->view;
        $view = $controller.'/'.$action.'.twig';
        $response_body = $dispatch->getTwig()->render($view, $view_vars);
        //check we be usin' th' templates in th' config
        $templates = Registry::ahoy()->get('templates');
        $template = ($templates != null) ? $templates[0] : null;
        if($template)
        {
            $response_body = $dispatch->getTwig()->render('layouts/'.$template.'.twig',array('content' => $response_body));
        }
        $this->body = $response_body;
    }


    /**
     *  Fire th' Cannons!!
     *
     * @return string
     */
    public function send()
    {
        return $this->body;
    }
}