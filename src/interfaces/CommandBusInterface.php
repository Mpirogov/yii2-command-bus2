<?php

namespace Mpirogov\bus\interfaces;

interface CommandBusInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
}
