<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Lessee;
use Source\Models\Contract;
/**
 * Description of Lessee
 *
 * @author Luiz
 */
class LesseeController extends Controller {

    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }
    
    /**
     * 
     * @return void
     */
    public function home(): void{
        
        $lesses = (new Lessee())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locatário",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessee/lessee", [
            "head" => $head,
            "menu" => "lessee",
            "lessees" => $lesses
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
                
                $lesse_create = new Lessee();
                $lesse_create->name = str_title($data->name);
                $lesse_create->email = $data->email;
                $lesse_create->cel = $data->cel;
                
                if (!$lesse_create->save()) {
                    $json["message"] = $lesse_create->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("cadastrado com sucesso.")->flash();
                $json["redirect"] = url("/locatario/cadastrar");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locatário Cadastrar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessee/lessee_create", [
            "head" => $head,
            "menu" => "lessee"
        ]);
        
    }
    
    /**
     * 
     * @param array $data
     * @return void
     */
    public function update(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        
        $lessee = (new Lessee())->find("cod=:cod","cod={$data["cod"]}")->fetch();
        
        if(!$lessee){
           $json["redirect"] = url("/locatario"); 
        }
        
        if (!empty($data["action"]) && $data["action"] == "update") {
        
             if (!empty($data['csrf'])) {

                if ($_REQUEST && !csrf_verify($_REQUEST)) {

                    $json["message"] = "Erro ao enviar o formulário, atualize a página";
                    echo json_encode($json);
                    return;
                }
                
                $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

                $data = (object)$post;
                
                $lessee->name = str_title($data->name);
                $lessee->email = $data->email;
                $lessee->cel = $data->cel;
                
                if (!$lessee->save()) {
                    $json["message"] = $lesse_create->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("atualizado com sucesso.")->flash();
                $json["redirect"] = url("/locatario/alterar/{$lessee->cod}");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locatário Alterar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessee/lessee_update", [
            "head" => $head,
            "menu" => "lessee",
            "lessee" => $lessee
        ]);
        
    }
    
    public function delete(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $lessee = (new Lessee())->find("cod=:cod","cod={$data["cod"]}")->fetch();

        $lessee_contract = (new Contract())->find("lessee=:lessee","lessee={$lessee->id}")->fetch();
        
        if($lessee_contract){
            $json["message"] = "Esse Locatário posssui um contrato, exclua o contrato primeiro";
            echo json_encode($json);
            return;
        }
        
        if ($lessee==null) {
            $json["message"] = "Você tentou deletar um locatário que não existe";
            echo json_encode($json);
            return;
        }

        $lessee->destroy;

        $this->message->info("Excluído com sucesso")->flash();
        $json["redirect"] = url("/locatario");

        echo json_encode($json);
        return;

        
    }
}
