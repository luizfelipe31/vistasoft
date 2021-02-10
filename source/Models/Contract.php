<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

use Exception;

/**
 * Description of Contract
 *
 * @author Luiz
 */
class Contract extends DataLayer {
    
    public function __construct() {
        parent::__construct("contracts", ["property", "lessor", "lessee", "start_date", "end_date", "administration_fee", "rent", "iptu"]);
    }
    
    /**
    * 
    * @return Property
    */
    public function returnProperty(): Property {
        return (new Property())->findById($this->property);
    }
    
    /**
    * 
    * @return Lessee
    */
    public function returnLessee(): Lessee {
        return (new Lessee())->findById($this->lessee);
    }
    
   /**
    * 
    * @return Lessor
    */
    public function returnLessor(): Lessor {
        return (new Lessor())->findById($this->lessor);
    }
}
