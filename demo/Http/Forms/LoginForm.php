<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

/**
 * Login Form Validator
 * 
 * Handles validation of login form submissions including:
 * - Email format validation
 * - Password requirements checking
 * - Error collection and management
 * - Exception throwing for invalid submissions
 * 
 * @package Http\Forms
 */
class LoginForm
{
    /**
     * Collection of validation error messages
     * 
     * @var array<string, string> Array of field => message pairs
     */
    protected $errors = [];

    /**
     * Create new login form validator instance
     * 
     * @param array $attributes Form input data to validate
     */
    public function __construct(public array $attributes)
    {
        // Validate input format
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Please provide a valid password.';
        }
    }

    /**
     * Static factory method to create and validate a login form
     * 
     * @param array $attributes Form input data
     * @return self Returns validator instance if valid
     * @throws ValidationException If validation fails
     */
    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    /**
     * Returns any validation errors
     * 
     * @return array Array of validation error messages
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Adds an error message to the errors array
     * 
     * @param string $field The field name
     * @param string $message The error message
     */
    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
