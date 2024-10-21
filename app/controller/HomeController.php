<?php 

class HomeController{
    public function index(){
        try{
            $home = Home::index();

            $parametros = array();
            $parametros['paramHome'] = $home;

            //$conteudo = $estrutura->render($parametros);
            //echo $conteudo;
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }
}
?>