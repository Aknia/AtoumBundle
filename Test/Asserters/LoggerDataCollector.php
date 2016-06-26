<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;

class LoggerDataCollector extends asserters\object
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Crawler  */
    private $parent;

    /**
     * @param mixed $value
     * @param bool  $checkType
     *
     * @return $this
     */
    public function setWith($value, $checkType = true)
    {
        parent::setWith($value, $checkType);

        if ($checkType === true) {
            if (self::isLoggerDataCollector($this->value) === false) {
                $this->fail(sprintf($this->getLocale()->_('%s is not a logger data collector'), $this));
            } else {
                $this->pass();
            }
        }

        return $this;
    }

    /**
     * Set parent
     *
     * @param \atoum\AtoumBundle\Test\Asserters\Profiler $parent
     */
    public function setParent(Profiler $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function countErrors()
    {
        $asserter = new Integer($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value->countErrors(), 'countErrors');
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function countDeprecations()
    {
        $asserter = new Integer($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value->countDeprecations(), 'countDeprecations');
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function countScreams()
    {
        $asserter = new Integer($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value->countScreams(), 'countScreams');
    }

    public function end()
    {
        return $this->parent;
    }

    private static function isLoggerDataCollector($value)
    {
        return ($value instanceof \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector);
    }
}
