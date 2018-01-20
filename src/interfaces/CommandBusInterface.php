<?php

namespace mpirogov\bus\interfaces;

interface CommandBusInterface
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
}
