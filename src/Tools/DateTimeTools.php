<?php


namespace ArpaBlue\FFTest\Tools;

use  DateTime;
/**
 * Class DateTimeTools
 * @package ArpaBlue\FFTest\Tools
 * This class manage static methods for dates and time.
 */
class DateTimeTools
{
    /**
     * It contains the format used to manage the date.
     */
    const DATE_FORMAT = "Y-m-d";
    /**
     * It contains the format used to get the instant time, ( hour, minutes and second).
     */
    const TIME_FORMAT = "H:i:s";

    /**
     * It return the current instant of date and time.
     * @return string It is the current instant of date and time.
     */
    public static function getInstant()
    {
        $ddate = new DateTime();
        return $ddate->format( DateTimeTools::DATE_FORMAT.' '.DateTimeTools::TIME_FORMAT );
    }
    /**
     * It return the current instant of date.
     * @return string It is the current instant of date.
     */
    public static function getDate()
    {
        $ddate = new DateTime();
        return $ddate->format( DateTimeTools::DATE_FORMAT );
    }
    /**
     * It return the current instant of time ( hour, minute and seconds ).
     * @return string It is the current instant of time.
     */
    public static function getTime()
    {
        $ddate = new DateTime();
        return $ddate->format( DateTimeTools::TIME_FORMAT );
    }
}