<?php

namespace Source\App;

use Source\Models\User;
use Source\Models\Lessee;
use Source\Models\Lessor;
use Source\Models\Property;
use Source\Models\Contract;
use Source\Models\Payment;
use Source\Models\Transfer;
/**
 * Description of Dash
 *
 * @author Luiz
 */
class Dash extends Admin {

    /**
     * Dash constructor.
     */
    public function __construct($router) {
        parent::__construct($router);
    }

    /**
     *
     */
    public function dash(): void {
        redirect("/dash/principal");
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function home(): void {

        $lessee = (new Lessee)->find()->count();
        $lessor = (new Lessor)->find()->count();
        $property = (new Property)->find()->count();
        $contract = (new Contract)->find("status='active'")->count();
        $transfer_balance=0;
        $transfer_pending=0;
        
        $transfers = (new Transfer())->find("status=1")->fetch(true);
        $transfers2 = (new Transfer())->find("status=0")->fetch(true);
        $transfers_pending_count = (new Transfer())->find("status = 0 and payment in (select id from payments where status=1)")->count();
        
        if($transfers){
            foreach($transfers as $transfer){
               $transfer_balance+=$transfer->value;
            }
        }

        if($transfers2){
            foreach($transfers2 as $transfer2){
               $transfer_pending+=$transfer2->value;
            }
        }
        
        $head = $this->seo->render(
                CONF_SITE_NAME . " | Dashboard",
                CONF_SITE_DESC,
                url("/"),
                theme("/assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
                false
        );

        echo $this->view->render("dash/dashboard1", [
            "menu" => "dash",
            "head" => $head,
            "lessor" => $lessor,
            "lessee" => $lessee,
            "property" => $property,
            "contract" => $contract,
            "balance" => $transfer_balance,
            "transfer_pending" => $transfer_pending,
            "transfers_pending_count" => $transfers_pending_count
        ]);
    }

    /**
     * 
     * @return void
     */
    public function logoff(): void {
        $this->message->info("Você saiu com sucesso {$this->user->name}.")->flash();

        User::logout();
        redirect("/login");
    }

}
