<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 27/02/2017
 * Time: 20:35
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\ObjectProperty;
use Zend\Paginator\Adapter\DbTableGateway;

class ProductsRepository
{

    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * ProductsRepository constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {

        $this->tableGateway = $tableGateway;
    }

    public function findAll(){
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);

        return new ProductsCollection($paginatorAdapter);
    }

    public function find($id){
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);

        return $resultSet->current();
    }

    public function insert($data){
        $hydator = new ObjectProperty();
        $data = $hydator->extract($data);

        return $this->tableGateway->insert($data);
    }

    public function update($id, $data){
        $hydator = new ObjectProperty();
        $data = $hydator->extract($data);

        return $this->tableGateway->update($data, ['id' => (int)$id]);
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if(!$result)
        {
            return new ApiProblem(404,'Registro não encontrado');
        }
        $this->tableGateway->delete(['id'=>(int)$id]);
        return true;
    }

}