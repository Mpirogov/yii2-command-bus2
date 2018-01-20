<?php

namespace mpirogov\bus\tests\data;
use mpirogov\bus\interfaces\Command;
use mpirogov\bus\interfaces\Handler;
use yii\base\Object;


/**
 * Class TestHandler
 * @package mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class TestHandler extends Object implements Handler
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        return $command->param;
    }
}