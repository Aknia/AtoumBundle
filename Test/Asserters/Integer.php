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
     * @param asserter\generator $generator
     * @param Crawler|Element    $parent
     */
    public function __construct(asserter\generator $generator, $parent)
    {
        parent::__construct($generator);

        $this->parent = $parent;
    }

    public function end()
    {
        return $this->parent;
    }
}
