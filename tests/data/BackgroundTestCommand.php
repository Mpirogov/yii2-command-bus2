<?php

namespace Mpirogov\bus\tests\data;

use Mpirogov\bus\Command;
use Mpirogov\bus\interfaces\BackgroundCommand;
use Mpirogov\bus\interfaces\SelfHandlingCommand;
use Mpirogov\bus\middlewares\BackgroundCommandTrait;
use yii\base\Object;

/**
 * Class BackgroundTestCommand
 * @package Mpirogov\bus\tests\data
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