<?php
return [
    'router' => [
        'routes' => [
            'code-orders.rest.ptypes' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/ptypes[/:ptypes_id]',
                    'defaults' => [
                        'controller' => 'CodeOrders\\V1\\Rest\\Ptypes\\Controller',
                    ],
                ],
            ],
            'code-orders.rest.users' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/users[/:users_id]',
                    'defaults' => [
                        'controller' => 'CodeOrders\\V1\\Rest\\Users\\Controller',
                    ],
                ],
            ],
            'code-orders.rest.clients' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/clients[/:clients_id]',
                    'defaults' => [
                        'controller' => 'CodeOrders\\V1\\Rest\\Clients\\Controller',
                    ],
                ],
            ],
            'code-orders.rest.orders' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/orders[/:orders_id]',
                    'defaults' => [
                        'controller' => 'CodeOrders\\V1\\Rest\\Orders\\Controller',
                    ],
                ],
            ],
            'code-orders.rest.products' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/products[/:products_id]',
                    'defaults' => [
                        'controller' => 'CodeOrders\\V1\\Rest\\Products\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'code-orders.rest.ptypes',
            1 => 'code-orders.rest.users',
            2 => 'code-orders.rest.clients',
            3 => 'code-orders.rest.orders',
            4 => 'code-orders.rest.products',
        ],
    ],
    'zf-rest' => [
        'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => [
            'listener' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResource',
            'route_name' => 'code-orders.rest.ptypes',
            'route_identifier_name' => 'ptypes_id',
            'collection_name' => 'ptypes',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \CodeOrders\V1\Rest\Ptypes\PtypesEntity::class,
            'collection_class' => \CodeOrders\V1\Rest\Ptypes\PtypesCollection::class,
            'service_name' => 'ptypes',
        ],
        'CodeOrders\\V1\\Rest\\Users\\Controller' => [
            'listener' => \CodeOrders\V1\Rest\Users\UsersResource::class,
            'route_name' => 'code-orders.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \CodeOrders\V1\Rest\Users\UsersEntity::class,
            'collection_class' => \CodeOrders\V1\Rest\Users\UsersCollection::class,
            'service_name' => 'users',
        ],
        'CodeOrders\\V1\\Rest\\Clients\\Controller' => [
            'listener' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsResource',
            'route_name' => 'code-orders.rest.clients',
            'route_identifier_name' => 'clients_id',
            'collection_name' => 'clients',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => '5',
            'page_size_param' => null,
            'entity_class' => \CodeOrders\V1\Rest\Clients\ClientsEntity::class,
            'collection_class' => \CodeOrders\V1\Rest\Clients\ClientsCollection::class,
            'service_name' => 'clients',
        ],
        'CodeOrders\\V1\\Rest\\Orders\\Controller' => [
            'listener' => \CodeOrders\V1\Rest\Orders\OrdersResource::class,
            'route_name' => 'code-orders.rest.orders',
            'route_identifier_name' => 'orders_id',
            'collection_name' => 'orders',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \CodeOrders\V1\Rest\Orders\OrdersEntity::class,
            'collection_class' => \CodeOrders\V1\Rest\Orders\OrdersCollection::class,
            'service_name' => 'orders',
        ],
        'CodeOrders\\V1\\Rest\\Products\\Controller' => [
            'listener' => \CodeOrders\V1\Rest\Products\ProductsResource::class,
            'route_name' => 'code-orders.rest.products',
            'route_identifier_name' => 'products_id',
            'collection_name' => 'products',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \CodeOrders\V1\Rest\Products\ProductsEntity::class,
            'collection_class' => \CodeOrders\V1\Rest\Products\ProductsCollection::class,
            'service_name' => 'products',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Users\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Products\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'CodeOrders\\V1\\Rest\\Users\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'CodeOrders\\V1\\Rest\\Products\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
            ],
            'CodeOrders\\V1\\Rest\\Users\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
            'CodeOrders\\V1\\Rest\\Products\\Controller' => [
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \CodeOrders\V1\Rest\Ptypes\PtypesEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.ptypes',
                'route_identifier_name' => 'ptypes_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \CodeOrders\V1\Rest\Ptypes\PtypesCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.ptypes',
                'route_identifier_name' => 'ptypes_id',
                'is_collection' => true,
            ],
            \CodeOrders\V1\Rest\Users\UsersEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \CodeOrders\V1\Rest\Users\UsersCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ],
            \CodeOrders\V1\Rest\Clients\ClientsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.clients',
                'route_identifier_name' => 'clients_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \CodeOrders\V1\Rest\Clients\ClientsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.clients',
                'route_identifier_name' => 'clients_id',
                'is_collection' => true,
            ],
            \CodeOrders\V1\Rest\Orders\OrdersEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.orders',
                'route_identifier_name' => 'orders_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \CodeOrders\V1\Rest\Orders\OrdersCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.orders',
                'route_identifier_name' => 'orders_id',
                'is_collection' => true,
            ],
            \CodeOrders\V1\Rest\Products\ProductsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.products',
                'route_identifier_name' => 'products_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \CodeOrders\V1\Rest\Products\ProductsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.products',
                'route_identifier_name' => 'products_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-apigility' => [
        'db-connected' => [
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResource' => [
                'adapter_name' => 'DbAdapter',
                'table_name' => 'ptypes',
                'hydrator_name' => \Zend\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'CodeOrders\\V1\\Rest\\Ptypes\\Controller',
                'entity_identifier_name' => 'id',
            ],
            'CodeOrders\\V1\\Rest\\Clients\\ClientsResource' => [
                'adapter_name' => 'DbAdapter',
                'table_name' => 'clients',
                'hydrator_name' => \Zend\Hydrator\ArraySerializable::class,
                'controller_service_name' => 'CodeOrders\\V1\\Rest\\Clients\\Controller',
                'entity_identifier_name' => 'id',
                'table_service' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsResource\\Table',
            ],
        ],
    ],
    'zf-content-validation' => [
        'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => [
            'input_filter' => 'CodeOrders\\V1\\Rest\\Ptypes\\Validator',
        ],
        'CodeOrders\\V1\\Rest\\Clients\\Controller' => [
            'input_filter' => 'CodeOrders\\V1\\Rest\\Clients\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'CodeOrders\\V1\\Rest\\Ptypes\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '45',
                        ],
                    ],
                ],
            ],
        ],
        'CodeOrders\\V1\\Rest\\Clients\\Validator' => [
            0 => [
                'name' => 'name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '60',
                        ],
                    ],
                ],
            ],
            1 => [
                'name' => 'document',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '45',
                        ],
                    ],
                ],
            ],
            2 => [
                'name' => 'address',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '200',
                        ],
                    ],
                ],
            ],
            3 => [
                'name' => 'zipcode',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
            4 => [
                'name' => 'city',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '60',
                        ],
                    ],
                ],
            ],
            5 => [
                'name' => 'state',
                'required' => true,
                'filters' => [],
                'validators' => [],
            ],
            6 => [
                'name' => 'responsible',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '60',
                        ],
                    ],
                ],
            ],
            7 => [
                'name' => 'email',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '100',
                        ],
                    ],
                ],
            ],
            8 => [
                'name' => 'phone',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '15',
                        ],
                    ],
                ],
            ],
            9 => [
                'name' => 'obs',
                'required' => false,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => '65535',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            \CodeOrders\V1\Rest\Users\UsersResource::class => \CodeOrders\V1\Rest\Users\UsersResourceFactory::class,
            \CodeOrders\V1\Rest\Users\UsersRepository::class => \CodeOrders\V1\Rest\Users\UsersRepositoryFactory::class,
            \CodeOrders\V1\Rest\Orders\OrdersResource::class => \CodeOrders\V1\Rest\Orders\OrdersResourceFactory::class,
            'CodeOrders\\V1\\Rest\\Orders\\OrderItemTableGateway' => \CodeOrders\V1\Rest\Orders\OrderItemTableGatewayFactory::class,
            \CodeOrders\V1\Rest\Orders\OrdersRepository::class => \CodeOrders\V1\Rest\Orders\OrdersRepositoryFactory::class,
            \CodeOrders\V1\Rest\Orders\OrdersService::class => \CodeOrders\V1\Rest\Orders\OrdersServiceFactory::class,
            \CodeOrders\V1\Rest\Products\ProductsResource::class => \CodeOrders\V1\Rest\Products\ProductsResourceFactory::class,
            \CodeOrders\V1\Rest\Products\ProductsRepository::class => \CodeOrders\V1\Rest\Products\ProductsRepositoryFactory::class,
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'CodeOrders\\V1\\Rest\\Users\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
            ],
        ],
    ],
];
