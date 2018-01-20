<?php

namespace Mpirogov\bus;

use Mpirogov\bus\interfaces\CommandBusInterface;
use Mpirogov\bus\interfaces\HandlerLocator;
use Mpirogov\bus\interfaces\Middleware;
use Mpirogov\bus\interfaces\SelfHandlingCommand;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use Mpirogov\bus\exceptions\MissingHandlerException;

/**
 * Class CommandBus
 * @package Mpirogov\bus
 */
class CommandBus extends Component implements CommandBusInterface
{
    /**
     * @var HandlerLocator|null
     */
    public $locator;
    /**
     * @var Middleware[]
     */
    protected $middlewares = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if ($this->locator) {
            $this->locator = Instance::ensure($this->locator, HandlerLocator::class);
        }
        parent::init();
    }

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $chain = $this->createMiddlewareChain($command, $this->middlewares);
        return $chain($command);
    }

    /**
     * @param $command
     * @param array $middlewareList
     * @return \Closure
     * @throws InvalidConfigException
     */
    protected function createMiddlewareChain($command, array $middlewareList) {

        $lastCallable = $this->createHandlerCallable($command);

        while ($middleware = array_pop($middlewareList)) {
            if (!$middleware instanceof Middleware) {
                throw new InvalidConfigException;
            }
            $lastCallable = function ($command) use ($middleware, $lastCallable) {
                return $middleware->execute($command, $lastCallable);
            };
        }
        return $lastCallable;
    }

    /**
     * @param $command
     * @return \Closure
     * @throws MissingHandlerException
     */
    protected function createHandlerCallable($command)
    {
        // Built-in self-handling locator
        if ($command instanceof SelfHandlingCommand) {
            $handler = $command;
        } else {
            $handler = $this->locator->locate($command, $this);
        }

        if (!$handler) {
            throw new MissingHandlerException('Handler not found');
        }

        $handlerMiddleware = function ($command) use ($handler) {
            return $handler->handle($command);
        };

        return $handlerMiddleware;
    }

    /**
     * @return array
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * @param array $middlewares
     */
    public function setMiddlewares($middlewares)
    {
        foreach ($middlewares as $k => $middleware) {
            $this->middlewares[$k] = Instance::ensure($middleware, Middleware::class);
        }
    }

    /**
     * @param Middleware $middleware
     */
    public function addMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
