<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Sonata\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\FieldDescriptionInterface;

class FieldDescriptionCollection implements \ArrayAccess, \Countable
{
    protected $elements = array();

    /**
     * @param \Sonata\AdminBundle\Admin\FieldDescriptionInterface $fieldDescription
     * @return void
     */
    public function add(FieldDescriptionInterface $fieldDescription)
    {
        $this->elements[$fieldDescription->getName()] = $fieldDescription;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->elements);
    }

    /**
     * @throws \InvalidArgumentException
     * @param string $name
     * @return array
     */
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->elements[$name];
        }

        throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        if ($this->has($name)) {
            unset($this->elements[$name]);
        }
    }

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new \RunTimeException('Cannot set value, use add');
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function count()
    {
        return count($this->elements);
    }
}