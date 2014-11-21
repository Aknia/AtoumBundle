<?php
namespace atoum\AtoumBundle\tests\units\Test\Asserters;

require_once __DIR__ . '/../../../bootstrap.php';

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use atoum\AtoumBundle\Test\Asserters\RecursiveArray as TestedClass;

class RecursiveArray extends atoum\test
{
    public function testClass()
    {
        $this->testedClass->isSubclassOf('\\mageekguy\\atoum\\asserters\\phpArray');
    }

    public function test__construct()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->then
                ->object($object->getLocale())->isIdenticalTo($generator->getLocale())
                ->object($object->getGenerator())->isIdenticalTo($generator)
        ;
    }

    public function testHasArray()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->and($array = ['key' => []])
            ->and($object->setWith($array, true))
            ->then
                ->class($object->hasArray('key'))->isSubclassOf('\\mageekguy\\atoum\\asserters\\phpArray')
            ->if($array = ['key' => 'NotAnArray'])
            ->and($object->setWith($array, true))
            ->then
                ->exception(function () use ($object) {
                    $object->hasArray('key');
                })
                    ->isInstanceOf('mageekguy\atoum\asserter\exception')
        ;
    }

    public function testHasString()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->and($array = ['key' => 'string'])
            ->and($object->setWith($array, true))
            ->then
                ->class($object->hasString('key'))->isSubclassOf('\\mageekguy\\atoum\\asserters\\string')
            ->if($array = ['key' => []])
            ->and($object->setWith($array, true))
            ->then
                ->exception(function () use ($object) {
                    $object->hasString('key');
                })
                    ->isInstanceOf('mageekguy\atoum\asserter\exception')
        ;
    }

    public function testHasInteger()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->and($array = ['key' => 42])
            ->and($object->setWith($array, true))
            ->then
                ->class($object->hasInteger('key'))->isSubclassOf('\\mageekguy\\atoum\\asserters\\integer')
            ->if($array = ['key' => []])
            ->and($object->setWith($array, true))
            ->then
                ->exception(function () use ($object) {
                    $object->hasInteger('key');
                })
                    ->isInstanceOf('mageekguy\atoum\asserter\exception')
        ;
    }

    public function testHasFloat()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->and($array = ['key' => 42.12])
            ->and($object->setWith($array, true))
            ->then
                ->class($object->hasFloat('key'))->isSubclassOf('\\mageekguy\\atoum\\asserters\\float')
            ->if($array = ['key' => []])
            ->and($object->setWith($array, true))
            ->then
                ->exception(function () use ($object) {
                    $object->hasFloat('key');
                })
                    ->isInstanceOf('mageekguy\atoum\asserter\exception')
        ;
    }

    public function testHasNot()
    {
        $this
            ->if($object = new TestedClass($generator = new asserter\generator()))
            ->and($array = ['key' => 42.12])
            ->and($object->setWith($array, true))
            ->then
                ->class($object->hasNot('false_key'))->isSubclassOf('\\mageekguy\\atoum\\asserters\\phpArray')
            ->if($array = ['key' => []])
            ->and($object->setWith($array, true))
            ->then
                ->exception(function () use ($object) {
                    $object->hasNot('key');
                })
                    ->isInstanceOf('mageekguy\atoum\asserter\exception')
        ;
    }
}
