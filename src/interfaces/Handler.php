<?php

namespace mpirogov\bus\interfaces;

/**
 * Interface Handler
 *
 * @author Eugene Terentev <eugene@terentev.net>
 */
interface Handler
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);
}
