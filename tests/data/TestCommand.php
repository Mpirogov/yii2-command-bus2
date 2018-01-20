<?php

namespace Mpirogov\bus\tests\data;

use Mpirogov\bus\interfaces\SelfHandlingCommand;
use yii\base\Object;

/**
 * Class TestCommand
 * @package Mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class TestCommand extends Object implements SelfHandlingCommand
{
    public function handle($command)
    {
        return 'test ok';
    }
}