<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 25/02/2017
 * Time: 21:17
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\Authentication\Adapter\DbTable\Exception\RuntimeException;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\Strategy\StrategyInterface;

class OrderItemHydratorStrategy implements StrategyInterface
{

    /**
     * @var ClassMethods
     */
    private $hydrator;

    public function __construct(ClassMethods $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @param object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($items)
    {
        $data = [];

        foreach ($items as $item){
            $data[] = $this->hydrator->extract($item);
        }

        return $data;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @param array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        throw new RuntimeException('Hydration is not supported.');
    }
}