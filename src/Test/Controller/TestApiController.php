<?php

declare(strict_types=1);

namespace BoneMvc\Module\Test\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class TestApiController
{
    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        return new JsonResponse([
            'drink' => 'grog',
            'pieces' => 'of eight',
            'shiver' => 'me timbers',
        ]);
    }
}
