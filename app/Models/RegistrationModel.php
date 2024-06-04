<?php
namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model {
    protected $table = 'users'; // your table name
    protected $allowedFields = ['user_name', 'email', 'phone','password','company_name','user_type']; // fields allowed for mass assignment

    public function create_customer($company_name, $email, $password) {
        // Insert data into the database
        $data = [
            'company_name' => $company_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'password' => 'customer',
        ];

        return $this->insert($data);
    }
}
