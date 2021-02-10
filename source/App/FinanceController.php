<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Contract;
use Source\Models\Payment;
use Source\Models\Transfer;

/**
 * Description of Finance
 *
 * @author Luiz
 */
class FinanceController extends Controller  {
    
    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }
    
    /**
    * 
    * @return void
    */
    public function payment(): void{
        
        $payments = (new Payment())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Mensalidade",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("finance/payment", [
            "head" => $head,
            "menu" => "payment",
            "payments" => $payments
        ]);
        
    }
    
    public function confirmPayment(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $payment = (new Payment())->find("cod=:cod","cod={$data["cod"]}")->fetch();

        if ($payment==null) {
            $json["message"] = "Essa mensalidade não existe.";
            echo json_encode($json);
            return;
        }

        $transfer = (new Transfer())->find("payment=:payment","payment={$payment->id}")->fetch();
        
        if($data["action"]==0 && $transfer->status=1){
            $json["message"] = "Não pode tirar a confirmação dessa mensalidade, pois já foi feito o repasse.";
            echo json_encode($json);
            return;
        }
        
        $payment->status=$data["action"];
        $payment->save();

        $this->message->info("Realizado com sucesso")->flash();
        $json["redirect"] = url("/mensalidade");

        echo json_encode($json);
        return;

        
    }
    
    /**
    * 
    * @return void
    */
    public function transfer(): void{
        
        $transfers = (new Transfer())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Contrato",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("finance/transfer", [
            "head" => $head,
            "menu" => "transfer",
            "transfers" => $transfers
        ]);
        
    }
    
    public function confirmTransfer(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $transfer = (new Transfer())->find("cod=:cod","cod={$data["cod"]}")->fetch();

        if ($transfer==null) {
            $json["message"] = "Essa transferência não existe.";
            echo json_encode($json);
            return;
        }
        
        if ($transfer->returnPayment()->status==0) {
            $json["message"] = "Esse pagamento ainda não foi realizado, aguarde o pagamento ser feito para fazer o repasse.";
            echo json_encode($json);
            return;
        }

        $transfer->status=$data["action"];
        $transfer->save();

        $this->message->info("Realizado com sucesso")->flash();
        $json["redirect"] = url("/repasse");

        echo json_encode($json);
        return;

        
    }
}
