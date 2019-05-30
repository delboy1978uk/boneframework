<?php

namespace BoneMvc\Module\Dragon\Controller;

use BoneMvc\Module\Dragon\Entity\Dragon;
use BoneMvc\Module\Dragon\Form\DragonForm;
use BoneMvc\Module\Dragon\Service\DragonService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DragonController
{
    /** @var DragonService */
    public $service;

    /**
     * @param DragonService $service
     */
    public function __construct(DragonService $service)
    {
        $this->service = $service;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface $response
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $post = $this->getJsonPost($request);
        $form = new DragonForm('create');
        $form->populate($post);
        if ($form->isValid()) {
            $data = $form->getValues();
            $dragon = $this->service->createFromArray($data);
            $this->service->saveDragon($dragon);

            return $this->jsonResponse($response, $dragon->toArray());
        } else {
            // handle errors
        }
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface $response
     */
    public function read(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface $response
     */
    public function update(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface $response
     */
    public function delete(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
    }

    /**
     * @param RequestInterface $request
     * @return array
     */
    protected function getJsonPost(RequestInterface $request): array
    {
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @param array $data
     * @return ResponseInterface $response
     */
    public function jsonResponse(ResponseInterface $response, array $data): ResponseInterface
    {
        $json = json_encode($data);
        // create proper $response later
        header('Content-Type: application/json');
        echo $json;
        exit;
    }
}
