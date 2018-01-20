<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
return [

    'id' => 'testapp',
    'basePath' => __DIR__,
    'vendorPath' => dirname(__DIR__) . '/vendor',

    'controllerMap' => [
        'background-bus' => 'Mpirogov\bus\console\BackgroundBusController',
        'queue-bus' => 'Mpirogov\bus\console\QueueBusController',
    ],
    'components' => [
        'commandBus' => [
            'class' => 'Mpirogov\bus\CommandBus',
            'locator' => 'Mpirogov\bus\locators\ClassNameLocator',
            'middlewares' => [
                [
                    'class' => '\Mpirogov\bus\middlewares\BackgroundCommandMiddleware',
                    'backgroundHandlerPath' => __DIR__ . '/yii.php',
                    'backgroundHandlerRoute' => 'background-bus/handle',
                    'backgroundHandlerArguments' => ['--interactive=0'],
                    'backgroundHandlerBinaryArguments' => ['-d foo=bar'],
                    'backgroundProcessTimeout' => 5
                ],
                [
                    'class' => '\Mpirogov\bus\middlewares\QueuedCommandMiddleware'
                ],
                [
                    'class' => '\Mpirogov\bus\middlewares\LoggingMiddleware',
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
