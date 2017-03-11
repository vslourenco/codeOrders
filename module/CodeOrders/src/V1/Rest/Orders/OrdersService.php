<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 26/02/2017
 * Time: 10:02
 */

namespace CodeOrders\V1\Rest\Orders;


use CodeOrders\V1\Rest\Users\UsersRepository;
use Herrera\Json\Exception\Exception;
use Zend\Hydrator\ObjectProperty;

class OrdersService
{

    /**
     * @var OrdersRepository
     */
    private $repository;
    /**
     * @var UsersRepository
     */
    private $userRepository;

    public function __construct(OrdersRepository $repository, UsersRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function insert($data, $identity){

        $user = $this->userRepository->findByUsername($identity->getRoleId());

        if($user->getRole() != "salesman") {
            $hydrator = new ObjectProperty();
            $data = $hydrator->extract($data);

            $orderData = $data;
            unset($orderData['item']);

            $items = $data['item'];

            $tableGateway = $this->repository->getTableGateway();

            try {
                $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
                $orderId = $this->repository->insert($orderData);

                foreach ($items as $item) {
                    $item["order_id"] = $orderId;
                    $this->repository->insertItem($item);
                }

                $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
                return ["order_id" => $orderId];
            } catch (\Exception $e) {
                $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
                return "error";
            }
        }else{
            return new ApiProblem(403, "The user has not access to this function.");
        }
    }

    public function find($id, $identity){

        $user = $this->userRepository->findByUsername($identity->getRoleId());

        if($user->getRole() != "salesman"){
            $data = ['id'=>(int)$id, 'user_id'=>(int)$user->getId()];
            return $this->repository->find($data);
        }
        return $this->repository->find(['id'=>(int)$id]);

    }

    public function findAll($identity){
        $user = $this->userRepository->findByUsername($identity->getRoleId());

        if($user->getRole() != "salesman") {
            return $this->repository->findAll(['user_id'=>(int)$user->getId()]);
        }

        return $this->repository->findAll([]);
    }

}