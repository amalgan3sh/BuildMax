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
        $this->cacheTime = getenv('CI_CACHE_TIME') ? (int)getenv('CI_CACHE_TIME') : 600; // Cache time in seconds (10 minutes)

    }
    
    public function index(): string
    {
        $cacheKey = 'public_index_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/index') . view('public/public_footer');
        });
    }

    public function user_types(): string
    {
        $cacheKey = 'user_types_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/user_types') . view('public/public_footer');
        });
    }

    public function customer_registration(): string
    {
        $cacheKey = 'customer_registration_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/customer_registration') . view('public/public_footer');
        });
    }

    public function brand_partner_registration(): string
    {
        $cacheKey = 'brand_partner_registration_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/brand_partner_registration') . view('public/public_footer');
        });
    }

    public function coming_soon(): string
    {
        $cacheKey = 'coming_soon_view';
        return $this->renderCache($cacheKey, function() {
            return view('coming_soon');
        });
    }

    public function customerLogin(): string
    {
        $cacheKey = 'customer_login_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/customer_login') . view('public/public_footer');
        });
    }

    public function partnerHome(): string
    {
        $cacheKey = 'partner_home_view';
        return $this->renderCache($cacheKey, function() {
            return view('partner/partner_home');
        });
    }

    public function OTPVerification(): string
    {
        $cacheKey = 'otp_verification_view';
        return $this->renderCache($cacheKey, function() {
            return view('public/public_header') . view('public/otp_verification') . view('public/public_footer');
        });
    }

    public function register_customer(): ResponseInterface
    {
        // Get the form data using the request object
        $company_name = $this->request->getPost('companyName');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Call model method to insert data
        $inserted = $this->RegistrationModel->create_customer($company_name, $email, $password);
        if ($inserted == 'exists') {
            session()->setFlashdata('success', 'Account Exists');
        } else {
            if ($inserted) {
                session()->setFlashdata('success', 'Registration successful!');
            } else {
                session()->setFlashdata('error', 'Registration failed!');
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
        if ($inserted == 'exists') {
            session()->setFlashdata('success', 'Account Exists');
        } else {
            if ($inserted) {
                session()->setFlashdata('success', 'Registration successful!');
            } else {
                session()->setFlashdata('error', 'Registration failed!');
            }
        }

        // Clear the related cache after insertion
        $this->cache->delete('brand_partner_registration_view');

        return redirect()->to('/brand_partner_registration');
    }

    public function loginProcess(): ResponseInterface
    {
        try {
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');

            $loggedIn = $this->RegistrationModel->customerLogin($phone, $password);
            if ($loggedIn) {
                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/partner_home');
            } else {
                session()->setFlashdata('error', 'Invalid phone number or password. Please try again.');
                return redirect()->to('/customer_login');
            }
        } catch (\Exception $e) {
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return redirect()->to('/customer_login');
        }
    }

    public function otp_login_process(): ResponseInterface
    {
        try {
            $phone = $this->request->getPost('phone');
            $otp = $this->request->getPost('otp');

            $loggedIn = $this->RegistrationModel->otpLogin($phone, $otp);
            if ($loggedIn) {
                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/partner_home');
            } else {
                session()->setFlashdata('error', 'Invalid phone number or OTP. Please try again.');
                return redirect()->to('/customer_login');
            }
        } catch (\Exception $e) {
            log_message('error', 'Login process failed: ' . $e->getMessage());
            session()->setFlashdata('error', 'An unexpected error occurred. Please try again later.');
            return redirect()->to('/customer_login');
        }
    }

    /**
     * Renders content from cache if available, otherwise generates and caches it.
     *
     * @param string $cacheKey The cache key to use.
     * @param callable $contentGenerator A callable that generates the content if cache is missed.
     * @return string The cached or generated content.
     */
    private function renderCache(string $cacheKey, callable $contentGenerator): string
    {
        if ($this->useCache) {
            $cachedContent = $this->cache->get($cacheKey);

            if ($cachedContent === null) {
                // Cache miss, generate the content
                $cachedContent = $contentGenerator();
                // Save the content to the cache
                $this->cache->save($cacheKey, $cachedContent, $this->cacheTime);
            }

            return $cachedContent;
        } else {
            // Cache disabled, generate the content directly
            return $contentGenerator();
        }
    }
}
