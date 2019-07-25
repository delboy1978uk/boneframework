<?php declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Controller;

use BoneMvc\Module\Dragon\Collection\DragonCollection;
use BoneMvc\Module\Dragon\Entity\Dragon;
use BoneMvc\Module\Dragon\Form\DragonForm;
use BoneMvc\Module\Dragon\Service\DragonService;
use Bone\Mvc\View\ViewEngine;
use Bone\View\Helper\AlertBox;
use Bone\View\Helper\Paginator;
use Del\Form\Field\Submit;
use Del\Form\Form;
use Del\Icon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class DragonController
{
    /** @var int $numPerPage */
    private $numPerPage = 10;

    /** @var Paginator $paginator */
    private $paginator;

    /** @var DragonService $service */
    private $service;

    /** @var ViewEngine $view */
    private $view;

    /**
     * @param DragonService $service
     */
    public function __construct(ViewEngine $view, DragonService $service)
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
        $total = $db->getTotalDragonCount();

        $this->paginator->setUrl('dragon?page=:page');
        $page = (int) $request->getQueryParams()['page'] ?: 1;
        $this->paginator->setCurrentPage($page);
        $this->paginator->setPageCountByTotalRecords($total, $this->numPerPage);

        $dragons = new DragonCollection($db->findBy([], null, $this->numPerPage, ($page *  $this->numPerPage) - $this->numPerPage));

        $body = $this->view->render('dragon::index', [
            'dragons' => $dragons,
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
        $dragon = $db->find($id);
        $body = $this->view->render('dragon::view', [
            'dragon' => $dragon,
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
        $form = new DragonForm('createDragon');
        if ($request->getMethod() === 'POST') {
            $post = $request->getParsedBody();
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $dragon = $this->service->createFromArray($data);
                $this->service->saveDragon($dragon);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' New dragon added to database.', 'success');
                $form = new DragonForm('createDragon');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('dragon::create', [
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
        $form = new DragonForm('editDragon');
        $id = $args['id'];
        $db = $this->service->getRepository();
        /** @var Dragon $dragon */
        $dragon = $db->find($id);
        $form->populate($dragon->toArray());

        if ($request->getMethod() === 'POST') {
            $post = $request->getParsedBody();
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $dragon = $this->service->updateFromArray($dragon, $data);
                $this->service->saveDragon($dragon);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Dragon details updated.', 'success');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('dragon::edit', [
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
        $form = new Form('deleteDragon');
        $submit = new Submit('submit');
        $submit->setValue('Delete');
        $submit->setClass('btn btn-danger');
        $form->addField($submit);
        /** @var Dragon $dragon */
        $dragon = $db->find($id);

        if ($request->getMethod() === 'POST') {
            $this->service->deleteDragon($dragon);
            $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Dragon deleted.', 'warning');
            $form = '<a href="/dragon" class="btn btn-default">Back</a>';
        } else {
            $form = $form->render();
            $msg = $this->alertBox(Icon::WARNING . ' Warning, please confirm your intention to delete.', 'danger');
            $msg .= '<p class="lead">Are you sure you want to delete ' . $dragon->getName() . '?</p>';
        }

        $body = $this->view->render('dragon::delete', [
            'dragon' => $dragon,
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
