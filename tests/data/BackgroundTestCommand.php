<?php

namespace mpirogov\bus\tests\data;

use mpirogov\bus\Command;
use mpirogov\bus\interfaces\BackgroundCommand;
use mpirogov\bus\interfaces\SelfHandlingCommand;
use mpirogov\bus\middlewares\BackgroundCommandTrait;
use yii\base\Object;

/**
 * Class BackgroundTestCommand
 * @package mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class BackgroundTestCommand extends Object implements BackgroundCommand, SelfHandlingCommand
{
    use BackgroundCommandTrait;

    public $sleep = 1;

    public function handle($command)
    {
        sleep($this->sleep);
        echo 'test ok';
    }
}