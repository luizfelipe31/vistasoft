<?php

namespace Source\App;

use Source\Models\User;
use Source\Models\Lessee;
use Source\Models\Lessor;
use Source\Models\Property;
use Source\Models\Contract;
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
            "contract" => $contract
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
