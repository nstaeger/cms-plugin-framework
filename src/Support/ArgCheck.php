<?php

namespace Nstaeger\CmsPluginFramework\Support;

use InvalidArgumentException;

class ArgCheck
{
    public static function isArray($arg)
    {
        if (!is_array($arg)) {
            throw new InvalidArgumentException(
                sprintf("Expected an array, but was %s, containing: %s", gettype($arg), $arg)
            );
        }
    }

    public static function isDateString($arg)
    {
        self::isString($arg);

        $regex = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}/';

        if (preg_match($regex, $arg) != 1) {
            throw new InvalidArgumentException(
                sprintf(
                    "Expected a string containing a date in format YYYY-mm-dd, but was %s, containing: %s",
                    gettype($arg),
                    $arg
                )
            );
        }
    }

    public static function isEmail($arg)
    {
        self::isString($arg);

        if (!is_email($arg)) {
            throw new InvalidArgumentException(
                sprintf("Expected an email, but was %s, containing: %s", gettype($arg), $arg)
            );
        }
    }

    public static function isInt($arg)
    {
        if (!is_int($arg) && !is_numeric($arg)) {
            throw new InvalidArgumentException(
                sprintf("Expected an integer, but was %s, containing: %s", gettype($arg), $arg)
            );
        }
    }

    public static function isIp($arg)
    {
        self::isString($arg);

        if (!filter_var($arg, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
            && !filter_var($arg, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)
        ) {
            throw new InvalidArgumentException("Expected an IP, but was " . $arg);
        }
    }

    public static function isString($arg)
    {
        if (!is_string($arg)) {
            throw new InvalidArgumentException("Expected a string, but was: " . gettype($arg));
        }
    }

    public static function notEmpty($arg)
    {
        if (empty($arg)) {
            throw new InvalidArgumentException("Expected not to be empty, but was " . $arg);
        }
    }

    public static function notNull($arg)
    {
        if ($arg == null) {
            throw new InvalidArgumentException("Expected not null, but was " . $arg);
        }
    }
}
