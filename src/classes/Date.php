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

use DateTime;
use DatePeriod;
use DateInterval;

class Date
{
    /**
     * Prepare datetime object by week and year
     *
     * @param int $year
     * @param int $week
     *
     * @return DateTime
     * @throws \Exception
     */
    public static function prepareDatetimeObjectByWeekAndYear(int $year, int $week): DateTime
    {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        return $dto;
    }

    /**
     * Get week start and end dates by week number
     *
     * @param int $year
     * @param int $week
     *
     * @return array
     * @throws \Exception
     * @see https://stackoverflow.com/questions/4861384/php-get-start-and-end-date-of-a-week-by-weeknumber
     */
    public static function getWeekStartAndEndDatesByWeekNumber(int $year, int $week): array
    {
        $res = [];
        $dto = self::prepareDatetimeObjectByWeekAndYear($year, $week);
        $res['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $res['week_end'] = $dto->format('Y-m-d');
        return $res;
    }

    /**
     * Get last week number of a year
     *
     * @param int $year
     *
     * @return int
     * @throws \Exception
     * @see https://stackoverflow.com/questions/3319386/php-get-last-week-number-in-year#9018728
     */
    public static function getLastWeekOfTheYear(int $year)
    {
        $dto = self::prepareDatetimeObjectByWeekAndYear($year, 53);
        return $dto->format('W') === '53' ? 53 : 52;
    }

    /**
     * Get all dates between two Dates
     *
     * @param string|DateTime $startDate
     * @param string|DateTime $endDate
     *
     * @return array
     * @throws \Exception
     * @see https://stackoverflow.com/questions/4312439/php-return-all-dates-between-two-dates-in-an-array
     */
    public static function getAllDatesBetweenTwoDates($startDate, $endDate): array
    {
        if (!($startDate instanceof DateTime)) {
            $startDate = new DateTime($startDate);
        }

        if (!($endDate instanceof DateTime)) {
            $endDate = new DateTime($endDate);
        }

        $period = new DatePeriod($startDate, new DateInterval('P1D'), $endDate);
        $dates = [];

        if ($startDate > $endDate) {
            return $dates;
        }

        foreach ($period as $key => $value) {
            $dates[] = $value->format('Y-m-d');
        }
        $dates[] = $endDate->format('Y-m-d');
        return $dates;
    }

    /**
     * Check whether the given year is leaf year or not
     *
     * @param int $year
     *
     * @return bool
     * @throws \Exception
     */
    public static function isLeafYear(int $year) : bool
    {
        $dto = self::prepareDatetimeObjectByWeekAndYear($year, 5);
        return !empty($dto->format('L'));
    }
}