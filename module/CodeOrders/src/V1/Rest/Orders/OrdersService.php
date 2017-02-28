<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 26/02/2017
 * Time: 10:02
 */

namespace CodeOrders\V1\Rest\Orders;


use Herrera\Json\Exception\Exception;
use Zend\Hydrator\ObjectProperty;

class OrdersService
{

    /**
     * @var OrdersRepository
     */
    private $repository;

    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert($data){

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
        }catch (\Exception $e){
            $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            return "error";
        }
    }

}