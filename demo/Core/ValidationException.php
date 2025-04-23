<?php

namespace Core;

/**
 * Custom exception for handling validation failures
 * 
 * Stores validation errors and old form input data for redisplay
 * 
 * @package Core
 */
class ValidationException extends \Exception 
{
    /**
     * Array of validation error messages
     * @var array
     */
    public readonly array $errors;

    /**
     * Array of old form input values
     * @var array
     */
    public readonly array $old;

    /**
     * Create and throw a new validation exception
     * 
     * @param array $errors Array of validation error messages
     * @param array $old Array of submitted form values
     * @throws ValidationException
     */
    public static function throw($errors, $old)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}
