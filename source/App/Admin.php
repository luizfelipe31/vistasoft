<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\User;
use Source\Core\Session;

/**
 * Description of Admin
 *
 * @author Luiz
 */
class Admin extends Controller {

    /**
     * @var \Source\Models\User|null
     */
    protected $user;

    /**
     * Admin constructor.
     */
    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);

        $this->user = User::UserLog();

        ////verifica se a sessão existe
        if (!$this->user) {
            $this->message->info("Para acessar é preciso logar-se")->flash();
            redirect("/login");
        }
    }

}
