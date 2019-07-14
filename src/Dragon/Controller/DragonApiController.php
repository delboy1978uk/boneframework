<?php declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Controller;

use BoneMvc\Module\Dragon\Collection\DragonCollection;
use BoneMvc\Module\Dragon\Form\DragonForm;
use BoneMvc\Module\Dragon\Service\DragonService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class DragonApiController
{
    /** @var DragonService $service */
    private $service;

    /**
     * DragonController constructor.
     * @param DragonService $service
     */
    public function __construct(DragonService $service)
    {
        $this->service = $service;
    }

    /**
     * Controller.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $db = $this->service->getRepository();
        $dragons = new DragonCollection($db->findAll());

        return new JsonResponse($dragons->toArray());
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $post = json_decode($request->getBody()->getContents(), true) ?: $request->getParsedBody();
        $form = new DragonForm('create');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $dragon = $this->service->createFromArray($data);
            $this->service->saveDragon($dragon);

            return new JsonResponse($dragon->toArray());
        }

        return new JsonResponse([
            'error' => [
                'error_messages' => $form->render(),
            ],
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function viewAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $dragon = $this->service->getRepository()->find($args['id']);

        return new JsonResponse($dragon->toArray());
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $db = $this->service->getRepository();
        $dragon = $db->find($args['id']);

        $post = json_decode($request->getBody()->getContents(), true) ?: $request->getParsedBody();
        $form = new DragonForm('update');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $dragon = $this->service->updateFromArray($dragon, $data);
            $this->service->saveDragon($dragon);

            return new JsonResponse($dragon->toArray());
        }

        return new JsonResponse([
            'error' => [
                'error_messages' => $form->render(),
            ],
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $db = $this->service->getRepository();
        $dragon = $db->find($args['id']);
        $this->service->deleteDragon($dragon);
        return new JsonResponse(['deleted' => true]);
    }
}