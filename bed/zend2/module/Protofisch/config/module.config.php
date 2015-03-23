<?php
return array(
  'controllers' => array(
    'invokables' => array(
      'Protofisch\Controller\Protofisch' => 'Protofisch\Controller\ProtofischController',
    ),
  ),

  // Routers
  'router' => array(
    'routes' => array(
      'protofisch' => array(
        'type'    => 'segment',
        'options' => array(
          'route'    => '/protofisch[/:action][/:id]',
          'constraints' => array(
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id'     => '[0-9]+',
          ),
          'defaults' => array(
            'controller' => 'Protofisch\Controller\Protofisch',
            'action'     => 'index',
          ),
        ),
      ),
    ),
  ),

  'view_manager' => array(
    'template_map' => array(
      'layout/protofisch' => __DIR__ . '/../view/layout/protofisch.phtml', 
    ),
    'template_path_stack' => array(
      'protofisch' => __DIR__ . '/../view',
    )
  ),
);