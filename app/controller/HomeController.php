<?php 

class HomeController{
    public function index(){
        try{
            //ACIONA A MODEL HOME, BUSCA TODOS OS VEICULOS QUE ESTAO DISPONIVEIS PARA LOCACAO.  
            $home = Home::selectDisponiveis();  
            
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['veiculos'] = $home;
            
            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                   
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }
}
?>