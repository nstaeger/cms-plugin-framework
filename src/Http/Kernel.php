<?php

namespace Nstaeger\CmsPluginFramework\Http;

use InvalidArgumentException;
use Nstaeger\CmsPluginFramework\Database\DatabaseException;
use Nstaeger\CmsPluginFramework\Http\Exceptions\HttpException;
use Nstaeger\CmsPluginFramework\Http\Exceptions\HttpInternalErrorException;
use Nstaeger\CmsPluginFramework\Http\Exceptions\HttpNotFoundException;
use Nstaeger\CmsPluginFramework\Plugin;
use OpenCloud\Common\Exceptions\InvalidArgumentError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Kernel
{
    /**
     * @var ActionResolver
     */
    private $resolver;

    /**
     * @param ActionResolver $resolver
     */
    public function __construct(ActionResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Handle a request and transform it into a response.
     *
     * @param mixed $action
     * @return Response
     */
    public function handleRequest($action)
    {
        try {
            $callable = $this->getCallable($action);
            $response = $this->execute($callable);

            if (!$response instanceof Response) {
                throw new HttpInternalErrorException('Action did not return a proper Response.');
            }

            return $response;
        } catch (HttpException $e) {
            return new Response("Exception: " . $e->getMessage(), $e->getStatusCode());
        }
        catch (DatabaseException $e) {
            return new Response("DatabaseException: " . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        catch (InvalidArgumentException $e) {
            return new Response("InvalidArgumentException: " . $e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Execute the callable and handle the request.
     *
     * @param callable $callable
     * @return Response
     */
    private function execute($callable)
    {
        return $this->resolver->execute($callable);
    }

    /**
     * Transform the action into a callable.
     *
     * @param mixed $action
     * @return callable
     */
    private function getCallable($action)
    {
        try {
            return $this->resolver->resolveAction($action);
        } catch (InvalidArgumentException $e) {
            throw new HttpNotFoundException(
                sprintf('Unable to resolve action "%s": %s', $action, $e->getMessage()), $e
            );
        }
    }
}
