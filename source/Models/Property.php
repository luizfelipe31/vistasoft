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
class Property extends DataLayer {
    
    public function __construct() {
        parent::__construct("properties", ["zipcode", "street", "number", "district", "state", "city", "lessor"]);
    }

    /**
     * Método para salvar ou alterar um locatário
     * @return bool
     */
    public function save(): bool {

        if (!$this->validateCep() || !parent::save()) {
           return false;
        }

        return true;
    }
   
    
    /**
     * Método para validação de CEP ao incluir imóvel
     * @return bool
     */
    protected function validateCep(): bool {
        if (empty($this->zipcode)) {
            $this->fail = new Exception("Informe um CEP");
            return false;
        }

        $propertyCep = null;
        if (!$this->id) {
            $propertyCep = $this->find("zipcode = :zipcode", "zipcode={$this->zipcode}")->count();
        } else {
            $propertyCep = $this->find("zipcode = :zipcode AND id != :id ", "zipcode={$this->zipcode}&id={$this->id}")->count();
        }

        if ($propertyCep) {
            $this->fail = new Exception("CEP já cadastrado");
            return false;
        }
        return true;
    }
    
    /**
     * 
     * @return Lessor|null
     */
    public function lessorProperty(): ?Lessor {
        return (new Lessor())->findById($this->lessor);
    }

      /**
     * @return Level|null
     */
    public function owners() {
        $connect = Connect::getInstance();

        $owners = $connect->query("SELECT lessors.id,name from lessors inner join properties on properties.lessor=lessors.id
   WHERE properties.id='{$this->id}' ");

        return $owners->fetchAll();
    }
}
