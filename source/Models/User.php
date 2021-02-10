<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Source\Support\Message;
use Source\Core\Session;

use Exception;

class User extends DataLayer {

    /** @var MESSAGE */
    protected $message;

    public function __construct() {
        parent::__construct("users", ["name", "email", "phone",]);
        $this->message = new Message();
    }

    /**
     * Método para salvar ou alterar um usuário
     * @return bool
     */
    public function save(): bool {

        if (!$this->validateEmail() || !$this->validatePassword() || !parent::save()) {
           return false;
        }

        return true;
    }

    public function save2(): bool {
        parent::save();

        return true;
    }

    /**
     * Método para validação de E-mail ao incluir usuário
     * @return bool
     */
    protected function validateEmail(): bool {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id ", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("E-mail já cadastrado");
            return false;
        }
        return true;
    }

    /**
     * Método para validação de senha para inclusão de usuário já incluinda senha criptografada
     * @return bool
     */
    protected function validatePassword(): bool {
        if (empty($this->password) || strlen($this->password) < 5) {
            $this->fail = new Exception("Informe uma senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->password)["algo"]) {
            return true;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }

    /**
     * Método para achar um usuário pelo e-mail
     * @param string $email
     * @param string $columns
     * @return \Source\Models\User|null
     */
    public function findByEmail(string $email, string $columns = "*"): ?User {

        $find = $this->find("email= :e", "e={$email}", $columns)->fetch();

        return $find;
    }

  
    /**
     * 
     * @return string|null
     */
    public function showPhoto(): ?string {

        if ($this->photo && file_exists(__DIR__ . "/../../" . CONF_UPLOAD_DIR . "/{$this->photo}")) {
            return $this->photo;
        }

        return null;
    }


    /**
     * Método para entrar no sistema
     * @param string $email
     * @param string $password
     * @param bool $save
     * @param int $level
     * @return bool
     */
    public function login(string $email, string $password): bool {

        if(empty($email) && empty($email)){
            $this->fail = new Exception("Preencha E-mail e Senha.");
            return false;
        }
        
        if (!is_email($email)) {
            $this->fail = new Exception("O E-mail informado não é válido");
            return false;
        }
        if (!is_passwd($password)) {
            $this->fail = new Exception("A senha informada não é válida");
            return false;
        }

        $user = $this->findByEmail($email);

        if (!$user) {
            $this->fail = new Exception("E-mail informado não está cadastrado");
            return false;
        }

        if (!passwd_verify($password, $user->password)) {
            
            $this->fail = new Exception("Senha incorreta");

            return false;
        }

        (new Session())->set("authUserVista", $user->id);

        if (passwd_rehash($user->password)) {
            $user->password = $password;
            $user->save2();
        }

        return true;
    }

    /**
     * Método para carregar usuario na session caso a validação tenha sido efetuada
     * @return \Source\Models\User|null
     */
    public static function UserLog(): ?User {
        $session = new Session();
        if (!$session->has("authUserVista")) {
            return null;
        }

        return (new User)->findByid($session->authUserVista);
    }

    /**
     * Método para sair do sistema
     * @return void
     */
    public static function logout(): void {

        $session = new Session();
        $session->unset("authUserVista");
    }

}
