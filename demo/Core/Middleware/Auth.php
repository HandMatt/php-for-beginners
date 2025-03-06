<?php

namespace Core\Middleware;

/**
 * Authentication Middleware
 * 
 * Ensures that only authenticated users can access protected routes
 */
class Auth
{
    /**
     * Handle the middleware check
     * 
     * Redirects to home page if user is not authenticated
     */
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}
