<?php

namespace Core;

class Authenticator
{
    /**
     * Attempt to authenticate user with provided credentials
     * 
     * @param string $email User's email address
     * @param string $password User's password
     * @return bool True if authentication succeeds, false otherwise
     */
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
                'email' => $email
            ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }

    /**
     * Start authenticated session for user
     * 
     * Creates a new session for the authenticated user and
     * regenerates the session ID for security.
     * 
     * @param array $user User data containing email
     */
    public function login($user)
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
    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
