<?php

namespace App\Controllers;

class PublicController extends BaseController
{
    public function index(): string
    {
        // Load the header and the main view, combining them into a single output
        $header = view('public/public_header');
        $content = view('public/index');
        $footer = view('public/public_footer');
        
        // Return the combined view content
        return $header . $content.$footer;
    }
    public function create_account() : string{
        // Load the header and the main view, combining them into a single output
        $content = view('public/create_account');
        
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

}
