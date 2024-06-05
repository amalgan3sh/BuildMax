<?php
namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model {
    protected $table = 'users'; // your table name
    protected $allowedFields = ['user_name', 'email', 'phone','password','company_name','user_type']; // fields allowed for mass assignment

    public function create_customer($company_name, $email, $password) {
        // Check if the email is already registered
        $existingCustomer = $this->get_customer_by_email($email);
        if ($existingCustomer !== null) {
            // Account is already registered, return a message or throw an exception
            return 'exists';
        }
        // Insert data into the database
        $data = [
            'company_name' => $company_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'user_type' => 'customer',
        ];

        return $this->insert($data);
    }
    private function get_customer_by_email($email) {
        // Implement a method to retrieve a customer by email from the database
        // This method may vary depending on your database structure and ORM usage
        // Here's a simplified example assuming you're using CodeIgniter's Query Builder
        $query = $this->db->table('users')->where('email', $email)->get();
        return $query->getRow();
    }

    public function create_brand_partner($company_name, $email, $password) {
        // Insert data into the database
        $data = [
            'company_name' => $company_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'user_type' => 'partner',
        ];

        return $this->insert($data);
    }
}
