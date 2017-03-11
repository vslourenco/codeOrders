<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 09/03/2017
 * Time: 23:23
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Hydrator\ObjectProperty;
use Zend\Paginator\Adapter\DbTableGateway;

class ClientsRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll(){
        $tableGateway = $this->tableGateway;
        $paginatorAdapter = new DbTableGateway($tableGateway);

        return new ClientsCollection($paginatorAdapter);
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