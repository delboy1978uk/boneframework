<?php declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Controller;

use Bone\Mvc\View\ViewEngine;
use Bone\View\Helper\AlertBox;
use BoneMvc\Module\Dragon\Collection\DragonCollection;
use BoneMvc\Module\Dragon\Entity\Dragon;
use BoneMvc\Module\Dragon\Form\DragonForm;
use BoneMvc\Module\Dragon\Service\DragonService;
use Del\Form\Field\Submit;
use Del\Form\Form;
use Del\Icon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class DragonController
{
    /** @var ViewEngine $view */
    private $view;

    /** @var DragonService $service */
    private $service;

    /**
     * DragonController constructor.
     * @param DragonService $service
     */
    public function __construct(ViewEngine $view, DragonService $service)
    {
        $this->view = $view;
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {

        $db = $this->service->getRepository();
        $dragons = new DragonCollection($db->findAll());
        $body = $this->view->render('dragon::index', [
            'dragons' => $dragons,
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function viewAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $db = $this->service->getRepository();
        $id = $args['id'];
        $dragon = $db->find($id);
        $body = $this->view->render('dragon::index', [
            'dragons' => [$dragon],
        ]);

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
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
     * @return bool|string
     */
    private function alertBox(string $message, string $class = ''): string
    {
        return AlertBox::alertBox([
            'message' => $message,
            'class' => $class,
        ]);
    }
}