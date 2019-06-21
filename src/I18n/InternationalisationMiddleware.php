<?php declare(strict_types=1);

namespace BoneMvc\Module\I18n;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InternationalisationMiddleware implements MiddlewareInterface
{
    /** @var UrlHelper  */
    private $helper;

    /** @var string|null  */
    private $defaultLocale;

    /** @var string $fallbackLocale */
    private $fallbackLocale = 'en_US';

    const REGEX_LOCALE = '#^/(?P<locale>[a-z]{2,3}|[a-z]{2}[-_][a-zA-Z]{2})(?:/|$)#';

    /**
     * InternationalisationMiddleware constructor.
     * @param  $helper
     * @param string|null $defaultLocale
     */
    public function __construct($helper, string $defaultLocale = null)
    {
        $this->helper = $helper;
        if ($defaultLocale) {
            $this->defaultLocale = $defaultLocale;
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        var_dump($uri, $path);

        if (! preg_match(self::REGEX_LOCALE, $path, $matches)) {
//            Locale::setDefault($this->defaultLocale ?: $this->fallbackLocale);
            return $handler->handle($request);
        }
        $locale = $matches['locale'];
//        Locale::setDefault(Locale::canonicalize($locale));
        $this->helper->setBasePath($locale);

        $path = substr($path, strlen($locale) + 1);

        return $handler->handle($request->withUri(
            $uri->withPath($path ?: '/')
        ));
    }
}