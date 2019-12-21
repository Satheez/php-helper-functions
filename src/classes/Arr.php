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

class Arr
{
    /**
     * Add new element to the array.
     *
     * @param array       $arr
     * @param             $value
     * @param string|null $key
     *
     * @return array
     */
    public static function add(array $arr, string $key, $value)
    {
        if (!empty($key)) {
            $arr[$key] = $value;
        } else {
            $arr[] = $value;
        }

        return $arr;
    }

    /**
     * Add new element to the array.
     *
     * @param array       $arr
     * @param string|null $key
     * @param null        $default
     *
     * @return array
     */
    public static function getByKey(array $arr, string $key, $default = null)
    {
        return isset($arr[$key]) ? $arr[$key] : $default;
    }

    /**
     * Pick first item from the array.
     *
     * @param array $arr
     * @param null  $default
     *
     * @return mixed|null
     */
    public static function first(array $arr, $default = null)
    {
        $firstIndex = 0;

        return self::nthElement($arr, $firstIndex, $default);
    }

    /**
     * Pick last item from the array.
     *
     * @param array $arr
     * @param null  $default
     *
     * @return mixed|null
     */
    public static function last(array $arr, $default = null)
    {
        $lastIndex = count($arr) - 1;

        return self::nthElement($arr, $lastIndex, $default);
    }

    /**
     * Pick nth item from array.
     *
     * @param array $arr
     * @param int   $index
     * @param null  $default
     *
     * @return mixed|null
     */
    public static function nthElement(array $arr, int $index, $default = null)
    {
        $key = array_keys($arr)[$index];

        return (count($arr) > 0 && isset($arr[$key])) ? $arr[$key] : $default;
    }

    /**
     * Shuffle an array.
     *
     * @param array $arr
     *
     * @return void
     *
     * @see https://stackoverflow.com/questions/4102777/php-random-shuffle-array-maintaining-key-value
     */
    public static function shuffle(array &$arr): void
    {
        $keys = array_keys($arr);
        shuffle($keys);
        $random = [];
        foreach ($keys as $key) {
            $random[$key] = $arr[$key];
        }
        $arr = $random;
    }

    /**
     * Split array into given sizes.
     *
     * @param array $arr
     * @param int   $into
     *
     * @return array
     */
    public static function split(array $arr, int $into = 2): array
    {
        return array_chunk($arr, $into);
    }

    /**
     * Select array element randomly.
     *
     * @param array $arr
     *
     * @return mixed|null
     */
    public static function random(array $arr)
    {
        $randomIndex = rand(0, (count($arr) - 1));

        return self::nthElement($arr, $randomIndex);
    }

    /**
     * Compare two arrays.
     *
     * @param array $arr1
     * @param array $arr2
     *
     * @return bool
     */
    public static function compare(array $arr1, array $arr2): bool
    {
        return array_diff($arr1, $arr2) === array_diff($arr2, $arr1);
    }

    /**
     * Get array common values.
     *
     * @param array $arr1
     * @param array $arr2
     *
     * @return array
     */
    public static function common(array $arr1, array $arr2)
    {
        return array_intersect($arr1, $arr2);
    }

    /**
     * Get array difference.
     *
     * @param array $arr1
     * @param array $arr2
     *
     * @return array
     */
    public static function difference(array $arr1, array $arr2)
    {
        return array_diff($arr1, $arr2);
    }

    /**
     * Merge array.
     *
     * @param array $arr1
     * @param array $arr2
     *
     * @return array
     */
    public static function merge(array $arr1, array $arr2): array
    {
        return array_merge($arr1, $arr2);
    }

    /**
     * Sort array by value.
     *
     * @param array $arr
     * @param bool  $isAscendingOrder
     *
     * @see https://www.php.net/manual/en/array.sorting.php
     */
    public static function sort(array &$arr, bool $isAscendingOrder = true)
    {
        self::sortByValue($arr, $isAscendingOrder);
    }

    /**
     * Sort array by key.
     *
     * @param array $arr
     * @param bool  $isAscendingOrder
     *
     * @see https://www.php.net/manual/en/array.sorting.php
     */
    public static function sortByKey(array &$arr, bool $isAscendingOrder = true): void
    {
        if ($isAscendingOrder) {
            ksort($arr);
        } else {
            krsort($arr);
        }
    }

    /**
     * Sort array by value.
     *
     * @param array $arr
     * @param bool  $isAscendingOrder
     *
     * @see https://www.php.net/manual/en/array.sorting.php
     */
    public static function sortByValue(array &$arr, bool $isAscendingOrder = true): void
    {
        if ($isAscendingOrder) {
            asort($arr);
        } else {
            arsort($arr);
        }
    }

    /**
     * Reverse array.
     *
     * @param array $arr
     */
    public static function reverse(array &$arr): void
    {
        $arr = array_reverse($arr, true);
    }

    /**
     * Pull element by key.
     *
     * @param array  $arr
     * @param string $key
     *
     * @return mixed|null
     */
    public static function pull(array &$arr, string $key)
    {
        $val = null;

        if (isset($arr[$key])) {
            $val = $arr[$key];
            unset($arr[$key]);
        }

        return $val;
    }

    /**
     * Remove element by value.
     *
     * @param array $arr
     * @param       $value
     *
     * @return void
     */
    public static function removeByValue(array &$arr, $value): void
    {
        $key = self::getKeyByValue($arr, $value);
        if (!empty($key)) {
            unset($arr[$key]);
        }
    }

    /**
     * Remove element key by value.
     *
     * @param array $arr
     * @param       $value
     *
     * @return mixed
     *
     * @see https://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key?rq=1
     */
    public static function getKeyByValue(array $arr, $value)
    {
        if (($key = array_search($value, $arr)) !== false) {
            return $key;
        }
    }

    /**
     * Convert array to object.
     *
     * @param $array
     *
     * @return mixed|null
     */
    public static function toObject($array)
    {
        $result = json_decode(json_encode($array), false);

        return is_object($result) ? $result : null;
    }
}
