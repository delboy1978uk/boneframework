<?php declare(strict_types=1);

namespace BoneMvc\Module\Orc\Controller;

use BoneMvc\Module\Orc\Collection\OrcCollection;
use BoneMvc\Module\Orc\Entity\Orc;
use BoneMvc\Module\Orc\Form\OrcForm;
use BoneMvc\Module\Orc\Service\OrcService;
use Bone\Mvc\View\ViewEngine;
use Bone\View\Helper\AlertBox;
use Bone\View\Helper\Paginator;
use Del\Form\Field\Submit;
use Del\Form\Form;
use Del\Icon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class OrcController
{
    /** @var int $numPerPage */
    private $numPerPage = 10;

    /** @var Paginator $paginator */
    private $paginator;

    /** @var OrcService $service */
    private $service;

    /** @var ViewEngine $view */
    private $view;

    /**
     * @param OrcService $service
     */
    public function __construct(ViewEngine $view, OrcService $service)
    {
        $this->paginator = new Paginator();
        $this->service = $service;
        $this->view = $view;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $db = $this->service->getRepository();
        $total = $db->getTotalOrcCount();

        $this->paginator->setUrl('orc?page=:page');
        $page = (int) $request->getQueryParams()['page'] ?: 1;
        $this->paginator->setCurrentPage($page);
        $this->paginator->setPageCountByTotalRecords($total, $this->numPerPage);

        $orcs = new OrcCollection($db->findBy([], null, $this->numPerPage, ($page *  $this->numPerPage) - $this->numPerPage));

        $body = $this->view->render('orc::index', [
            'orcs' => $orcs,
            'paginator' => $this->paginator->render(),
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function viewAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $db = $this->service->getRepository();
        $id = $args['id'];
        $orc = $db->find($id);
        $body = $this->view->render('orc::view', [
            'orc' => $orc,
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function createAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $msg = '';
        $form = new OrcForm('createOrc');
        if ($request->getMethod() === 'POST') {
            $post = $request->getParsedBody();
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $orc = $this->service->createFromArray($data);
                $this->service->saveOrc($orc);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' New orc added to database.', 'success');
                $form = new OrcForm('createOrc');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('orc::create', [
            'form' => $form,
            'msg' => $msg,
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function editAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $msg = '';
        $form = new OrcForm('editOrc');
        $id = $args['id'];
        $db = $this->service->getRepository();
        /** @var Orc $orc */
        $orc = $db->find($id);
        $form->populate($orc->toArray());

        if ($request->getMethod() === 'POST') {
            $post = $request->getParsedBody();
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $orc = $this->service->updateFromArray($orc, $data);
                $this->service->saveOrc($orc);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Orc details updated.', 'success');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('orc::edit', [
            'form' => $form,
            'msg' => $msg,
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function deleteAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $id = $args['id'];
        $db = $this->service->getRepository();
        $form = new Form('deleteOrc');
        $submit = new Submit('submit');
        $submit->setValue('Delete');
        $submit->setClass('btn btn-danger');
        $form->addField($submit);
        /** @var Orc $orc */
        $orc = $db->find($id);

        if ($request->getMethod() === 'POST') {
            $this->service->deleteOrc($orc);
            $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Orc deleted.', 'warning');
            $form = '<a href="/orc" class="btn btn-default">Back</a>';
        } else {
            $form = $form->render();
            $msg = $this->alertBox(Icon::WARNING . ' Warning, please confirm your intention to delete.', 'danger');
            $msg .= '<p class="lead">Are you sure you want to delete ' . $orc->getName() . '?</p>';
        }

        $body = $this->view->render('orc::delete', [
            'orc' => $orc,
            'form' => $form,
            'msg' => $msg,
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param string $message
     * @param string $class
     * @return string
     */
    private function alertBox(string $message, string $class): string
    {
        return AlertBox::alertBox([
            'message' => $message,
            'class' => $class,
        ]);
    }
}
