<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Description of Payment
 *
 * @author Luiz
 */
class Payment extends DataLayer {
    
    public function __construct() {
        parent::__construct("payments", ["contract", "lessee", "rent", "iptu", "reference", "due_date", "rent", "iptu"]);
    }
    
    /**
     * 
     * @return Lessee
     */
    public function lesseePayment(): Lessee {
        return (new Lessee())->findById($this->lessee);
    }    
}
