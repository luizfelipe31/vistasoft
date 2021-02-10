<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Property;
use Source\Models\Lessor;

/**
 * Description of Property
 *
 * @author Luiz
 */
class PropertyController extends Controller {

    public function __construct($router) {
        parent::__construct($router, CONF_VIEW_ADMIN);
    }
    
    /**
     * 
     * @return void
     */
    public function home(): void{
        
 /*           $dados = array(
            'fields' => array( 'Cidade', 'Bairro', 'ValorVenda' )
            );

            $key         =  'xc9fdd79584fb8d369a6a579af1a8f681'; //Informe sua chave aqui
            $postFields  =  json_encode( $dados );
            $url         =  'http://sandbox-rest.vistahost.com.br/imoveis/listar?key=' . $key;
            $url        .=  '&pesquisa=' . $postFields;

            $ch = curl_init($url);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HTTPHEADER , array( 'Accept: application/json' ) );
            $result = curl_exec( $ch );

            $result = json_decode( $result, true );
            print_r( $result );
        exit;*/
        $properties = (new Property())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóvel",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("property/property", [
            "head" => $head,
            "menu" => "property",
            "properties" => $properties
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
                
                $property_create = new Property();
                $property_create->zipcode = $data->zipcode;
                $property_create->street = $data->street;
                $property_create->number = $data->number;
                $property_create->complement = $data->complement;
                $property_create->district = $data->district;
                $property_create->state = $data->state;
                $property_create->city = $data->city;
                $property_create->lessor = $data->lessor;
                
                if (!$property_create->save()) {
                    $json["message"] = $property_create->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("cadastrado com sucesso.")->flash();
                $json["redirect"] = url("/imovel/cadastrar");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        $lessors = (new Lessor())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóvel Cadastrar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("property/property_create", [
            "head" => $head,
            "menu" => "property",
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
        
        $property = (new Property())->find("cod=:cod","cod={$data["cod"]}")->fetch();
        
        if(!$property){
           $json["redirect"] = url("/imovel"); 
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
                
                $property->zipcode = $data->zipcode;
                $property->street = $data->street;
                $property->number = $data->number;
                $property->complement = $data->complement;
                $property->district = $data->district;
                $property->state = $data->state;
                $property->city = $data->city;
                $property->lessor = $data->lessor;
                
                if (!$property->save()) {
                    $json["message"] = $property->fail()->getMessage();
                    echo json_encode($json);
                    return;
                }
                
                $this->message->info("atualizado com sucesso.")->flash();
                $json["redirect"] = url("/imovel/alterar/{$property->cod}");

                echo json_encode($json);
                return;
                
             }
        
        }
        
        $lessors = (new Lessor())->find()->fetch(true);
        
        $head = $this->seo->render(
            CONF_SITE_NAME . " | Imóvel Alterar",
            CONF_SITE_DESC,
            url("/"),
            theme("assets/images/image.jpg", CONF_VIEW_THEME_ADMIN),
            false
        );

        echo $this->view->render("property/property_update", [
            "head" => $head,
            "menu" => "property",
            "lessors" => $lessors,
            "property" => $property
        ]);
        
    }
    
    public function delete(array $data): void{
        
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        $property = (new Property())->find("cod=:cod","cod={$data["cod"]}")->fetch();

        if ($property==null) {
            $json["message"] = "Você tentou deletar um imóvel que não existe";
            echo json_encode($json);
            return;
        }

        $property->destroy;

        $this->message->info("Excluído com sucesso")->flash();
        $json["redirect"] = url("/imovel");

        echo json_encode($json);
        return;

        
    }
}
