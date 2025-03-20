<?php

namespace Core;

class Session
{
    /**
     * Check if a session key exists
     * 
     * @param string $key The key to check
     * @return bool True if the key exists, false otherwise
     */
    public static function has($key)
    {
        return (bool) static::get($key);
    }

    /**
     * Put a value into the session
     * 
     * @param string $key The key to store the value under
     * @param mixed $value The value to store
     */
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a value from the session
     * 
     * @param string $key The key to retrieve the value from
     * @param mixed $default The default value to return if the key does not exist
     * @return mixed The stored value or the default value
     */
    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    /**
     * Flash a value to the session
     * 
     * @param string $key The key to store the value under
     * @param mixed $value The value to store
     */
    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Unflash the session
     */
    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    /**
     * Flush the session
     */
    public static function flush()
    {
        $_SESSION = [];
    }

    /**
     * Destroy the session
     */
    public static function destroy()
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
