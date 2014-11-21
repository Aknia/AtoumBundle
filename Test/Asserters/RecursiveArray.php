<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;
use atoum\AtoumBundle\Test\Asserters\String;
use atoum\AtoumBundle\Test\Asserters\Float;
use atoum\AtoumBundle\Test\Asserters\Integer;

class RecursiveArray extends asserters\phpArray
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Crawler  */
    private $parent;

    /**
     * @param asserter\generator $generator
     * @param Crawler|Element    $parent
     */
    public function __construct(asserter\generator $generator, $parent = null)
    {
        parent::__construct($generator);

        $this->parent = $parent;
    }

    /**
     * @param string $key
     *
     * @return RecursiveArray
     */
    public function hasArray($key)
    {
        $asserter = new RecursiveArray($this->generator, $this);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function hasInteger($key)
    {
        $asserter = new Integer($this->generator, $this);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\float
     */
    public function hasFloat($key)
    {
        $asserter = new Float($this->generator, $this);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\string
     */
    public function hasString($key)
    {
        $asserter = new String($this->generator, $this);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     */
    public function hasNot($key, $failMessage = null)
    {
        if (!array_key_exists($key, $this->value)) {
            $this->pass();
        } else {
            $this->fail($failMessage ?: $this->_('key %s exists in array', $key));
        }

        return $this;
    }

    public function end()
    {
        return $this->parent;
    }
}
