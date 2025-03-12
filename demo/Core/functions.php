<?php

use Core\Response;

/**
 * Collection of helper functions
 */

/**
 * Dump and die - Debug helper
 * 
 * @param mixed $value Value to dump
 */
function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

/**
 * Check if current URL matches given path
 * 
 * @param string $value URL to check
 * @return bool
 */
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

/**
 * Abort execution with status code
 * 
 * @param int $code HTTP status code
 */
function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

/**
 * Authorization helper
 * 
 * @param bool $condition Authorization condition
 * @param int $status HTTP status code on failure
 * @return bool
 */
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
    return true;
}

/**
 * Get absolute path from base path
 * 
 * @param string $path Relative path
 * @return string Absolute path
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * Render a view with attributes
 * 
 * @param string $path View path
 * @param array $attributes View variables
 */
function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('views/' . $path);
}

/**
 * Start authenticated session for user
 * 
 * Creates a new session for the authenticated user and
 * regenerates the session ID for security.
 * 
 * @param array $user User data containing email
 */
function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

/**
 * End user session and cleanup
 * 
 * Destroys the current session and removes the session cookie
 * for complete logout security.
 */
function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
