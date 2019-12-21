<?php
/**
 * Helper class that provides useful php functions.
 *
 * @author      Vettivel Satheez <isatheez@gmail.com>
 *
 * @link        https://github.com/satheez
 *
 * @license     MIT
 */

namespace Sa\Helper;

class Str
{

    /**
     * Convert the given string to title case..
     *
     * @param string $value
     *
     * @return string
     */
    public static function title(string $value): string
    {
        return mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }


    /**
     * Convert the given string to upper-case..
     *
     * @param string $value
     *
     * @return string
     */
    public static function upper(string $value)
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Convert the given string to upper-case..
     *
     * @param string $value
     *
     * @return string
     */
    public static function lower(string $value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Returns the portion of string specified by the start and length parameters..
     *
     * @param string   $string
     * @param int      $start
     * @param int|null $length
     *
     * @return string
     */
    public static function substr(string $string, int $start, ?int $length = null): string
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * @param string $str .
     * @param int    $limit
     * @param string $end
     *
     * @return string
     */
    public static function limit(string $str, int $limit = 30, string $end = '...'): string
    {
        if (strlen($str) <= $limit) {
            return $str;
        }
        return self::substr($str, 0, $limit) . $end;
    }

    /**
     * Upper case for each word start letters.
     *
     * @param string $str
     *
     * @return string
     */
    public static function camel(string $str): string
    {
        return ucwords(self::lower($str));
    }

    /**
     * Generate random string.
     *
     * @param int $limit
     *
     * @return string
     */
    public static function random(int $limit = 10): string
    {
        return Generate::randomString($limit);
    }
}