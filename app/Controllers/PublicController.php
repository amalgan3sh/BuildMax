<?php

namespace App\Controllers;

use App\Models\RegistrationModel;
use CodeIgniter\HTTP\ResponseInterface;

class PublicController extends BaseController
{
    protected $RegistrationModel;
    protected $cache;

    public function __construct() {
        $this->RegistrationModel = new RegistrationModel();
        $this->cache = \Config\Services::cache(); // Load the cache service
    }
    
    public function index(): string
    {
        $cacheKey = 'public_index_view';
        $cachedContent = $this->cache->get($cacheKey);

        if ($cachedContent === null) {
            // Cache miss, generate the content
            $header = view('public/public_header');
            $content = view('public/index');
            $footer = view('public/public_footer');
            $cachedContent = $header . $content . $footer;

            // Save the content to the cache for 10 minutes (600 seconds)
            $this->cache->save($cacheKey, $cachedContent, 600);
        }


        return $cachedContent;
    }

    public function user_types(): string
    {
        $cacheKey = 'user_types_view';
        $cachedContent = $this->cache->get($cacheKey);

        if ($cachedContent === null) {
            // Cache miss, generate the content
            $header = view('public/public_header');
            $content = view('public/user_types');
            $footer = view('public/public_footer');
            $cachedContent = $header . $content . $footer;

            // Save the content to the cache for 10 minutes (600 seconds)
            $this->cache->save($cacheKey, $cachedContent, 600);
        }

        return $cachedContent;
    }

    public function customer_registration(): string
    {
        $cacheKey = 'customer_registration_view';
        $cachedContent = $this->cache->get($cacheKey);

        if ($cachedContent === null) {
            // Cache miss, generate the content
            $header = view('public/public_header');
            $content = view('public/customer_registration');
            $footer = view('public/public_footer');
            $cachedContent = $header . $content . $footer;

            // Save the content to the cache for 10 minutes (600 seconds)
            $this->cache->save($cacheKey, $cachedContent, 600);
        }

        return $cachedContent;
    }

    public function brand_partner_registration(): string
    {
        $cacheKey = 'brand_partner_registration_view';
        $cachedContent = $this->cache->get($cacheKey);

        if ($cachedContent === null) {
            // Cache miss, generate the content
            $header = view('public/public_header');
            $content = view('public/brand_partner_registration');
            $footer = view('public/public_footer');
            $cachedContent = $header . $content . $footer;

            // Save the content to the cache for 10 minutes (600 seconds)
            $this->cache->save($cacheKey, $cachedContent, 600);
        }

        return $cachedContent;
    }

    public function register_customer(): ResponseInterface
    {
        // Get the form data using the request object
        $company_name = $this->request->getPost('companyName');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Call model method to insert data
        $inserted = $this->RegistrationModel->create_customer($company_name, $email, $password);

        if ($inserted) {
            // Handle successful insertion (e.g., redirect to a success page)
            session()->setFlashdata('success', 'Registration successful!');
        } else {
            // Handle insertion failure (e.g., show an error message)
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

        if ($inserted) {
            // Handle successful insertion (e.g., redirect to a success page)
            session()->setFlashdata('success', 'Registration successful!');
        } else {
            // Handle insertion failure (e.g., show an error message)
        }

        // Clear the related cache after insertion
        $this->cache->delete('brand_partner_registration_view');

        return redirect()->to('/brand_partner_registration');
    }
}
