<?php

namespace App\Helpers;

class HabrHelper
{
    const DEFAULT_PERIOD = 'hour';
    const DEFAULT_DISTANCE = 1;

    const PERIOD_HOUR = 'hour';
    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';

    const HOURS_IN_DAY = 24;
    const HOURS_IN_WEK = 168;

    /**
     * @var array
     */
    public static array $availableRepeatPeriods = [
        self::PERIOD_DAY,
        self::PERIOD_WEEK,
        self::PERIOD_HOUR,
    ];

    /**
     * @return int
     */
    public static function getParseTime(): int
    {
        $repeatPeriod = \Config::get('habr.repeat_period');
        $repeatDistance = intval(\Config::get('habr.repeat_distance'));

        if (!in_array($repeatPeriod, static::$availableRepeatPeriods)
            || $repeatDistance === 0) {
            return static::calculateRepeat(self::DEFAULT_PERIOD, self::DEFAULT_PERIOD);
        }

        return static::calculateRepeat($repeatPeriod, $repeatDistance);
    }

    /**
     * @param string $period
     * @param int $distance
     * @return int
     */
    public static function calculateRepeat(string $period, int $distance): int
    {
        switch ($period) {
            case self::PERIOD_DAY:
                return $distance * self::HOURS_IN_DAY;
            case self::PERIOD_WEEK:
                return $distance * self::HOURS_IN_WEK;
            case self::PERIOD_HOUR:
                return $distance;
            default:
                return self::DEFAULT_DISTANCE;
        }
    }
}
