<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Lessor;
use Source\Models\Property;
/**
 * Description of Lessor
 *
 * @author Luiz
 */
class LessorController extends Controller {

    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }
    
    /**
     * 
     * @return void
     */
    public function home(): void{
        
        $lessors = (new Lessor())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locador",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessor/lessor", [
            "head" => $head,
            "menu" => "lessor",
            "lessors" => $lessors
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
                
                $lessor_create = new Lessor();
                $lessor_create->name = str_title($data->name);
                $lessor_create->email = $data->email;
                $lessor_create->cel = $data->cel;
                $lessor_create->transfer_day = $data->transfer_day;
                
                if (!$lessor_create->save()) {
                    $json["message"] = $lessor_create->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("cadastrado com sucesso.")->flash();
                $json["redirect"] = url("/locador/cadastrar");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locador Cadastrar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessor/lessor_create", [
            "head" => $head,
            "menu" => "lessor"
        ]);
        
    }
    
    /**
     * 
     * @param array $data
     * @return void
     */
    public function update(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        
        $lessor = (new Lessor())->find("cod=:cod","cod={$data["cod"]}")->fetch();
        
        if(!$lessor){
           $json["redirect"] = url("/locador"); 
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
                
                $lessor->name = str_title($data->name);
                $lessor->email = $data->email;
                $lessor->cel = $data->cel;
                $lessor->transfer_day = $data->transfer_day;
                
                if (!$lessor->save()) {
                    $json["message"] = $lessor->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("atualizado com sucesso.")->flash();
                $json["redirect"] = url("/locador/alterar/{$lessor->cod}");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Locador Alterar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("lessor/lessor_update", [
            "head" => $head,
            "menu" => "lessor",
            "lessor" => $lessor
        ]);
        
    }
    
    public function delete(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $lessor = (new Lessor())->find("cod=:cod","cod={$data["cod"]}")->fetch();

        $lessor_property = (new Property())->find("lessor=:lessor","lessor={$lessor->id}")->fetch();
        
        if($lessor_property){
            $json["message"] = "Esse locador posssui um imóvel, exclua o imóvel primeiro";
            echo json_encode($json);
            return;
        }
        
        if ($lessor==null) {
            $json["message"] = "Você tentou deletar um locador que não existe";
            echo json_encode($json);
            return;
        }

        $lessor->destroy;

        $this->message->info("Excluído com sucesso")->flash();
        $json["redirect"] = url("/locador");

        echo json_encode($json);
        return;

        
    }
}
