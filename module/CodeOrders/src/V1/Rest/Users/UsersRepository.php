<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 19/02/2017
 * Time: 16:52
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;

class UsersRepository
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

        return new UsersCollection($paginatorAdapter);
    }

    public function find($id){
        $resultSet = $this->tableGateway->select(['id' => (int)$id]);

        return $resultSet->current();
    }

    public function insert($data){
        return $this->tableGateway->insert($data);
    }

    public function update($id, $data){
        $hydator = new UsersMapper();
        $data = $hydator->extract($data);

        return $this->tableGateway->update($data, ['id' => (int)$id]);
    }

    public function findByUsername($username){
        return $this->tableGateway->select(['username' => $username])->current();
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