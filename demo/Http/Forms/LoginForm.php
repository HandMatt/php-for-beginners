<?php

namespace Http\Forms;

use Core\Validator;

/**
 * Handles the validation of login form submissions
 */
class LoginForm
{
    /**
     * Array to store validation error messages
     * @var array
     */
    protected $errors = [];

    /**
     * Validates the login form input
     * 
     * @param string $email The user's email address
     * @param string $password The user's password
     * @return bool True if validation passes, false otherwise
     */
    public function validate($email, $password)
    {
        // Validate input format
        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!Validator::string($password)) {
            $this->errors['password'] = 'Please provide a valid password.';
        }

        return empty($this->errors);
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
    }
}
