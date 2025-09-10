<?php

namespace Core;

/**
 * Input Validator
 * 
 * Provides validation methods for:
 * - String length
 * - Email format
 */
class Validator
{
    /**
     * Validate string length
     * 
     * @param string $value String to validate
     * @param int $min Minimum length
     * @param int $max Maximum length
     * @return bool
     */
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Validate email format
     * 
     * @param string $value Email to validate
     * @return bool
     */
    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(int $value, int $greaterThan): bool
    {
        return $value > $greaterThan;
    }
}
