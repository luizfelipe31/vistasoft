<?php

/**dash**/
$router->get("/dash", "Dash:dash", "dash.dash");
$router->get("/dash/principal", "Dash:home", "dash.home");
$router->post("/dash/home", "Dash:home", "dash.homePost");
$router->get("/logoff", "Dash:logoff", "dash.logoff");

/**lessee**/
$router->get("/locatario", "LesseeController:home", "lessee.home");
$router->get("/locatario/cadastrar", "LesseeController:create", "lessee.create");
$router->post("/locatario/cadastrar", "LesseeController:create", "lessee.create");
$router->get("/locatario/alterar/{cod}", "LesseeController:update", "lessee.update");
$router->post("/locatario/alterar/{cod}", "LesseeController:update", "lessee.update");
$router->post("/locatario/excluir/{cod}", "LesseeController:delete", "lessee.delete");

/**lessor**/
$router->get("/locador", "LessorController:home", "lessor.home");
$router->get("/locador/cadastrar", "LessorController:create", "lessor.create");
$router->post("/locador/cadastrar", "LessorController:create", "lessor.create");
$router->get("/locador/alterar/{cod}", "LessorController:update", "lessor.update");
$router->post("/locador/alterar/{cod}", "LessorController:update", "lessor.update");
$router->post("/locador/excluir/{cod}", "LessorController:delete", "lessor.delete");

/**property**/
$router->get("/imovel", "PropertyController:home", "property.home");
$router->get("/imovel/cadastrar", "PropertyController:create", "property.create");
$router->post("/imovel/cadastrar", "PropertyController:create", "property.create");
$router->get("/imovel/alterar/{cod}", "PropertyController:update", "property.update");
$router->post("/imovel/alterar/{cod}", "PropertyController:update", "property.update");
$router->post("/imovel/excluir/{cod}", "PropertyController:delete", "property.delete");

/**contract**/
$router->get("/contrato", "ContractController:home", "contract.home");
$router->get("/contrato/cadastrar", "ContractController:create", "contract.create");
$router->post("/contrato/cadastrar", "ContractController:create", "contract.create");
$router->get("/contrato/alterar/{cod}", "ContractController:update", "contract.update");
$router->post("/contrato/alterar/{cod}", "ContractController:update", "contract.update");
$router->get("/contract/getOwner/{property}", "ContractController:getOwner", "contract.getOwner");

/**payment**/
$router->get("/mensalidade", "FinanceController:payment", "payment.home");
$router->get("/mensalidade/{page}", "FinanceController:payment","payment.payment");
$router->post("/mensalidade/confirm/{cod}", "FinanceController:confirmPayment", "finance.confirmPayment");

/**transfer**/
$router->get("/repasse", "FinanceController:transfer", "transfer.home");
$router->get("/repasse/{page}", "FinanceController:transfer","transfer.home");
$router->post("/repasse/confirm/{cod}", "FinanceController:confirmTransfer", "finance.confirmTransfer");