<?php

namespace Core\Middleware;

/**
 * Guest Middleware
 * 
 * Ensures that only non-authenticated users can access guest-only routes
 */
class Guest
{
    /**
     * Handle the middleware check
     * 
     * Redirects to home page if user is already authenticated
     */
    public function handle()
    {
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}
