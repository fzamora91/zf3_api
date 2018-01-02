<?php
namespace Usuarios;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;



return [
    'controllers' => [
        'factories' => [
            Controller\UsuarioController::class => Controller\ControllerFactory::class,
            Controller\FooController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'usuarios' => [
                'type'    => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/usuarios[/:action]',
                    'defaults' => [
                        'controller'    => Controller\UsuarioController::class,
                        'action'        => 'listar',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'usuarios' => __DIR__ . '/../view',
        ],
    ],
];
