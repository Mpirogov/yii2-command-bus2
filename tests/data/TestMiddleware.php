<?php

namespace mpirogov\bus\tests\data;

use mpirogov\bus\interfaces\Middleware;
use yii\base\BaseObject;

/**
 * Class TestMiddleware
 * @package mpirogov\bus\tests\data
 * @author Eugene Terentev <eugene@terentev.net>
 */
class TestMiddleware extends BaseObject implements Middleware
{

    public function execute($command, callable $next)
    {
        \Yii::info('middleware test 1 ok');
        $result = $next($command);
        \Yii::info('middleware test 2 ok');

        return $result;
    }
}
