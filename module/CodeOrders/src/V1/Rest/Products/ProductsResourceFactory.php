<?php
namespace CodeOrders\V1\Rest\Products;

class ProductsResourceFactory
{
    public function __invoke($services)
    {
        $productRepository = $services->get('CodeOrders\V1\Rest\Products\ProductsRepository');
        $userRepository = $services->get("CodeOrders\V1\Rest\Users\UsersRepository");

        return new ProductsResource($productRepository, $userRepository);
    }
}
