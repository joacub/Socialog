<?php

namespace Socialog\Mapper;

use InvalidArgumentException;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;

abstract class AbstractDbMapper extends AbstractMapper
{
    /**
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @var object
     */
    protected $entityPrototype;

    /**
     * @var HydratingResultSet
     */
    protected $resultSetPrototype;

    /**
     * @var Select
     */
    protected $selectPrototype;

    /**
     * @param  Select             $select
     * @return HydratingResultSet
     */
    public function selectWith(Select $select, $entityPrototype = null, HydratorInterface $hydrator = null)
    {
        $adapter = $this->getDbAdapter();
        $statement = $adapter->createStatement();
        $select->prepareStatement($adapter, $statement);
        $result = $statement->execute();

        $resultSet = $this->getResultSet();

        if (isset($entityPrototype)) {
            $resultSet->setObjectPrototype($entityPrototype);
        }

        if (isset($hydrator)) {
            $resultSet->setHydrator($hydrator);
        }

        $resultSet->initialize($result);

        return $resultSet;
    }

    /**
     *
     * @param Select $select
     * @param $entityPrototype
     */
    public function selectSingle(Select $select, $entityPrototype = null, HydratorInterface $hydrator = null)
    {
        $adapter = $this->getDbAdapter();
        $statement = $adapter->createStatement();
        $select->prepareStatement($adapter, $statement);
        $result = $statement->execute();

        if (!$hydrator) {
            $hydrator = $this->getHydrator();
        }

        if (!$entityPrototype) {
            $entityPrototype = $this->getEntityPrototype();
        }

        $current = $result->current();

        if (!is_array($current)) {
            return null;
        }

        return $hydrator->hydrate($current, $entityPrototype);
    }

    /**
     * @param  object|array      $entity
     * @param  string            $tableName
     * @param  HydratorInterface $hydrator
     * @return ResultInterface
     */
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $tableName = $tableName ?: $this->tableName;

        $rowData = $this->entityToArray($entity, $hydrator);

        $sql = new Sql($this->getDbAdapter(), $tableName);
        $insert = $sql->insert();
        $insert->values($rowData);

        $statement = $sql->prepareStatementForSqlObject($insert);

        return $statement->execute();
    }

    /**
     * @param  object|array         $entity
     * @param  string|array|closure $where
     * @param  string               $tableName
     * @param  HydratorInterface    $hydrator
     * @return mixed
     */
    public function update($entity, $where, $tableName = null, HydratorInterface $hydrator = null)
    {
        $tableName = $tableName ?: $this->tableName;

        $rowData = $this->entityToArray($entity, $hydrator);
        $sql = new Sql($this->getDbAdapter(), $tableName);

        $update = $sql->update();
        $update->set($rowData);
        $update->where($where);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        return $result->getAffectedRows();
    }

    /**
     * @return object
     */
    public function getEntityPrototype()
    {
        if (is_string($this->entityPrototype)) {
            $this->entityPrototype = new $this->entityPrototype();
        }

        return $this->entityPrototype;
    }

    /**
     * @param  object           $modelPrototype
     * @return AbstractDbMapper
     */
    public function setEntityPrototype($entityPrototype)
    {
        $this->entityPrototype = $entityPrototype;
        $this->resultSetPrototype = null;

        return $this;
    }

    /**
     * @return Adapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param  Adapter          $dbAdapter
     * @return AbstractDbMapper
     */
    public function setDbAdapter(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;

        return $this;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new ClassMethods(true);
        }

        return $this->hydrator;
    }

    /**
     * @param  HydratorInterface $hydrator
     * @return AbstractDbMapper
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
        $this->resultSetPrototype = null;

        return $this;
    }

    /**
     * @return HydratingResultSet
     */
    protected function getResultSet()
    {
        if (!$this->resultSetPrototype) {
            $this->resultSetPrototype = new HydratingResultSet;
            $this->resultSetPrototype->setHydrator($this->getHydrator());
            $this->resultSetPrototype->setObjectPrototype($this->getEntityPrototype());
        }

        return clone $this->resultSetPrototype;
    }

    /**
     * select
     *
     * @return Select
     */
    public function select()
    {
        if (!$this->selectPrototype) {
            $this->selectPrototype = new Select($this->tableName);
        }

        return clone $this->selectPrototype;
    }

    /**
     * Uses the hydrator to convert the entity to an array.
     *
     * Use this method to ensure that you're working with an array.
     *
     * @param  object $entity
     * @return array
     */
    protected function entityToArray($entity, HydratorInterface $hydrator = null)
    {
        if (is_array($entity)) {
            return $entity; // cut down on duplicate code
        } elseif (is_object($entity)) {
            if (!$hydrator) {
                $hydrator = $this->getHydrator();
            }

            return $hydrator->extract($entity);
        }
        throw new InvalidArgumentException('Entity passed to db mapper should be an array or object.');
    }
}
