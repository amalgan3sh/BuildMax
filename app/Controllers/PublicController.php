<?php

namespace App\Controllers;
use App\Models\RegistrationModel;

class PublicController extends BaseController
{
    protected $RegistrationModel;

    public function __construct() {
        $this->RegistrationModel = new RegistrationModel();
    }
    
    public function index(): string
    {
        // Load the header and the main view, combining them into a single output
        $header = view('public/public_header');
        $content = view('public/index');
        $footer = view('public/public_footer');
        
        // Return the combined view content
        return $header . $content.$footer;
    }

    public function user_types() : string{
        // Load the header and the main view, combining them into a single output
        $header = view('public/public_header');
        $content = view('public/user_types');
        $footer = view('public/public_footer');
        
        // Return the combined view content
        return $header . $content.$footer;
    }
    public function customer_registration() : string{
        // Load the header and the main view, combining them into a single output
        $header = view('public/public_header');
        $content = view('public/customer_registration');
        $footer = view('public/public_footer');
        
        // Return the combined view content
        return $header . $content.$footer;
    }
    public function brand_partner_registration() : string{
        // Load the header and the main view, combining them into a single output
        $header = view('public/public_header');
        $content = view('public/brand_partner_registration');
        $footer = view('public/public_footer');
        
        // Return the combined view content
        return $header . $content.$footer;
    }

    public function register_customer() {
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
        return redirect()->to('/customer_registration');
    }

}
