<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;

class Integer extends asserters\integer
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Crawler  */
    private $parent;

    /**
     * Set parent
     *
     * @param $mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function end()
    {
        return $this->parent;
    }
}
