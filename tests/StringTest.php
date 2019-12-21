<?php

use PHPUnit\Framework\TestCase;
use Sa\Helper\Str;

class StringTest extends TestCase  {

    /** @test */
    public function it_validates_the_string_title_case_function()
    {
       $this->assertEquals((new Str)->title('one two three'), 'One Two Three');
    }

    /** @test */
    public function it_validates_the_string_upper_case_function()
    {
       $this->assertEquals((new Str)->upper('onE two tHree'), 'ONE TWO THREE');
    }

    /** @test */
    public function it_validates_the_string_lower_case_function()
    {
       $this->assertEquals((new Str)->lower('oNe tWo thrEe'), 'one two three');
    }

    /** @test */
    public function it_validates_the_string_camel_case_function()
    {
       $this->assertEquals((new Str)->camel('oNe tWo thrEe'), 'One Two Three');
    }

    /** @test */
    public function it_validates_the_string_substring_function()
    {
       $this->assertEquals((new Str)->substr('one two three', 0, 3), 'one');
       $this->assertEquals((new Str)->substr('one two three', 4), 'two three');
    }

    /** @test */
    public function it_validates_the_string_limit_function()
    {
        $this->assertEquals((new Str)->limit('one two three', 3), 'one...');
        $this->assertEquals((new Str)->limit('one two three', 3, '---'), 'one---');
    }

    /** @test */
    public function it_validates_the_string_random_function()
    {
        $this->assertEquals(strlen((new Str)->random(10)), 10);
    }


}