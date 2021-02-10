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
class Transfer extends DataLayer {
    
    public function __construct() {
        parent::__construct("transfers", ["contract", "lessor", "payment", "value" ,"transfer_date"]);
    }
        
    /**
     * 
     * @return Lessor
     */
    public function lessorTransfer(): Lessor {
        return (new Lessor())->findById($this->lessor);
    }
    
     /**
     * 
     * @return Lessor
     */
    public function returnPayment(): Payment {
        return (new Payment())->findById($this->payment);
    }
    
     /**
     * 
     * @return Lessor
     */
    public function returnContract(): Contract {
        return (new Contract())->findById($this->contract);
    }
}
