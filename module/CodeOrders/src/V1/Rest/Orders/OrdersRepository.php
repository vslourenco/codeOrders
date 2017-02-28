<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 24/02/2017
 * Time: 22:15
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Hydrator\ClassMethods;
use Zend\Paginator\Adapter\ArrayAdapter;

class OrdersRepository
{

    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;
    /**
     * @var AbstractTableGateway
     */
    private $orderItemTableGateway;

    public function __construct(AbstractTableGateway $tableGateway, AbstractTableGateway $orderItemTableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->orderItemTableGateway = $orderItemTableGateway;
    }

    public function findAll(){
        $orders = $this->tableGateway->select();
        $res = [];
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));

        foreach ($orders as $order){
            $items = $this->orderItemTableGateway->select(['order_id' => $order->getId()]);

            foreach ($items as $item){
                $order->addItem($item);
            }

            $data = $hydrator->extract($order);
            $res[] = $data;

            $arrayAdapter = new ArrayAdapter($res);

            $ordersCollection = new OrdersCollection($arrayAdapter);
        }

        return $res;
    }

    public function insert(array $data){

        $this->tableGateway->insert($data);
        $id = $this->tableGateway->getLastInsertValue();

        return $id;
    }

    public function insertItem(array $data){

        $this->orderItemTableGateway->insert($data);

        return $this->orderItemTableGateway->getLastInsertValue();
    }

    public function getTableGateway(){
        return $this->tableGateway;
    }
}