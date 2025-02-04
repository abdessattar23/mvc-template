<?php

namespace App\Core;
class Validator{
    public array $errors = [];
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function validate(array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {
            $fieldRules = explode('|', $fieldRules);
            
            foreach ($fieldRules as $rule) {
                if (strpos($rule, ':') !== false) {
                    [$ruleName, $parameter] = explode(':', $rule);
                } else {
                    $ruleName = $rule;
                    $parameter = null;
                }

                $methodName = 'validate' . ucfirst($ruleName);
                if (method_exists($this, $methodName)) {
                    if (!$this->$methodName($field, $parameter)) {
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }


    public function validateRequired(string $field): bool
    {
        $value = $this->data[$field] ?? '';
        if (empty($value) && $value !== '0') {
            $this->errors[$field]= "Le champ {$field} est obligatoire.";
            return false;
        }
        return true;
    }


    public function validateEmail(string $field): bool
    {
        
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }
        
        
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
           
            $this->errors[$field]= "Le champ {$field} doit être une adresse email valide.";
            return false;
        }
        return true;
    }


    public function validateMin(string $field, string $parameter): bool
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }

        
        if (strlen($this->data[$field]) < (int)$parameter) {
            $this->errors[$field]= "Le champ {$field} doit contenir au moins {$parameter} caractères.";
            return false;
        }
        return true;
    }


    public function validateMax(string $field, string $parameter): bool
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }

        if (strlen($this->data[$field]) > (int)$parameter) {
            $this->errors[$field]= "Le champ {$field} ne doit pas dépasser {$parameter} caractères.";
            return false;
        }
        return true;
    }


    public function validateNumeric(string $field)
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }

        if (!is_numeric($this->data[$field])) {
            $this->errors[$field]= "Le champ {$field} doit être numérique.";
            return false;
        }
        return true;
    }



    public function validateAlpha(string $field): bool
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }

        if (!ctype_alpha($this->data[$field])) {
            $this->errors[$field]= "Le champ {$field} ne doit contenir que des lettres.";
            return false;
        }
        return true;
    }


    public function validateAlphaNum(string $field): bool
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            return true;
        }

        if (!ctype_alnum($this->data[$field])) {
            $this->errors[$field]= "Le champ {$field} ne doit contenir que des lettres et des chiffres.";
            return false;
        }
        return true;
    }
}