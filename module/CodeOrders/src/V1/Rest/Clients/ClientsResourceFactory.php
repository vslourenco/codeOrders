<?php
namespace CodeOrders\V1\Rest\Clients;

class ClientsResourceFactory
{
    public function __invoke($services)
    {
        $userRepository = $services->get("CodeOrders\V1\Rest\Users\UsersRepository");
        $clientRepository = $services->get("CodeOrders\V1\Rest\Clients\ClientsRepository");

        return new ClientsResource($clientRepository, $userRepository);
    }
}
