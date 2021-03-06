<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;
use Exception;

/**
 * Description of Lessee
 *
 * @author Luiz
 */
class Lessee extends DataLayer {
    
    public function __construct() {
        parent::__construct("lessees", ["name", "email", "cel"]);
    }

    /**
     * Método para salvar ou alterar um locatário
     * @return bool
     */
    public function save(): bool {

        if (!$this->validateEmail() || !parent::save()) {
           return false;
        }

        return true;
    }
   
    
    /**
     * Método para validação de E-mail ao incluir locatário
     * @return bool
     */
    protected function validateEmail(): bool {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $lesseeByEmail = null;
        if (!$this->id) {
            $lesseeByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $lesseeByEmail = $this->find("email = :email AND id != :id ", "email={$this->email}&id={$this->id}")->count();
        }

        if ($lesseeByEmail) {
            $this->fail = new Exception("E-mail já cadastrado");
            return false;
        }
        return true;
    }
    
}
