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
        parent::__construct("properties", ["cod","street", "number", "district", "state", "city"]);
    }

    /**
     * Método para salvar ou alterar um locatário
     * @return bool
     */
    public function save(): bool {

        if (!parent::save()) {
           return false;
        }

        return true;
    }

    
    /**
     * 
     * @return Lessor|null
     */
    public function lessorProperty(): ?Lessor {
        
        if ($this->lessor) {
            return (new Lessor())->findById($this->lessor);
        }
        return null;
    }

    /**
     * 
     * @return type
     */
    public function owners() {
        $connect = Connect::getInstance();

        $owners = $connect->query("SELECT lessors.id,name from lessors inner join properties on properties.lessor=lessors.id
   WHERE properties.id='{$this->id}' ");

        return $owners->fetchAll();
    }
    
     /**
     * 
     * @return type
     */
    public function returnContract() {
        $connect = Connect::getInstance();

        $contracts = $connect->query("SELECT * from contracts 
                                   WHERE property='{$this->id}' and status='active'");

        return $contracts->fetchAll();
    }
}
