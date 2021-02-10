<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Property;
use Source\Models\Lessor;
use Source\Models\Lessee;
use Source\Models\Contract;
use Source\Models\Payment;
use Source\Models\Transfer;
use DateTime;
/**
 * Description of Contract
 *
 * @author Luiz
 */
class ContractController extends Controller  {
    
    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }
    
    /**
     * 
     * @return void
     */
    public function home(): void{
        
        $contracts = (new Contract())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Contrato",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("contract/contract", [
            "head" => $head,
            "menu" => "contract",
            "contracts" => $contracts
        ]);
        
    }
    
     /**
     * 
     * @param array|null $data
     * @return void
     */
    public function create(?array $data): void{
        
        
        if (!empty($data["action"]) && $data["action"] == "create") {
        
             if (!empty($data['csrf'])) {

                if ($_REQUEST && !csrf_verify($_REQUEST)) {

                    $json["message"] = "Erro ao enviar o formulário, atualize a página";
                    echo json_encode($json);
                    return;
                }
                

                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $data = (object)$post;
                
                $datetime1 = new DateTime(date_fmt_back($data->start_date));
                $datetime2 = new DateTime(date_fmt_back($data->end_date));
                $interval = $datetime1->diff($datetime2);
                $diff_month = $interval->format('%Y')*12+$interval->format('%M');

                if($diff_month<12){
                    $json["message"] = "O prazo mínimo para o contrato é de um ano";
                    echo json_encode($json);
                    return;                    
                }
                
                $start_date = explode("/", $data->start_date);
                
                $day_in_month = cal_days_in_month(CAL_GREGORIAN, $start_date[1], $start_date[2]);
                $discount = (str_replace([".", ","], ["", "."], $data->rent)/$day_in_month)*$start_date[0];
                $first_rent = round(str_replace([".", ","], ["", "."], $data->rent)-$discount,2);
                
  
                $contract_create = new Contract();
                $contract_create->property = $data->property;
                $contract_create->lessor = $data->lessor;
                $contract_create->lessee = $data->lessee;
                $contract_create->start_date = date_fmt_back($data->start_date);
                $contract_create->end_date = date_fmt_back($data->end_date);
                $contract_create->administration_fee = str_replace([".", ","], ["", "."], $data->administration_fee);
                $contract_create->rent = str_replace([".", ","], ["", "."], $data->rent);
                $contract_create->condominium = str_replace([".", ","], ["", "."], $data->condominium);
                $contract_create->iptu = str_replace([".", ","], ["", "."], $data->iptu);
                $contract_create->status = "active";
                
                
                if (!$contract_create->save()) {
                    $json["message"] = $contract_create->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $property_update = (new Property)->findById($data->property);
                $property_update->lessor =$data->lessor;
                $property_update->save();
                
                $lessor_day = (new Lessor())->findById($data->lessor);
                
                for($i=1;$i<=$diff_month;$i++){
                                       
                    $start_date_convert = date("d/m/Y", mktime(0, 0, 0, $start_date[1] + $i, $start_date[0], $start_date[2]) );
                    $reference_date_convert = date("d/m/Y", mktime(0, 0, 0, $start_date[1] + ($i-1), $start_date[0], $start_date[2]) );

                    $start_date_explode = explode("/", $start_date_convert);
                    $reference_date_explode = explode("/", $reference_date_convert);
                    
                    if($i==1){
                        $rent = $first_rent;
                    }else{
                        $rent = str_replace([".", ","], ["", "."], $data->rent);
                    }
                    
                    $value = round(($rent+str_replace([".", ","], ["", "."], $data->iptu))-(($rent+str_replace([".", ","], ["", "."], $data->iptu))*(str_replace([".", ","], ["", "."], $data->administration_fee)/100)),2);
                    
                    $payment = new Payment();
                    $payment->contract = $contract_create->id;
                    $payment->lessee = $data->lessee;
                    $payment->rent = $rent;
                    $payment->condominium = str_replace([".", ","], ["", "."], $data->condominium);
                    $payment->iptu = str_replace([".", ","], ["", "."], $data->iptu);
                    $payment->reference = $reference_date_explode[1]."/".$reference_date_explode[2];
                    $payment->due_date = $start_date_explode[2]."/".$start_date_explode[1]."/01";
                    $payment->status = 0;
                    $payment->save();
                 
                    $transfer = new Transfer();
                    $transfer->contract = $contract_create->id;
                    $transfer->lessor = $data->lessor;
                    $transfer->payment = $payment->id;
                    $transfer->value = $value;
                    $transfer->administration_fee = str_replace([".", ","], ["", "."], $data->administration_fee);
                    $transfer->transfer_date = $start_date_explode[2]."/".$start_date_explode[1]."/".$lessor_day->transfer_day;
                    $transfer->status=0;
                    $transfer->save();
                
                }
                
                $this->message->info("cadastrado com sucesso.")->flash();
                $json["redirect"] = url("/contrato/cadastrar");

                echo json_encode($json);
                return;
                
             }
        
        }
    
        $lessees = (new Lessee())->find("id not in(select lessee from contracts where status='active')")->fetch(true);
        
        $properties = (new Property)->find("id not in(select property from contracts where status='active')")->fetch(true);
        
        $lessors = (new Lessor)->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Contrato Cadastrar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("contract/contract_create", [
            "head" => $head,
            "menu" => "contract",
            "lessees" => $lessees,
            "properties" => $properties,
            "lessors" => $lessors
        ]);
    }
    
     /**
     * 
     * @param array $data
     * @return void
     */
    public function update(array $data): void{
    
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        
        $contract = (new Contract())->find("cod=:cod","cod={$data["cod"]}")->fetch();
        
        if (!empty($data["action"]) && $data["action"] == "update") {
           
            if (!empty($data['csrf'])) {

                if ($_REQUEST && !csrf_verify($_REQUEST)) {

                    $json["message"] = "Erro ao enviar o formulário, atualize a página";
                    echo json_encode($json);
                    return;
                }
                
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $data = (object)$post;
                
                $contract->administration_fee = str_replace([".", ","], ["", "."], $data->administration_fee);
                $contract->rent = str_replace([".", ","], ["", "."], $data->rent);
                $contract->condominium = str_replace([".", ","], ["", "."], $data->condominium);
                $contract->iptu = str_replace([".", ","], ["", "."], $data->iptu); 
                $contract->status = $data->status;        

                if (!$contract->save()) {
                    $json["message"] = $contract->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $payments = (new Payment())->find("contract=:contract and status=0","contract={$contract->id}")->fetch(true);
                $transfers = (new Transfer())->find("contract=:contract and status=0 and payment not in (select id from payments where contract=:contract and status=1)","contract={$contract->id}")->fetch(true);
                
                if($data->status=="active"){
                
                    foreach($payments as $payment){
                        $payment->rent = str_replace([".", ","], ["", "."], $data->rent);
                        $payment->condominium = str_replace([".", ","], ["", "."], $data->condominium);
                        $payment->iptu = str_replace([".", ","], ["", "."], $data->iptu);
                        $payment->save();                    
                    }
                    foreach($transfers as $transfer){
                       
                       $transfer_payment = (new Payment())->find("id=:payment","payment={$transfer->payment}")->fetch();
                       $transfer->administration_fee = str_replace([".", ","], ["", "."], $data->administration_fee);
                       $transfer->value = round(($transfer_payment->rent+str_replace([".", ","], ["", "."], $data->iptu))-(($transfer_payment->rent+str_replace([".", ","], ["", "."], $data->iptu))*(str_replace([".", ","], ["", "."], $data->administration_fee)/100)),2);; 
                       $transfer->save();
                    }
                }else{
                    
                    foreach($payments as $payment){
                       $payment->destroy(); 
                    }
                    
                    foreach($transfers as $transfer){
                       $transfer->destroy(); 
                    }
                }
                
                
                
                $this->message->info("atualizado com sucesso.")->flash();
                $json["redirect"] = url("/contrato/alterar/{$contract->cod}");

                echo json_encode($json);
                return;
           }
            
        }
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Contrato Alterar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        $lessees = (new Lessee())->find("id not in(select lessee from contracts where status='active')")->fetch(true);
        
        $properties = (new Property)->find("id not in(select property from contracts where status='active')")->fetch(true);
        
        echo $this->view->render("contract/contract_update", [
            "head" => $head,
            "menu" => "contract",
            "contract" => $contract,
            "lessees" => $lessees,
            "properties" => $properties
        ]);
            
    }
    
    /**
     * @param array $data
     */
    public function getOwner(array $data): void {

        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        
        $properties = (new Property())->findById("{$data["property"]}");

        $ownerList = null;

        foreach ($properties->owners() as $owner) {

            $ownerList[] = $owner;

        }

        echo json_encode(["owner" => $ownerList]);

    }
}
