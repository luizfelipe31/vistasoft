<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\User;

/**
 * Description of LogIn
 *
 * @author Luiz
 */
class LogIn extends Controller {

    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }

    /**
     * Admin access redirect
     */
    public function root(): void {
        $user = User::UserLog();
        
        if ($user) {
            redirect("/dash");
        } else {
            redirect("/login");
        }
    }

    /**
     * @param array|null $data
     */
    public function login(?array $data): void {
        
        $userLog = User::UserLog();
        
        if ($userLog) {
            redirect("/dash");
        }
        
        if (!empty($data["action"]) && $data["action"] == "login") {
            if (!empty($data['csrf'])) {

                if ($_REQUEST && !csrf_verify($_REQUEST)) {

                    $json["message"] = "Erro ao enviar o formulário, atualize a página";
                    echo json_encode($json);
                    return;
                }
                
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $data = (object) $post;
                
                $user = new User();
                $login = $user->login($data->email, $data->password);
                
                if ($login) {
                    $json["redirect"] = url("/dash");
                } else {
                    $json["message"] = $user->fail()->getMessage();
                }
                
                echo json_encode($json);
                return;
            }
        }
    
        $head = $this->seo->render(
                CONF_SITE_NAME . " | Login",
                CONF_SITE_DESC,
                url("/"),
                theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
                false
        );

        echo $this->view->render("login/login", [
            "head" => $head
        ]);
    }


    /**
     * @param array $data
     */
    public function error(array $data): void {

        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está indisponível no momento. Já estamos resolvendo e agradecemos pela compreenssão";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe, Estamos em manutenção!";
                $error->message = "Em Breve retornaremos com novidades em nosso conteúdo";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
            default:
                $error->code = $data["errcode"];
                $error->title = "Ooops. Conteúdo indisponível :/";
                $error->message = "Você tentou acessar uma área que não existe";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | Error ",
            CONF_SITE_DESC,
            url("/"),
            url("/assets/images/image.jpg"),
            false
        );

        echo $this->view->render("_error", [
            "head" => $head,
            "app" => "dash",
            "var_error" => $error
        ]);
    }
}
