<?php

namespace Socialog\Model;

use Socialog\Stdlib\Hydrator\ModelHydrator;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Standard Model
 */
abstract class AbstractModel implements InputFilterAwareInterface
{
    /**
     * @var InputFilterInterface
     */
    protected $inputFilter;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    public function isValid()
    {
        // TODO
    }

    /**
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter instanceof InputFilterInterface
            && is_array($this->inputFilter)) {

            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            foreach ($this->inputFilter as $name => $config) {
                $config['name'] = $name;
                $inputFilter->add($factory->createInput($config));
            }

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    /**
     * @param InputFilterInterface $inputFilter
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (null == $this->hydrator) {
            $this->hydrator = new ModelHydrator;
        }

        return $this->hydrator;
    }

    /**
     * @param HydratorInterface $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->getHydrator()->extract($this);
    }

    /**
     * @param array $data
     */
    public function fromArray(array $data)
    {
        $this->getHydrator()->hydrate($data, $this);
    }
}
