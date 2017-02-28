<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 19/02/2017
 * Time: 16:29
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Hydrator\HydratorInterface;

class UsersMapper extends UsersEntity implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'id' => $object->id,
            'username' => $object->username,
            'password' => $object->password,
            'first_name' => $object->first_name,
            'last_name' => $object->last_name,
            'role' => $object->role
        ];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $object->id = $data['id'];
        $object->username = $data['username'];
        $object->password = $data['password'];
        $object->first_name = $data['first_name'];
        $object->last_name = $data['last_name'];
        $object->role = $data['role'];

        return $object;
    }
}