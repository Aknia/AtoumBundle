<?php
namespace atoum\AtoumBundle\tests\units\Test\Asserters;

require_once __DIR__ . '/../../../bootstrap.php';

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use atoum\AtoumBundle\Test\Asserters\Integer as TestedClass;

class Integer extends atoum\test
{
    public function testClass()
    {
        $this->testedClass->isSubclassOf('\\mageekguy\\atoum\\asserters\\integer');
    }
}
