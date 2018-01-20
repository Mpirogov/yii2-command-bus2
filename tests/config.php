<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
return [

    'id' => 'testapp',
    'basePath' => __DIR__,
    'vendorPath' => dirname(__DIR__) . '/vendor',

    'controllerMap' => [
        'background-bus' => 'mpirogov\bus\console\BackgroundBusController',
        'queue-bus' => 'mpirogov\bus\console\QueueBusController',
    ],
    'components' => [
        'commandBus' => [
            'class' => 'mpirogov\bus\CommandBus',
            'locator' => 'mpirogov\bus\locators\ClassNameLocator',
            'middlewares' => [
                [
                    'class' => '\mpirogov\bus\middlewares\BackgroundCommandMiddleware',
                    'backgroundHandlerPath' => __DIR__ . '/yii.php',
                    'backgroundHandlerRoute' => 'background-bus/handle',
                    'backgroundHandlerArguments' => ['--interactive=0'],
                    'backgroundHandlerBinaryArguments' => ['-d foo=bar'],
                    'backgroundProcessTimeout' => 5
                ],
                [
                    'class' => '\mpirogov\bus\middlewares\QueuedCommandMiddleware'
                ],
                [
                    'class' => '\mpirogov\bus\middlewares\LoggingMiddleware',
                    'level' => 1,
                ],
            ],
        ],
        'queue' => [
            'class' => '\yii\queue\file\Queue',
            'path' => '@runtime/queue'
        ],
    ]
];
