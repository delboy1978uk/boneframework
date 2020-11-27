<?php

namespace Bone\App\Controller;

use Bone\Controller\Controller;
use Bone\Http\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 * If you need to create a constructor, edit the package class to set it  up automatically via dependency injection
 *
 * The below annotations are for use with delboy1978uk/bone-open-api, you can remove them if you wont be using it
 * @OA\Info(
 *     version="1.0.0",
 *     title="Bone Framework API",
 *     description="This be a swashbucklin' API."
 * )
 * @OA\ExternalDocumentation(
 *     description="By delboy1978uk",
 *     url="https://github.com/delboy1978uk/boneframework"
 * )
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     name="bone-oauth2",
 *     securityScheme="bone-oauth2",
 *     @OA\Flow(
 *         flow="authorizationCode",
 *         authorizationUrl="https://awesome.scot/oauth2/authorize",
 *         scopes={
 *             "basic": "Access public API data",
 *             "register-client": "Create and rewgistger clients",
 *         }
 *     )
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="api_key"
 * )
 */
class IndexController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request) : ResponseInterface
    {
        $body = $this->view->render('app::index');

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function learn(ServerRequestInterface $request) : ResponseInterface
    {
        $body = $this->view->render('app::learn');

        return new HtmlResponse($body);
    }
}
