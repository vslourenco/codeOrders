<?php
namespace CodeOrders\V1\Rest\Orders;

class OrdersResourceFactory
{
    public function __invoke($services)
    {
        $repository = $services->get("CodeOrders\V1\Rest\Orders\OrdersRepository");
        $orderService = $services->get("CodeOrders\V1\Rest\Orders\OrdersService");

        return new OrdersResource($repository, $orderService);
    }
}
