<?php

use PHPUnit\Framework\TestCase;

use Sa\Helper\Validate;

class ValidationTest extends TestCase {

    /** @test */
    public function it_validates_the_string_validation_function()
    {
        $validString = ['string', 'valid', '1',];
        foreach ( $validString as $str ) {
            $this->assertTrue((new Validate)->isValidString($str));
        }

        $invalidString = [false, 777, 87.9];
        foreach ( $invalidString as $str ) {
            $this->assertFalse((new Validate)->isValidString($str));
        }
    }

    /** @test */
    public function it_validates_the_empty_string_validation_function()
    {
        $validEmptyString = ['  ', '', '          ',];
        foreach ( $validEmptyString as $str ) {
            $this->assertTrue((new Validate)->isEmptyString($str));
        }

        $invalidEmptyString = ['  1', 'string', '   data       ',];
        foreach ( $invalidEmptyString as $str ) {
            $this->assertFalse((new Validate)->isEmptyString($str));
        }
    }

    /** @test */
    public function it_validates_the_string_range_validation_function()
    {
        $this->assertTrue((new Validate)->isStringWithRange('0123456789', 1, 89));
        $this->assertTrue((new Validate)->isStringWithRange('s3web', 5, 5));
        $this->assertTrue((new Validate)->isStringWithRange('s3web', 5));
        $this->assertFalse((new Validate)->isStringWithRange('0123456     789', 1, 11));
    }

    //    /** @test */
    //    public function it_validates_the_string_range_exclude_space_validation_function()
    //    {
    //        $this->assertTrue((new Validate)->isStringWithRangeExcludeSpace('0123456 789', 1, 11));
    ////        $this->assertTrue((new Validate)->isStringWithRangeExcludeSpace('0123456789', 1, 89));
    ////        $this->assertTrue((new Validate)->isStringWithRangeExcludeSpace('s3web', 5, 5));
    ////        $this->assertFalse((new Validate)->isStringWithRangeExcludeSpace('s3we      ', 5));
    //    }


    /** @test */
    public function it_validates_the_integer_validation_function()
    {
        $validInt = [123, '777', '11145555666', 896555, 4756111111, -11];
        foreach ( $validInt as $int ) {
            $this->assertTrue((new Validate)->isValidInt($int));
        }

        $invalidInt = [false, 'cat', null, 87.9];
        foreach ( $invalidInt as $int ) {
            $this->assertFalse((new Validate)->isValidInt($int));
        }
        $this->assertFalse((new Validate)->isValidInt(-11, false));
    }

    /** @test */
    public function it_validates_the_int_range_validation_function()
    {
        $this->assertTrue((new Validate)->intWithRange(25, 25));
        $this->assertTrue((new Validate)->intWithRange(25, 25, 50));
        $this->assertTrue((new Validate)->intWithRange(25, null, 50));

        $this->assertFalse((new Validate)->intWithRange(25, 30));
        $this->assertFalse((new Validate)->intWithRange(25, 30, 50));
        $this->assertFalse((new Validate)->intWithRange(25, 25, 24));
        $this->assertFalse((new Validate)->intWithRange(25, null, 6));
    }

    /** @test */
    public function it_validates_the_float_validation_function()
    {
        $validFloat = [123.0, '777.001', '11145.555666', 896555.0, 4756.322];
        foreach ( $validFloat as $float ) {
            $this->assertTrue((new Validate)->isValidFloat($float));
        }

        $invalidFloat = [false, 'cat', null];
        foreach ( $invalidFloat as $float ) {
            $this->assertFalse((new Validate)->isValidFloat($float));
        }
    }

    /** @test */
    public function it_validates_the_float_range_validation_function()
    {
        $this->assertTrue((new Validate)->floatWithRange(25.1, 25));
        $this->assertTrue((new Validate)->floatWithRange(25.1, 25, 50.6));
        $this->assertTrue((new Validate)->floatWithRange(25.1, null, 50.6));

        $this->assertFalse((new Validate)->floatWithRange(25.1, 30));
        $this->assertFalse((new Validate)->floatWithRange(25.1, 30, 50.6));
        $this->assertFalse((new Validate)->floatWithRange(25.1, 25, 25.01));
        $this->assertFalse((new Validate)->floatWithRange(25.1, null, 5.6));
    }

    /** @test */
    public function it_validates_the_date_validation_function()
    {
        $this->assertTrue((new Validate)->isValidDate(date('Y-m-d H:i:s')));
        $this->assertTrue((new Validate)->isValidDate(date('Y-m-d H:i:s'), 'Y-m-d H:i:s'));
        $this->assertTrue((new Validate)->isValidDate(date('Y-m-d'), 'Y-m-d'));

        $this->assertFalse((new Validate)->isValidDate('test date'));
        $this->assertFalse((new Validate)->isValidDate(date('Y-m-d H:i:s'), 'Y/m-d h:i:s'));
        $this->assertFalse((new Validate)->isValidDate(date('Y/m/d'), 'Y-m-d'));

         }


    /** @test */
    public function it_validates_the_past_date_validation_function()
    {
        $this->assertTrue((new Validate)->isPastDate(date('Y-m-d', strtotime('-1 day'))));
        $this->assertTrue((new Validate)->isPastDate(date('Y-m-d', strtotime('-1 day')), 0, 'Y-m-d'));
        $this->assertTrue((new Validate)->isPastDate(date('Y-m-d'), strtotime('+1 day'), 'Y-m-d'));
        $this->assertTrue((new Validate)->isPastDate(date('Y-m-d H:i:s', strtotime('-1 day')), 0, 'Y-m-d H:i:s'));

        $this->assertFalse((new Validate)->isPastDate(date('Y-m-d', strtotime('+1 day'))));
        $this->assertFalse((new Validate)->isPastDate(date('Y-m-d', strtotime('+1 day')), 0, 'Y-m-d'));
        $this->assertFalse((new Validate)->isPastDate(date('Y-m-d'), strtotime('-1 day'), 'Y-m-d'));
        $this->assertFalse((new Validate)->isPastDate(date('Y-m-d', strtotime('+1 day'))));
        $this->assertFalse((new Validate)->isPastDate(date('Y-m-d H:i:s', strtotime('+1 day')), 0, 'Y-m-d H:i:s'));
    }

    /** @test */
    public function it_validates_the_future_date_validation_function()
    {
        $this->assertTrue((new Validate)->isFutureDate(date('Y-m-d', strtotime('+1 day'))));
        $this->assertTrue((new Validate)->isFutureDate(date('Y-m-d', strtotime('+1 day')), 0, 'Y-m-d'));
        $this->assertTrue((new Validate)->isFutureDate(date('Y-m-d'), strtotime('-1 day'), 'Y-m-d'));
        $this->assertTrue((new Validate)->isFutureDate(date('Y-m-d', strtotime('+1 day'))));
        $this->assertTrue((new Validate)->isFutureDate(date('Y-m-d H:i:s', strtotime('+1 day')), 0, 'Y-m-d H:i:s'));

        $this->assertFalse((new Validate)->isFutureDate(date('Y-m-d', strtotime('-1 day'))));
        $this->assertFalse((new Validate)->isFutureDate(date('Y-m-d', strtotime('-1 day')), 0, 'Y-m-d'));
        $this->assertFalse((new Validate)->isFutureDate(date('Y-m-d'), strtotime('+1 day'), 'Y-m-d'));
        $this->assertFalse((new Validate)->isFutureDate(date('Y-m-d H:i:s', strtotime('-1 day')), 0, 'Y-m-d H:i:s'));
    }

    /** @test */
    public function it_validates_the_email_validation_function()
    {
        $validEmails = ['test@example.com', 'test@example.org', '1@test.co.nz',];

        foreach ( $validEmails as $email ) {
            $this->assertTrue((new Validate)->isValidEmail($email));
        }

        $invalidEmails = ['test@example.com.', 'test#example.org', '@example.org',];

        foreach ( $invalidEmails as $email ) {
            $this->assertFalse((new Validate)->isValidEmail($email));
        }
    }


    /** @test */
    public function it_validates_the_url_validation_function()
    {
        $validURLs = ['https://example.com', 'https://sub.example.com', 'https://www.example.com',];

        foreach ( $validURLs as $url ) {
            $this->assertTrue((new Validate)->isValidURL($url));
        }

        $invalidURLs = ['example.', 'test#example.org', '@example.org', 'example.org.a.n.c'];
        foreach ( $invalidURLs as $url ) {
            $this->assertFalse((new Validate)->isValidURL($url));
        }
    }

    /** @test */
    public function it_checks_the_ip_validation_function()
    {
        $validIPs = ['127.0.0.1', '192.168.1.64', '255.255.255.0', '192.168.0.0', 'FE80:0000:0000:0000:0202:B3FF:FE1E:8329', 'FE80::0202:B3FF:FE1E:8329'];
        foreach ( $validIPs as $ip ) {
            $this->assertTrue((new Validate)->isValidIP($ip));
        }

        $invalidIPs = ['0.0.0.0.0', '127.0.0.1ip', '127.0.0', '256.255.255.0', '12839.1.1.1'];
        foreach ( $invalidIPs as $ip ) {
            $this->assertFalse((new Validate)->isValidIP($ip));
        }
    }

}
