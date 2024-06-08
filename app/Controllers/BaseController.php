<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Session instance.
     *
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Load the session service
        $this->session = \Config\Services::session();

        // Check if the user is logged in
        $this->checkLogin();
    }

    /**
     * Check if the user is logged in and has valid session data.
     * Redirects to login page if not authenticated.
     *
     * @return void
     */
    protected function checkLogin()
    {
        // Get the current controller class name
        $currentController = get_class($this);

        // Define controllers that don't require login
        $publicControllers = [
            'App\Controllers\AuthController',
            // Add other public controllers as needed
        ];

        // Skip login check for public controllers
        if (in_array($currentController, $publicControllers)) {
            return;
        }

        if (!$this->session->has('user_data')) {
            // User is not logged in, redirect to login page
            return redirect()->to('/login')->with('error', 'Please login to access this page.');
        }

        $userData = $this->session->get('user_data');
        if (!is_array($userData) || empty($userData)) {
            // Invalid user data, destroy session and redirect
            $this->session->destroy();
            return redirect()->to('/login')->with('error', 'Invalid user data. Please login again.');
        }

        // Optional: Check user type if you have different user roles
        if ($userData[0]['user_type'] !== 'partner') {
            return redirect()->to('/login')->with('error', 'Access denied. You must be a partner to view this page.');
        }
    }
}