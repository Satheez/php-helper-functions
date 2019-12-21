<?php
/**
 * Helper class that provides useful php functions.
 *
 * @author      Vettivel Satheez <isatheez@gmail.com>
 * @link        https://github.com/satheez
 * @license     MIT
 */

namespace Sa\Helper;


class Generate
{

    /**
     * Generate random int.
     *
     * @param int $minValue
     * @param int $maxValue
     *
     * @return int
     */
    public static function randomInt(int $minValue = 0, int $maxValue = 1000): int
    {
        return rand($minValue, $maxValue);
    }

    /**
     * Generate random float.
     *
     * @param float $minValue
     * @param float $maxValue
     * @param int   $decimalPlace
     *
     * @return float
     */
    public static function randomFloat(float $minValue = 0.0, float $maxValue = 1000.0, int $decimalPlace = 1): float
    {

        // Decimal place can be from 1 to 5
        $decimalPlace = ($decimalPlace > 0 && $decimalPlace <= 5) ? $decimalPlace : 1;

        $divider = pow(10, $decimalPlace);

        return rand(($minValue * $divider), ($maxValue * $divider)) / $divider;
    }

    /**
     * Generate random string.
     *
     * @param int  $length
     * @param bool $includeNumbers
     * @param bool $includeSymbols
     *
     * @return string
     */
    public static function randomString(int $length = 10, bool $includeNumbers = true, bool $includeSymbols = false): string
    {
        $range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // Include numbers
        if ($includeNumbers) {

            $range .= "0123456789";
        }

        // Include symbols
        if ($includeSymbols) {

            $range .= "_!@#$^~";
        }

        $finalString = "";

        $srtLen = strlen($range);

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $srtLen - 1);

            $finalString .= $range[$randomIndex];
        }

        return $finalString;
    }
}