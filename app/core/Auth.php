<?php

namespace App\Core;

use App\Models\User;

class Auth {
    private $validator;
    private $session;

    public function __construct($data = []) {
        $this->validator = new Validator($data);
        $this->session = new Session();
    }

    public function register($data) {
        $errors = [];

      
        
        if (!$this->validator->validateEmail($data['email'])) {
            $errors['email'] = "Email invalide";
            var_dump($errors['email']);die();
            
        }
        
        if (!$this->validator->validateMin($data['password'], 6)) {
            $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères";
        }
        
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        if (User::where('email', $data['email'])->exists()) {
            return ['success' => false, 'errors' => ['email' => "Cet email existe déjà"]];
        }

        try {
            $user = new User();
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->save();

            $this->session->setFlash('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'errors' => ['general' => "Une erreur est survenue lors de l'inscription."]];
        }
    }

   
    public function login($email, $password) {
        
        $errors = [];
        
        if (!$this->validator->validateEmail($email)) {
            $errors['email'] = "Email invalide";
        }
    
        $user = User::where('email', $email)->first();
    
        if (!$user || !password_verify($password, $user->password)) {
            $errors['password'] = "Email ou mot de passe incorrect";
        }
    
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }
    
        $this->session->set('user_id', $user->id);
        $this->session->set('user_email', $user->email);
    
        $this->session->regenerate();
    
        return ['success' => true];
    }
    

    public function isLoggedIn() {
        return $this->session->has('user_id');
    }

    public function logout() {
        $this->session->clear();
        return true;
    }

    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return User::find($this->session->get('user_id'));
    }

    public function hasPermission($permission)
    {
        if ($user = $this->getCurrentUser()) {
            return $user->hasPermission($permission);
        }
        return false;
    }

    public function getAllPermissions()
    {
        if ($user = $this->getCurrentUser()) {
            return $user->getAllPermissions();
        }
        return [];
    }
}