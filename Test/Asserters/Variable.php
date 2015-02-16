<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;

class Variable extends asserters\variable
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Crawler  */
    private $parent;

    /**
     * Set parent
     *
     * @param \atoum\AtoumBundle\Test\Asserters\RecursiveArray $parent
     */
    public function setParent(RecursiveArray $parent)
    {
        $this->parent = $parent;
    }

    public function end()
    {
        return $this->parent;
    }
}
