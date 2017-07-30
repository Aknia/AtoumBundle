<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;

class LoggerDataCollector extends asserters\phpObject
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Profiler  */
    private $parent;

    private $logStatistics;

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

        return $asserter->setWith($this->computeErrorsCount()['error_count'], 'countErrors');
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

        return $asserter->setWith($this->computeErrorsCount()['deprecation_count'], 'countDeprecations');
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

        return $asserter->setWith($this->computeErrorsCount()['scream_count'], 'countScreams');
    }

    public function end()
    {
        return $this->parent;
    }

    private static function isLoggerDataCollector($value)
    {
        return ($value instanceof \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector);
    }

    private function computeErrorsCount()
    {
        if ($this->logStatistics) return $this->logStatistics;

        $count = array(
            'error_count' => 0,
            'deprecation_count' => 0,
            'scream_count' => 0,
            'priorities' => array(),
        );

        foreach ($this->value->getLogs() as $log) {
            if (isset($count['priorities'][$log['priority']])) {
                ++$count['priorities'][$log['priority']]['count'];
            } else {
                $count['priorities'][$log['priority']] = array(
                    'count' => 1,
                    'name' => $log['priorityName'],
                );
            }

            if ($log['priorityName'] === 'ERROR') {
                ++$count['error_count'];
            }

            if (isset($log['context']['type'], $log['context']['level'])) {
                if (E_DEPRECATED === $log['context']['type'] || E_USER_DEPRECATED === $log['context']['type']) {
                    ++$count['deprecation_count'];
                } elseif (!($log['context']['type'] & $log['context']['level'])) {
                    ++$count['scream_count'];
                }
            }
        }

        ksort($count['priorities']);

        $this->logStatistics = $count;

        return $count;
    }
}
