<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

namespace Mpirogov\bus\tests;

use Mpirogov\bus\tests\data\TestCommand;
use Mpirogov\bus\tests\data\TestHandler;
use Mpirogov\bus\tests\data\TestHandlerCommand;
use Mpirogov\bus\tests\data\TestMiddleware;

class CommandBusTest extends TestCase
{
    public function testCommand()
    {
        $result = $this->commandBus->handle(new TestCommand());
        $this->assertEquals('test ok', $result);
    }

    public function testMiddleware()
    {
        \Yii::getLogger()->flush();
        $this->commandBus->addMiddleware(new TestMiddleware());
        $result = $this->commandBus->handle(new TestCommand());
        $this->assertEquals('test ok', $result);
        $this->assertNotFalse(array_search('middleware test 1 ok', \Yii::$app->getLog()->logger->messages[1]));
        $this->assertNotFalse(array_search('middleware test 2 ok', \Yii::$app->getLog()->logger->messages[2]));
    }

    public function testHandler()
    {
        $this->commandBus->locator->addHandler(new TestHandler(), TestHandlerCommand::className());
        $result = $this->commandBus->handle(new TestHandlerCommand([
            'param' => 'test ok'
        ]));
        $this->assertEquals('test ok', $result);
    }
}
