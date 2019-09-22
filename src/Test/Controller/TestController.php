<?php declare(strict_types=1);

namespace BoneMvc\Module\Test\Controller;

use Bone\Mvc\View\ViewEngine;
use BoneMvc\Mail\EmailMessage;
use BoneMvc\Mail\Service\MailService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class TestController
{
    /** @var ViewEngine $view */
    private $view;

    /** @var MailService $mailService */
    private $mailService;

    public function __construct(ViewEngine $view, MailService $mailService)
    {
        $this->view = $view;
        $this->mailService = $mailService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $msg = new EmailMessage();
        $msg->setFrom('noreply@awesome.scot');
        $msg->setTo('spam-victim@wits-end.com');
        $msg->setSubject('Purest clickbait');
        $msg->setTemplate('testemails::hello');
        $msg->setViewData([
            'name' => 'John',
        ]);

        $this->mailService->sendEmail($msg);
        $body = $this->view->render('test::index', []);

        return new HtmlResponse($body);
    }
}
