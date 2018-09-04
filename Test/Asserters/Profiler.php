<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;
use atoum\AtoumBundle\Test\Asserters\PhpString;
use atoum\AtoumBundle\Test\Asserters\PhpFloat;
use atoum\AtoumBundle\Test\Asserters\Integer;
use atoum\AtoumBundle\Test\Asserters\Boolean;
use atoum\AtoumBundle\Test\Asserters\Response;

class Profiler extends asserters\phpObject
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Profiler  */
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
            if (self::isProfile($this->value) === false) {
                $this->fail(sprintf($this->getLocale()->_('%s is not a profile'), $this));
            } else {
                $this->pass();
            }
        }

        return $this;
    }

    /**
     * Set parent
     *
     * @param Response $parent
     */
    public function setParent(Response $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\variable
     */
    public function logger()
    {
        $logger = $this->generator->getAsserterInstance('\\atoum\\AtoumBundle\\Test\\Asserters\\LoggerDataCollector', array($this->value->getCollector('logger')), $this->test);
        $logger->setParent($this);

        return $logger;
    }

    public function queryCount(int $expected)
    {
        $value = $this->value->getCollector('db')->getQueryCount();
        if ($value === $expected) {
            $this->pass();
        } else {
            $this->fail(sprintf($this->getLocale()->_($value .' is not equal to '. $expected), $this));
        }

        return $this;
    }

    // /**
    //  * @param string $key
    //  */
    // public function hasNot($key, $failMessage = null)
    // {
    //     if (!array_key_exists($key, $this->value)) {
    //         $this->pass();
    //     } else {
    //         $this->fail($failMessage ?: $this->_('key %s exists in array', $key));
    //     }
    //
    //     return $this;
    // }

    public function end()
    {
        return $this->parent;
    }

    private static function isProfile($value)
    {
        return ($value instanceof \Symfony\Component\HttpKernel\Profiler\Profile);
    }
}
