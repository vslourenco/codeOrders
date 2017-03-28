<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 26/02/2017
 * Time: 10:02
 */

namespace CodeOrders\V1\Rest\Orders;


use CodeOrders\V1\Rest\Products\ProductsRepository;
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
    /**
     * @var ProductsRepository
     */
    private $productRepository;

    public function __construct(OrdersRepository $repository, UsersRepository $userRepository, ProductsRepository $productRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }

    public function insert($data, $identity){

        $user = $this->userRepository->findByUsername($identity->getRoleId());

        if($user->getRole() != "salesman") {
            $hydrator = new ObjectProperty();
            date_default_timezone_set('Europe/Istanbul');
            $data->user_id = $this->userRepository->getAuthenticated()->getId();
            $data->created_at = (new \DateTime())->format("Y-m-d");
            $data->total = 0;
            $items = $data->item;
            unset($data->item);

            $orderData = $hydrator->extract($data);

            $tableGateway = $this->repository->getTableGateway();

            try {
                $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
                $orderId = $this->repository->insert($orderData);

                $total = 0;
                foreach ($items as $key=>$item) {
                    $product = $this->productRepository->find($item['product_id']);
                    $item["order_id"] = $orderId;
                    $item["price"] = $product["price"];
                    $item["total"] = $item[$key]["total"] = $item["quantity"] * $item["price"];
                    $total += $item["total"];

                    $this->repository->insertItem($item);
                }

                $this->repository->update($orderId, ["total", $total]);
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