<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 26/02/2017
 * Time: 10:03
 */

namespace CodeOrders\V1\Rest\Orders;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class OrdersServiceFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $orderRepository = $container->get('CodeOrders\V1\Rest\Orders\OrdersRepository');
        $userRepository = $container->get("CodeOrders\V1\Rest\Users\UsersRepository");
        $productRepository = $container->get("CodeOrders\V1\Rest\Products\ProductsRepository");

        return new OrdersService($orderRepository, $userRepository, $productRepository);
    }
}