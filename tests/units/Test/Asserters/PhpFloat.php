<?php
namespace atoum\AtoumBundle\tests\units\Test\Asserters;

require_once __DIR__ . '/../../../bootstrap.php';

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use atoum\AtoumBundle\Test\Asserters\Float as TestedClass;

class PhpFloat extends atoum\test
{
    public function testClass()
    {
        $this->testedClass->isSubclassOf('\\mageekguy\\atoum\\asserters\\phpFloat');
    }
}
