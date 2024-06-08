<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        // Your login logic here
    }

    public function logout()
    {
        // Destroy the session
        $this->session->destroy();

        // Redirect to customer login page
        return redirect()->to('/customer_login')->with('info', 'You have been logged out.');
    }
}