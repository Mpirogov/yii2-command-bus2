<?php

namespace mpirogov\bus\middlewares;

use mpirogov\bus\CommandBus;
use yii\base\BaseObject;
use yii\di\Instance;
use yii\queue\Job;
use yii\queue\Queue;

/**
 *
 */
class QueuedJobWrapper extends BaseObject implements Job
{
    /**
     * @var mixed
     */
    public $command;

    /**
     * @var string|array
     */
    public $commandBus;

    /**
     * @param Queue $queue
     */
    public function execute($queue)
    {
        $commandBus = Instance::ensure($this->commandBus ?: CommandBus::class, CommandBus::class);
        $commandBus->handle($this->command);
    }
}
