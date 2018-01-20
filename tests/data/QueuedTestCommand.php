<?php

namespace Mpirogov\bus\tests\data;

use Mpirogov\bus\interfaces\QueuedCommand;
use Mpirogov\bus\interfaces\SelfHandlingCommand;
use Mpirogov\bus\middlewares\QueuedCommandTrait;
use yii\base\Object;

/**
 * Class QueuedTestCommand
 * @package Mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class QueuedTestCommand extends Object implements SelfHandlingCommand, QueuedCommand
{
    use QueuedCommandTrait;

    public function handle($command)
    {
        \file_put_contents(\Yii::getAlias('@runtime/test.lock'), __CLASS__);
        return true;
    }
}
