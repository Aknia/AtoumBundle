<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;

class RecursiveArray extends asserters\phpArray
{
    /**
     * @param string $key
     *
     * @return RecursiveArray
     */
    public function hasArray($key)
    {
        $asserter = new RecursiveArray($this->generator);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function hasInteger($key)
    {
        $asserter = new asserters\integer($this->generator);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\float
     */
    public function hasFloat($key)
    {
        $asserter = new asserters\float($this->generator);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\string
     */
    public function hasString($key)
    {
        $asserter = new asserters\string($this->generator);

        return $asserter->setWith($this->value[$key], $key);
    }
}
