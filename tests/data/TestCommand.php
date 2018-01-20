<?php

namespace mpirogov\bus\tests\data;

use mpirogov\bus\interfaces\SelfHandlingCommand;
use yii\base\Object;

/**
 * Class TestCommand
 * @package mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class TestCommand extends Object implements SelfHandlingCommand
{
    public function handle($command)
    {
        return 'test ok';
    }
}