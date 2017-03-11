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
use Zend\Hydrator\ObjectProperty;
use Zend\Paginator\Adapter\ArrayAdapter;
use ZF\ApiProblem\ApiProblem;

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

    public function findAll($data){
        $orders = $this->tableGateway->select($data);
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

    public function find($data){

        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));

        $resultSet = $this->tableGateway->select($data);

        if($resultSet->count()>0) {
            $order = $resultSet->current();
            $items = $this->orderItemTableGateway->select(['order_id' => (int)$data["id"]]);

            foreach ($items as $item) {
                $order->addItem($item);
            }

            return $hydrator->extract($order);
        }

        return new ApiProblem(403, "The user has not access to this info.");
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

    public function update($id, $data){
        $hydrator = new ObjectProperty();

        $data = $hydrator->extract($data);

        $items = $data["item"];
        unset($data["item"]);

        $this->deleteItem($id);

        foreach ($items as $item){
            $item["order_id"] = $id;
            $this->insertItem($item);
        }

        return $this->tableGateway->update($data, ['id' => (int)$id]);
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if(!$result)
        {
            return new ApiProblem(404,'Registro não encontrado');
        }
        if(!$this->deleteItem($id)){
            return new ApiProblem(404,'Não foi possível remover os itens do pedido!');
        }
        $this->tableGateway->delete(['id'=>(int)$id]);
        return true;
    }

    public function deleteItem($id)
    {
        $this->orderItemTableGateway->delete(['order_id' => (int)$id]);
        return true;
    }

    public function getTableGateway(){
        return $this->tableGateway;
    }
}