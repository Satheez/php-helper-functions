<?php

use PHPUnit\Framework\TestCase;
use Sa\Helper\Arr;

class ArrayTest extends TestCase {

    protected $array;
    protected $array2;

    public function setUp(): void
    {
        parent::setUp();
        $this->array = ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog'];
        $this->array2 = ['c' => 'cat', 'a' => 'apple', 'b' => 'ball', 'd' => 'dog', 'z' => 'ken', 'foo' => 'bar', 'x' => 'max'];
    }

    /** @test */
    public function it_validates_the_array_add_function()
    {
        $this->assertEquals(Arr::add(['a', 'b', 'c'], '', 'd'), ['a', 'b', 'c', 'd']);
        $this->assertEquals(Arr::add(['a', 'b', 'c'], 'key', 'd'), ['a', 'b', 'c', 'key' => 'd']);
        $this->assertEquals(Arr::add(['a' => 'apple', 'b' => 'ball', 'c' => 'cat'], 'd', 'dog'), ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog']);
    }

    /** @test */
    public function it_validates_the_array_get_by_key_function()
    {
        $this->assertEquals(Arr::getByKey($this->array, 'd'), 'dog');
    }

    /** @test */
    public function it_validates_the_array_get_by_value_function()
    {
        $this->assertEquals(Arr::getKeyByValue($this->array, 'dog'), 'd');
    }


    /** @test */
    public function it_validates_the_array_first_function()
    {
        $this->assertEquals(Arr::first($this->array), 'apple');
    }

    /** @test */
    public function it_validates_the_array_last_function()
    {
        $this->assertEquals(Arr::last($this->array), 'dog');
    }

    /** @test */
    public function it_validates_the_array_nth_element_function()
    {
        $this->assertEquals(Arr::nthElement($this->array, 2), 'cat');
    }

    /** @test */
    public function it_validates_the_array_shuffle_function()
    {
        $array = $this->array;
        Arr::shuffle($array);
        $this->assertEquals(count($array), count($this->array));
    }

    /** @test */
    public function it_validates_the_array_split_function()
    {
        $array = Arr::split($this->array, 2);
        $this->assertEquals(count($array), 2);

        $this->assertIsArray($array[0]);
        $this->assertEquals(count($array[0]), 2);

        $this->assertIsArray($array[1]);
        $this->assertEquals(count($array[1]), 2);
    }

    /** @test */
    public function it_validates_the_array_random_function()
    {
        $value = Arr::random($this->array);
        $this->assertIsString($value);
        $this->assertIsString(Arr::getKeyByValue($this->array, $value));
    }

    /** @test */
    public function it_validates_the_array_compare_function()
    {
        $this->assertTrue(Arr::compare($this->array, $this->array));

        $array = $this->array;
        $array['e'] = 'elephant';
        $this->assertFalse(Arr::compare($this->array, $array));
    }

    /** @test */
    public function it_validates_the_array_common_function()
    {
        $this->assertEquals(Arr::common($this->array, $this->array), $this->array);
        $array = $this->array;
        unset($array['a']);
        unset($array['c']);
        $array['e'] = 'elephant';

        $this->assertEquals(Arr::common($this->array, $array), ['b' => 'ball', 'd' => 'dog']);
    }

    /** @test */
    public function it_validates_the_array_difference_function()
    {
        $this->assertEquals(Arr::difference($this->array, $this->array), []);

        $array = $this->array;
        unset($array['a']);
        unset($array['c']);
        $array['e'] = 'elephant';

        $this->assertEquals(Arr::difference($this->array, $array), ['a' => 'apple', 'c' => 'cat',]);
        $this->assertEquals(Arr::difference($array, $this->array), ['e' => 'elephant']);
    }

    /** @test */
    public function it_validates_the_array_merge_function()
    {
        $this->assertEquals(Arr::merge($this->array, ['e' => 'elephant']), ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog', 'e' => 'elephant']);
        $this->assertEquals(Arr::merge($this->array, $this->array2), ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog', 'z' => 'ken', 'foo' => 'bar', 'x' => 'max',]);
    }

    /** @test */
    public function it_validates_the_array_sort_by_value_ascending_order_function()
    {
        Arr::sortByValue($this->array2);
        $expected = ['a' => 'apple', 'b' => 'ball', 'foo' => 'bar', 'c' => 'cat', 'd' => 'dog', 'z' => 'ken', 'x' => 'max',];
        $this->assertEquals($this->array2, $expected);
        $this->assertEquals(Arr::first($this->array2), Arr::first($expected));
        $this->assertEquals(Arr::last($this->array2), Arr::last($expected));
    }

    /** @test */
    public function it_validates_the_array_sort_by_value_descending_order_function()
    {
        Arr::sortByValue($this->array2, false);
        $expected = ['a' => 'apple', 'b' => 'ball', 'foo' => 'bar', 'c' => 'cat', 'd' => 'dog', 'z' => 'ken', 'x' => 'max',];
        Arr::reverse($expected);

        $this->assertEquals($this->array2, $expected);
        $this->assertEquals(Arr::first($this->array2), Arr::first($expected));
        $this->assertEquals(Arr::last($this->array2), Arr::last($expected));
    }

    /** @test */
    public function it_validates_the_array_sort_by_key_ascending_order_function()
    {
        Arr::sortByKey($this->array2);
        $expected = ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog', 'foo' => 'bar', 'x' => 'max', 'z' => 'ken',];
        //        Arr::reverse($expected);

        $this->assertEquals($this->array2, $expected);
        $this->assertEquals(Arr::first($this->array2), Arr::first($expected));
        $this->assertEquals(Arr::last($this->array2), Arr::last($expected));
    }

    /** @test */
    public function it_validates_the_array_sort_by_key_descending_order_function()
    {
        Arr::sortByKey($this->array2, false);
        $expected = ['a' => 'apple', 'b' => 'ball', 'c' => 'cat', 'd' => 'dog', 'foo' => 'bar', 'x' => 'max', 'z' => 'ken',];
        Arr::reverse($expected);

        $this->assertEquals($this->array2, $expected);
        $this->assertEquals(Arr::first($this->array2), Arr::first($expected));
        $this->assertEquals(Arr::last($this->array2), Arr::last($expected));
    }

    /** @test */
    public function it_validates_the_array_pull_function()
    {
        $countBefore = count($this->array2);
        $value = Arr::pull($this->array2, 'b');
        $this->assertEquals($value, 'ball');
        $this->assertEquals($countBefore, count($this->array2) + 1);
        $this->assertFalse(isset($this->array2['b']));
    }

    /** @test */
    public function it_validates_the_array_get_key_by_value_function()
    {
        $this->assertEquals(Arr::getKeyByValue($this->array2, 'bar'), 'foo');
    }

    /** @test */
    public function it_validates_the_array_remove_by_value_function()
    {
        Arr::removeByValue($this->array2, 'foo');
        $this->assertFalse(isset($this->array2['bar']));
    }

    /** @test */
    public function it_validates_the_array_to_object_function()
    {
        $object =   Arr::toObject($this->array2);
        $this->assertTrue(is_object($object));
        $this->assertEquals($object->foo, $this->array2['foo']);
    }

}
