<?php
declare(strict_types=1);

namespace App\Middleware\UnauthorizedHandler;

use Authorization\Exception\Exception;
use Authorization\Middleware\UnauthorizedHandler\RedirectHandler;
use Cake\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CustomRedirectHandler extends RedirectHandler
{
    /**
     * Handles the unauthorized request. The modified response should be returned.
     *
     * @param Exception $exception Authorization exception thrown by the application.
     * @param ServerRequest|ServerRequestInterface $request Server request.
     * @param array $options Options array.
     * @return ResponseInterface
     */
    public function handle(
        Exception $exception,
        ServerRequestInterface $request,
        array $options = []
    ): ResponseInterface {
        $response = parent::handle($exception, $request, $options);
        /** @phpstan-ignore-next-line */
        $request->getFlash()->error(sprintf(
            'You are not authorized to access "%s"',
            $request->getRequestTarget()
        ));

        return $response;
    }
}
