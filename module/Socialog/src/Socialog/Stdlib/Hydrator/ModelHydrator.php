<?php

namespace Socialog\Stdlib\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Hydrating models
 *
 * TODO Think of another way to ignore fields
 */
class ModelHydrator extends ClassMethods
{
    protected $ignoredFields = array();

    public function __construct()
    {
        parent::__construct(true);

        // Add ignored fields
        $this->ignoredFields[] = 'hydrator';
        $this->ignoredFields[] = 'input_filter';

        foreach ($this->ignoredFields as $field) {
            $this->addStrategy($field, new Strategy\NullStrategy());
        }
    }

    /**
     * Extract while filtering the ignored fields
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        $return = parent::extract($object);

        foreach ($this->ignoredFields as $field) {
            unset($return[$field]);
        }

        return $return;
    }

    /**
     * Hydrate while removing the ignoredFields
     *
     * @param  array  $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        foreach ($this->ignoredFields as $field) {
            unset($data[$field]);
        }

        $return = parent::hydrate($data, $object);

        return $return;
    }
}
