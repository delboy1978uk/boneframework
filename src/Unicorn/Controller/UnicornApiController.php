<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Controller;

use BoneMvc\Module\Unicorn\Collection\UnicornCollection;
use BoneMvc\Module\Unicorn\Form\UnicornForm;
use BoneMvc\Module\Unicorn\Service\UnicornService;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class UnicornApiController
{
    /** @param UnicornService $service */
    private $service;

    /**
     * @param UnicornService $service
     */
    public function __construct(UnicornService $service)
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
        $unicorns = new UnicornCollection($db->findBy([], null, $limit, $offset));
        $total = $db->getTotalUnicornCount();
        $count = count($unicorns);
        if ($count < 1) {
            throw new NotFoundException();
        }

        $payload['_embedded'] = $unicorns->toArray();
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
        $form = new UnicornForm('create');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $unicorn = $this->service->createFromArray($data);
            $this->service->saveUnicorn($unicorn);

            return new JsonResponse($unicorn->toArray());
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
        $unicorn = $this->service->getRepository()->find($args['id']);

        return new JsonResponse($unicorn->toArray());
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
        $unicorn = $db->find($args['id']);

        $post = json_decode($request->getBody()->getContents(), true) ?: $request->getParsedBody();
        $form = new UnicornForm('update');
        $form->populate($post);

        if ($form->isValid()) {
            $data = $form->getValues();
            $unicorn = $this->service->updateFromArray($unicorn, $data);
            $this->service->saveUnicorn($unicorn);

            return new JsonResponse($unicorn->toArray());
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
        $unicorn = $db->find($args['id']);
        $this->service->deleteUnicorn($unicorn);

        return new JsonResponse(['deleted' => true]);
    }
}
