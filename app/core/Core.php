<?php 

class Core{
    public function start($getUrl){
        $id = null;
        $acao = null;
        $controller = null;
        
        //PAGINA
        if(isset($getUrl['pagina'])){$controller = ucfirst($getUrl['pagina'].'Controller');} 
        else{$controller = "HomeController";}

        //PAGINA (TRATAMENTO DE CLASSE INEXISTENTE) 
        if(!class_exists ($controller)) {$controller = "ErroController";} 

        //METODO
        if(isset($getUrl['metodo'])){$acao = $getUrl['metodo'];} 
        else{$acao = "index";}

        //METODO (TRATAMENTO DE METODO INEXISTENTE) 
        if(!method_exists($acao,'')) {$acao = "index";} 

        //ID
        if(isset($urlGet['id'])){$id = $getUrl['id'];}

        //DIRECIONAMENTO PARA A CONTROLLER
        call_user_func_array(array(new $controller, $acao), array($id));
    }
}
?>