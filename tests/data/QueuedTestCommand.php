<?php

namespace mpirogov\bus\tests\data;

use mpirogov\bus\interfaces\QueuedCommand;
use mpirogov\bus\interfaces\SelfHandlingCommand;
use mpirogov\bus\middlewares\QueuedCommandTrait;
use yii\base\Object;

/**
 * Class QueuedTestCommand
 * @package mpirogov\bus\tests\data
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
