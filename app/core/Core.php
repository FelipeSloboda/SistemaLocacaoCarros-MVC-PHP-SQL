<?php 

class Core{
    public function start($getUrl){
        $id = $acao = $controller = null;
        
        //PAGINA
        if(isset($getUrl['pagina'])){$controller = ucfirst($getUrl['pagina'].'Controller');} 
        else{$controller = "HomeController";}

        //PAGINA (TRATAMENTO DE CLASSE INEXISTENTE) 
        if(!class_exists ($controller)) {$controller = "ErroController";} 

        //METODO
        if(isset($getUrl['metodo'])){$acao = $getUrl['metodo'];} 
        else{$acao = "index";}

        //ID
        if((isset($getUrl['id'])) && ($getUrl['id'] != null)) {$id = $getUrl['id'];}

        //DIRECIONAMENTO PARA A CONTROLLER
        call_user_func_array(array(new $controller, $acao), array($id));
    }
}
?>