<?php declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Controller;

use BoneMvc\Module\Unicorn\Collection\UnicornCollection;
use BoneMvc\Module\Unicorn\Entity\Unicorn;
use BoneMvc\Module\Unicorn\Form\UnicornForm;
use BoneMvc\Module\Unicorn\Service\UnicornService;
use Bone\Mvc\View\ViewEngine;
use Bone\View\Helper\AlertBox;
use Bone\View\Helper\Paginator;
use Del\Form\Field\Submit;
use Del\Form\Form;
use Del\Icon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class UnicornController
{
    /** @var int $numPerPage */
    private $numPerPage = 10;

    /** @var Paginator $paginator */
    private $paginator;

    /** @var UnicornService $service */
    private $service;

    /** @var ViewEngine $view */
    private $view;

    /**
     * @param UnicornService $service
     */
    public function __construct(ViewEngine $view, UnicornService $service)
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
        $total = $db->getTotalUnicornCount();

        $this->paginator->setUrl('unicorn?page=:page');
        $page = (int) $request->getQueryParams()['page'] ?: 1;
        $this->paginator->setCurrentPage($page);
        $this->paginator->setPageCountByTotalRecords($total, $this->numPerPage);

        $unicorns = new UnicornCollection($db->findBy([], null, $this->numPerPage, ($page *  $this->numPerPage) - $this->numPerPage));

        $body = $this->view->render('unicorn::index', [
            'unicorns' => $unicorns,
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
        $unicorn = $db->find($id);
        $body = $this->view->render('unicorn::view', [
            'unicorn' => $unicorn,
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
        $form = new UnicornForm('createUnicorn');
        if ($request->getMethod() === 'POST') {
            $post = $request->getParsedBody();
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $unicorn = $this->service->createFromArray($data);
                $this->service->saveUnicorn($unicorn);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' New unicorn added to database.', 'success');
                $form = new UnicornForm('createUnicorn');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('unicorn::create', [
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
        $form = new UnicornForm('editUnicorn');
        $id = $args['id'];
        $db = $this->service->getRepository();
        /** @var Unicorn $unicorn */
        $unicorn = $db->find($id);
        $form->populate($unicorn->toArray());

        if ($request->getMethod() === 'POST') {
            $post = $this->getPost($request);
            $form->populate($post);
            if ($form->isValid()) {
                $data = $form->getValues();
                $unicorn = $this->service->updateFromArray($unicorn, $data);
                $this->service->saveUnicorn($unicorn);
                $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Unicorn details updated.', 'success');
            } else {
                $msg = $this->alertBox(Icon::REMOVE . ' There was a problem with the form.', 'danger');
            }
        }

        $form = $form->render();
        $body = $this->view->render('unicorn::edit', [
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
        $form = new Form('deleteUnicorn');
        $submit = new Submit('submit');
        $submit->setValue('Delete');
        $submit->setClass('btn btn-danger');
        $form->addField($submit);
        /** @var Unicorn $unicorn */
        $unicorn = $db->find($id);

        if ($request->getMethod() === 'POST') {
            $this->service->deleteUnicorn($unicorn);
            $msg = $this->alertBox(Icon::CHECK_CIRCLE . ' Unicorn deleted.', 'warning');
            $form = '<a href="/unicorn" class="btn btn-default">Back</a>';
        } else {
            $form = $form->render();
            $msg = $this->alertBox(Icon::WARNING . ' Warning, please confirm your intention to delete.', 'danger');
            $msg .= '<p class="lead">Are you sure you want to delete ' . $unicorn->getName() . '?</p>';
        }

        $body = $this->view->render('unicorn::delete', [
            'unicorn' => $unicorn,
            'form' => $form,
            'msg' => $msg,
        ]);

        return new HtmlResponse($body);
    }



    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    protected function getPost(ServerRequestInterface $request): array
    {
        $data = $request->getParsedBody();

        return array_merge((new Unicorn())->toArray(), $data);
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
