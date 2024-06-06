<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use CodeIgniter\HTTP\ResponseInterface;

class PublicController extends BaseController
{
    protected $RegistrationModel;
    protected $cache;
    protected $useCache;
    protected $cacheTime;

    public function __construct() {
        $this->RegistrationModel = new RegistrationModel();
        $this->cache = \Config\Services::cache(); // Load the cache service
        $this->useCache = getenv('CI_ENVIRONMENT') === 'production'; // Only use cache in production
        $this->cacheTime = getenv('CI_CACHE_TIME');; // Cache time in seconds (10 minutes)
    }
    
    public function index(): string
    {
        if ($this->useCache) {
            $cacheKey = 'public_index_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $header = view('public/public_header');
                $content = view('public/index');
                $footer = view('public/public_footer');
                $cachedContent = $header . $content . $footer;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $header = view('public/public_header');
            $content = view('public/index');
            $footer = view('public/public_footer');
            return $header . $content . $footer;
        }
    }

    public function user_types(): string
    {
        if ($this->useCache) {
            $cacheKey = 'user_types_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $header = view('public/public_header');
                $content = view('public/user_types');
                $footer = view('public/public_footer');
                $cachedContent = $header . $content . $footer;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $header = view('public/public_header');
            $content = view('public/user_types');
            $footer = view('public/public_footer');
            return $header . $content . $footer;
        }
    }

    public function customer_registration(): string
    {
        if ($this->useCache) {
            $cacheKey = 'customer_registration_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $header = view('public/public_header');
                $content = view('public/customer_registration');
                $footer = view('public/public_footer');
                $cachedContent = $header . $content . $footer;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $header = view('public/public_header');
            $content = view('public/customer_registration');
            $footer = view('public/public_footer');
            return $header . $content . $footer;
        }
    }

    public function brand_partner_registration(): string
    {
        if ($this->useCache) {
            $cacheKey = 'brand_partner_registration_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $header = view('public/public_header');
                $content = view('public/brand_partner_registration');
                $footer = view('public/public_footer');
                $cachedContent = $header . $content . $footer;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $header = view('public/public_header');
            $content = view('public/brand_partner_registration');
            $footer = view('public/public_footer');
            return $header . $content . $footer;
        }
    }

    public function register_customer(): ResponseInterface
    {
        // Get the form data using the request object
        $company_name = $this->request->getPost('companyName');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Call model method to insert data
        $inserted = $this->RegistrationModel->create_customer($company_name, $email, $password);
        if($inserted=='exists'){
            session()->setFlashdata('success', 'Account Exists');

        }else{
            if ($inserted) {
                // Handle successful insertion (e.g., redirect to a success page)
                session()->setFlashdata('success', 'Registration successful!');
            } else {
                // Handle insertion failure (e.g., show an error message)
            }
        }
        

        // Clear the related cache after insertion
        $this->cache->delete('customer_registration_view');

        return redirect()->to('/customer_registration');
    }

    public function register_brand_partner(): ResponseInterface
    {
        // Get the form data using the request object
        $company_name = $this->request->getPost('companyName');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Call model method to insert data
        $inserted = $this->RegistrationModel->create_brand_partner($company_name, $email, $password);

        if($inserted=='exists'){
            session()->setFlashdata('success', 'Account Exists');

        }else{
            if ($inserted) {
                // Handle successful insertion (e.g., redirect to a success page)
                session()->setFlashdata('success', 'Registration successful!');
            } else {
                // Handle insertion failure (e.g., show an error message)
            }
        }

        // Clear the related cache after insertion
        $this->cache->delete('brand_partner_registration_view');

        return redirect()->to('/brand_partner_registration');
    }

    public function coming_soon(): string
    {
        if ($this->useCache) {
            $cacheKey = 'coming_soon_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $content = view('coming_soon');
                $cachedContent = $content;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $content = view('coming_soon');
            $cachedContent = $content;
            return $cachedContent;
        }
    }
    public function customerLogin(): string
    {
        if ($this->useCache) {
            $cacheKey = 'customer_login_view';
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $header = view('public/public_header');
                $content = view('public/customer_login');
                $footer = view('public/public_footer');
                $cachedContent = $header . $content . $footer;

                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            $header = view('public/public_header');
            $content = view('public/customer_login');
            $footer = view('public/public_footer');
            return $header . $content . $footer;
        }
    }
    public function loginProcess(): ResponseInterface
    {
        try {
            // Get the form data using the request object
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');

            // Call model method to check login credentials
            $loggedIn = $this->RegistrationModel->customerLogin($phone, $password);

            if (json_encode($loggedIn)==true) {
                // Handle successful login (e.g., redirect to dashboard)
                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/partner_home');
            } else {
                // Handle login failure (e.g., show an error message)
                session()->setFlashdata('error', 'Invalid phone number or password. Please try again.');
                return redirect()->to('/customer_login'); // Redirect back to the login page
            }
        }
        catch (\Exception $e) {
            // Handle any exceptions that occur during login process
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return redirect()->to('/customer_login'); // Redirect back to the login page
        }
    }
    public function partnerHome(): string
    {
        try {
            if ($this->useCache) {
                $cacheKey = 'partner_home_view';
                $cachedContent = $this->cache->get($cacheKey);
    
                if ($cachedContent === null) {
                    // Cache miss, generate the content
                    // $header = view('public/public_header');
                    $content = view('partner/partner_home');
                    // $footer = view('public/public_footer');
                    $cachedContent = $content;
    
                    // Save the content to the cache
                    $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
                }
    
                return $cachedContent;
            } else {
                // Cache disabled, generate the content directly
                // $header = view('public/public_header');
                $content = view('partner/partner_home');
                // $footer = view('public/public_footer');
                return $content;
            }
        }
        catch (\Exception $e) {
            // Handle any exceptions that occur during login process
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return redirect()->to('/customer_login'); // Redirect back to the login page
        }
    }

    public function OTPVerification(): string
    {
        try {
            if ($this->useCache) {
                $cacheKey = 'otp_verification_view';
                $cachedContent = $this->cache->get($cacheKey);
    
                if ($cachedContent === null) {
                    // Cache miss, generate the content
                    $header = view('public/public_header');
                    $content = view('public/otp_verification');
                    $footer = view('public/public_footer');
                    $cachedContent =  $header . $content . $footer;
    
                    // Save the content to the cache
                    $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
                }
    
                return $cachedContent;
            } else {
                // Cache disabled, generate the content directly
                $header = view('public/public_header');
                $content = view('public/otp_verification');
                $footer = view('public/public_footer');
                return  $header . $content . $footer;
            }
        }
        catch (\Exception $e) {
            // Handle any exceptions that occur during login process
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return 'An unexpected error occurred.';
        }
    }
    
    public function otp_login_process(): ResponseInterface
    {
        try {
            // Get the form data using the request object
            $phone = $this->request->getPost('phone');
            $otp = $this->request->getPost('otp');

            // Call model method to check login credentials
            $loggedIn = $this->RegistrationModel->otpLogin($phone, $otp);

            if ($loggedIn) { // Directly check the boolean value
                // Handle successful login (e.g., redirect to dashboard)
                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/partner_home');
            } else {
                // Handle login failure (e.g., show an error message)
                session()->setFlashdata('error', 'Invalid phone number or OTP. Please try again.');
                return redirect()->to('/customer_login'); // Redirect back to the login page
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the login process
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return redirect()->to('/customer_login'); // Redirect back to the login page
        }
    }


}
