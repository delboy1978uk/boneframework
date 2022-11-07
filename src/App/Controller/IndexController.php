<?php

namespace Bone\App\Controller;

use Bone\Controller\Controller;
use Bone\Http\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
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
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $body = $this->view->render('app::index');

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function listings(ServerRequestInterface $request): ResponseInterface
    {
        $body = [
            [
                'id' => '201',
                'title' => 'Red jacket',
                'images' => [
                    '0' => [
                        'url' => 'https://github.com/delboy1978uk/react-native-course/blob/274f3d22b0750009b09720084d86818e326fccb7/app/assets/couch.jpg?raw=true',
                    ],
                ],
                'price' => '100',
                'categoryId' => '5',
                'userId' => '1',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '3',
                'title' => 'Gray couch in a great condition',
                'images' => [
                    '0' => [
                        'fileName' => 'couch2',
                    ],
                ],
                'categoryId' => '1',
                'price' => '1200',
                'userId' => '2',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '1',
                'title' => 'Room & Board couch (great condition) - delivery included',
                'description' => 'I\'m selling my furniture at a discount price. Pick up at Venice. DM me asap.',
                'images' => [
                    '0' => [
                        'fileName' => 'couch1',
                    ],
                    '1' => [
                        'fileName' => 'couch2',
                    ],
                    '2' => [
                        'fileName' => 'couch3',
                    ],
                ],
                'price' => '1000',
                'categoryId' => '1',
                'userId' => '1',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '2',
                'title' => 'Designer wear shoes',
                'images' => [
                    '0' => [
                        'fileName' => 'shoes1',
                    ],
                ],
                'categoryId' => '5',
                'price' => '100',
                'userId' => '2',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '102',
                'title' => 'Canon 400D (Great Condition)',
                'images' => [
                    '0' => [
                        'fileName' => 'camera1',
                    ],
                ],
                'price' => '300',
                'categoryId' => '3',
                'userId' => '1',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '101',
                'title' => 'Nikon D850 for sale',
                'images' => [
                    '0' => [
                        'fileName' => 'camera2',
                    ],
                ],
                'price' => '350',
                'categoryId' => '3',
                'userId' => '1',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '4',
                'title' => 'Sectional couch - Delivery available',
                'description' => 'No rips no stains no odors',
                'images' => [
                    '0' => [
                        'fileName' => 'couch3',
                    ],
                ],
                'categoryId' => '1',
                'price' => '950',
                'userId' => '2',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ], [
                'id' => '6',
                'title' => 'Brown leather shoes',
                'images' => [
                    '0' => [
                        'fileName' => 'shoes2',
                    ],
                ],
                'categoryId' => '5',
                'price' => '50',
                'userId' => '2',
                'location' => [
                    'latitude' => '37.78825',
                    'longitude' => '-122.4324',
                ],
            ],
        ];

        return new JsonResponse($body);
    }
}
