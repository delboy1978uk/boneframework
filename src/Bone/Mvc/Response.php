<?php

namespace Bone\Mvc;

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
        $controller_name = '\App\Controller\\'.ucwords($request->getController()).'Controller';
        $action_name = $request->getAction().'Action';
        $controller = $request->getController();
        $action = $request->getAction();

        // can we find th' darned controller?
        if(!class_exists($controller_name))
        {
            $controller_name = '\App\Controller\ErrorController';
            $action_name = 'errorAction';
            $controller = 'error';
            $action = 'error';
            $dispatch = new $controller_name($request);
        }
        else
        {
            $dispatch = new $controller_name($request);
            if(!method_exists($dispatch,$action_name))
            {
                $controller_name = '\App\Controller\ErrorController';
                $action_name = 'error';
                /** @var Controller $dispatch  */
                $dispatch = new $controller($request);
                $controller = 'error';
                $action = 'error';
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