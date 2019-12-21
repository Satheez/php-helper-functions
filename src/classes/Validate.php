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

class Validate {

    /**
     * Check whether the given value is a type of 'string' or not
     *
     * @param $str
     *
     * @return bool
     */
    public static function isValidString($str): bool
    {
        return is_string($str);
    }

    /**
     * Check whether the string is empty or not
     *
     * @param $str
     *
     * @return bool
     */
    public static function isEmptyString($str): bool
    {
        if ( empty($str) || !self::isValidString($str) ) {
            return true;
        }
        return (strlen(trim($str)) === 0);
    }

    /**
     * Check whether the given string value length b/w given range
     *
     * @param          $str
     * @param int      $minLength
     * @param int|null $maxLength
     *
     * @return bool
     */
    public static function isStringWithRange($str, int $minLength = 0, ?int $maxLength = null): bool
    {
        if ( !empty($minLength) && strlen($str) < $minLength ) {
            return false;
        }

        if ( !empty($maxLength) && strlen($str) > $maxLength ) {
            return false;
        }

        return true;
    }

    /**
     * validate string without space (by excluding space)
     *
     * @param          $str
     * @param int      $minLength
     * @param int|null $maxLength
     *
     * @return bool
     */
    public static function isStringWithRangeExcludeSpace(string $str, int $minLength = 0, ?int $maxLength = null): bool
    {
        return self::isStringWithRange(trim($str), $minLength, $maxLength);
    }

    /**
     * Validate int value
     *
     * @param      $val
     * @param bool $allowNegativeValue
     *
     * @return bool
     */
    public static function isValidInt($val, bool $allowNegativeValue = true): bool
    {
        if (! filter_var($val, FILTER_VALIDATE_INT) ) {
            return false;
        }

        return $allowNegativeValue?  true : $val >= 0;

    }

    /**
     * Validate int value with range
     *
     * @param          $val
     * @param int|null $minLength
     * @param int|null $maxLength
     *
     * @return bool
     */
    public static function intWithRange($val, ?int $minLength = null, ?int $maxLength = null)
    {
        if ( !self::isValidInt($val) ) {
            return false;
        }

        $val = (int) $val;

        if ( $minLength !== null && $val < $minLength ) {
            return false;
        }

        if ( $maxLength !== null && $val > $maxLength ) {
            return false;
        }

        return true;

    }

    /**
     * Validate float value
     *
     * @param      $val
     * @param bool $allowNegativeValue
     *
     * @return bool
     */
    public static function isValidFloat($val, bool $allowNegativeValue = true): bool
    {
        return filter_var($val, FILTER_VALIDATE_FLOAT);
    }

    /**
     * Validate float value with range
     *
     * @param            $val
     * @param float|null $minValue
     * @param float|null $maxValue
     *
     * @return bool
     */
    public static function floatWithRange($val, ?float $minValue = null, ?float $maxValue = null)
    {
        if ( !self::isValidFloat($val) ) {
            return false;
        }

        $val = floatval($val);

        if ( $minValue!== null && $val < $minValue ) {
            return false;
        }

        if ( $maxValue!== null && $val > $maxValue ) {
            return false;
        }

        return true;
    }

    /**
     * Validate datetime
     *
     * @param        $givenValue
     * @param string $format
     *
     * @return bool
     */
    public static function isValidDate($givenValue, string $format = 'Y-m-d H:i:s')
    {
        if ( self::isEmptyString($givenValue) ) {
            return false;
        }

        $generatedDateValue = \DateTime::createFromFormat($format, $givenValue);

        return $generatedDateValue && $generatedDateValue->format($format) === $givenValue && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }

    /**
     * Check whether given date is in the past or not
     *
     * @param          $date
     * @param int|null $now
     * @param string   $format
     *
     * @return bool
     */
    public static function isPastDate($date, ?int $now = 0, string $format = 'Y-m-d'): bool
    {
        if ( !self::isValidDate($date, $format) ) {
            return false;
        }
        if ( empty($now) ) {
            $now = time();
        }

        $d = \DateTime::createFromFormat($format, $date);

        return $d->getTimestamp() < $now;
    }

    /**
     * Check given date is in the future or not
     *
     * @param          $date
     * @param int|null $now
     * @param string   $format
     *
     * @return bool
     */
    public static function isFutureDate($date, ?int $now = 0, string $format = 'Y-m-d'): bool
    {
        if ( !self::isValidDate($date, $format) ) {
            return false;
        }
        if ( empty($now) ) {
            $now = time();
        }

        $d = \DateTime::createFromFormat($format, $date);

        return $d->getTimestamp() > $now;

    }

    /**
     * Validate email
     *
     * @param string $email
     *
     * @return bool
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validate url
     *
     * @param string $url
     *
     * @return bool
     */
    public static function isValidURL(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * validate IP address
     *
     * @param string $ip
     *
     * @return bool
     */
    public static function isValidIP(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

}