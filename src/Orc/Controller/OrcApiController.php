<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Controller;

use BoneMvc\Module\Orc\Collection\OrcCollection;
use BoneMvc\Module\Orc\Form\OrcForm;
use BoneMvc\Module\Orc\Service\OrcService;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class OrcApiController
{
    /** @param OrcService $service */
    private $service;

    /**
     * @param OrcService $service
     */
    public function __construct(OrcService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $params = $request->getQueryParams();
        $limit = $params['limit'];
        $offset = $params['offset'];
        $db = $this->service->getRepository();
        $orcs = new OrcCollection($db->findBy([], null, $limit, $offset));
        $total = $db->getTotalOrcCount();
        $count = count($orcs);
        if ($count < 1) {
            throw new NotFoundException();
        }

        $payload['_embedded'] = $orcs->toArray();
        $payload['count'] = $count;
        $payload['total'] = $total;

        return new JsonResponse($payload);
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
        $post = json_decode($request->getBody()->getContents(), true) ?: $request->getParsedBody();
        $form = new OrcForm('create');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $orc = $this->service->createFromArray($data);
            $this->service->saveOrc($orc);

            return new JsonResponse($orc->toArray());
        }

        return new JsonResponse([
            'error' => $form->getErrorMessages(),
        ]);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function viewAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $orc = $this->service->getRepository()->find($args['id']);

        return new JsonResponse($orc->toArray());
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $db = $this->service->getRepository();
        $orc = $db->find($args['id']);

        $post = json_decode($request->getBody()->getContents(), true) ?: $request->getParsedBody();
        $form = new OrcForm('update');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $orc = $this->service->updateFromArray($orc, $data);
            $this->service->saveOrc($orc);

            return new JsonResponse($orc->toArray());
        }

        return new JsonResponse([
            'error' => $form->getErrorMessages(),
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
    public function deleteAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $db = $this->service->getRepository();
        $orc = $db->find($args['id']);
        $this->service->deleteOrc($orc);

        return new JsonResponse(['deleted' => true]);
    }
}
