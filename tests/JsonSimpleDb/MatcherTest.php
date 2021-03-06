<?php

namespace JsonSimpleDb;

class MatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testCompareOne()
    {
        $comparator = new Matcher(['id' => '1']);
        $this->assertFalse($comparator->match([]));
        $this->assertFalse($comparator->match(['id' => '2']));
        $this->assertTrue($comparator->match(['id' => '1']));
        $this->assertTrue($comparator->match([
            'id' => '1',
            'foo' => 'bar',
        ]));
    }

    public function testCompareStrict()
    {
        $comparator = new Matcher(['id' => 1]);
        $this->assertFalse($comparator->match(['id' => '1x']));
        $this->assertFalse($comparator->match(['id' => '1']));
        $this->assertTrue($comparator->match(['id' => 1]));
    }

    public function testCompareMultiple()
    {
        $comparator = new Matcher([
            'id' => '1',
            'category' => 'bar',
        ]);
        $this->assertFalse($comparator->match([]));
        $this->assertFalse($comparator->match(['id' => '1']));
        $this->assertFalse($comparator->match([
            'id' => '1',
            'category' => 'bat',
        ]));
        $this->assertFalse($comparator->match(['category' => 'bar']));
        $this->assertTrue($comparator->match([
            'id' => '1',
            'category' => 'bar',
        ]));
    }
}
