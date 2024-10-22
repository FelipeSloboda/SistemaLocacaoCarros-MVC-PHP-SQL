<?php 

class LocacaoController{
    public function index(){
        try{
            //ACIONA A MODEL LOCACAO, BUSCA TODOS OS VEICULOS QUE ESTAO DISPONIVEIS PARA LOCACAO.  
            $locacao = Locacao::index();
            
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('locacao.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['veiculos'] = $locacao;
            
            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                   
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }

    public function locar(){
        try{
            //ACIONA A MODEL LOCACAO, ACIONA METODO LOCAR COM PARAMETROS POST DO FORMULARIO  
            $locacao = Locacao::locar($_POST); 
            echo '<script>alert("LOCADO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=locacao&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=locacao&metodo=index"</script>';
        }
    }

    public function devolver(){
        try{
            //ACIONA A MODEL LOCACAO, ACIONA METODO DEVOLVER COM PARAMETROS POST DO FORMULARIO  
            $locacao = Locacao::devolver($_POST); 
            echo '<script>alert("DEVOLVIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=locacao&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=locacao&metodo=index"</script>';
        }
    }


}
?>