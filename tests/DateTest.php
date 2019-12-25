<?php

use PHPUnit\Framework\TestCase;
use Sa\Helper\Date;

class DateTest extends TestCase
{
    /** @test */
    public function it_validates_the_date_prepare_by_week_and_year_function()
    {
        $date1 = Date::prepareDatetimeObjectByWeekAndYear(2019, 5);
        $this->assertTrue($date1 instanceof DateTime);
        $this->assertEquals($date1->format('Y-m-d'), '2019-01-28');

        $date2 = Date::prepareDatetimeObjectByWeekAndYear(2020, 45);
        $this->assertTrue($date2 instanceof DateTime);
        $this->assertEquals($date2->format('Y-m-d'), '2020-11-02');
    }

    /** @test */
    public function it_validates_get_week_range_by_week_and_year_function()
    {
        $weeRange1 = Date::getWeekStartAndEndDatesByWeekNumber(2019, 5);
        $this->assertIsArray($weeRange1);
        $this->assertTrue(isset($weeRange1['week_start']));
        $this->assertTrue(isset($weeRange1['week_end']));
        $this->assertEquals($weeRange1['week_start'], '2019-01-28');
        $this->assertEquals($weeRange1['week_end'], '2019-02-03');

        $weeRange2 = Date::getWeekStartAndEndDatesByWeekNumber(2020, 45);
        $this->assertIsArray($weeRange2);
        $this->assertTrue(isset($weeRange2['week_start']));
        $this->assertTrue(isset($weeRange2['week_end']));
        $this->assertEquals($weeRange2['week_start'], '2020-11-02');
        $this->assertEquals($weeRange2['week_end'], '2020-11-08');
    }

    /** @test */
    public function it_validates_get_last_week_number_by_year_function()
    {
        for ($year = 1900; $year < 2100; $year++) {
            $date = strtotime("31 December $year");
            $expectedWeekNumber = gmdate('W', $date);
            $expectedWeekNumber = ($expectedWeekNumber != 1) ? $expectedWeekNumber : 52;
            $this->assertEquals(Date::getLastWeekOfTheYear($year), $expectedWeekNumber);
        }
    }

    /** @test */
    public function it_validates_the_get_all_dates_between_given_range_function()
    {
        $dates1 = Date::getAllDatesBetweenTwoDates('2019-01-28', '2019-02-03');
        $this->assertIsArray($dates1);
        $this->assertEquals(count($dates1), 7);
        $this->assertEquals($dates1[0], '2019-01-28');
        $this->assertEquals($dates1[1], '2019-01-29');
        $this->assertEquals($dates1[count($dates1) - 1], '2019-02-03');

        $dates2 = Date::getAllDatesBetweenTwoDates(new DateTime('2020-11-02'), new DateTime('2020-11-30'));
        $this->assertIsArray($dates2);
        $this->assertEquals(count($dates2), 29);
        $this->assertEquals($dates2[0], '2020-11-02');
        $this->assertEquals($dates2[1], '2020-11-03');
        $this->assertEquals($dates2[count($dates2) - 1], '2020-11-30');

        $dates3 = Date::getAllDatesBetweenTwoDates(new DateTime('2020-11-30'), new DateTime('2020-11-02'));
        $this->assertIsArray($dates3);
        $this->assertEquals(count($dates3), 0);

        $dates4 = Date::getAllDatesBetweenTwoDates('2019-03-28', '2019-03-28');
        $this->assertIsArray($dates4);
        $this->assertEquals(count($dates4), 1);
        $this->assertEquals($dates4[0], '2019-03-28');
    }

    /** @test */
    public function it_validates_the_leaf_year_function()
    {
        $validate = [
            '2016' => true,
            '2017' => false,
            '2018' => false,
            '2019' => false,
            '2020' => true,
        ];
        foreach ($validate as $year => $isLeafYear) {
            $this->assertEquals(Date::isLeafYear($year), $isLeafYear);
        }
    }
}
