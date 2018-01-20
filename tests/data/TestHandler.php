<?php

namespace Mpirogov\bus\tests\data;
use Mpirogov\bus\interfaces\Command;
use Mpirogov\bus\interfaces\Handler;
use yii\base\Object;


/**
 * Class TestHandler
 * @package Mpirogov\bus\tests\data
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