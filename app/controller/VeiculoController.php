<?php 

class VeiculoController{
    public function index(){
        try{
            //ACIONA A MODEL VEICULO, BUSCA TODOS OS VEICULOS QUE ESTAO CADASTRADOS.  
            $veiculo = Veiculo::selecionaTodos();  
                
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('veiculo.html');
    
            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['veiculos'] = $veiculo;
                
            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                 
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }

    public function criar(){
        try{
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('criarVeiculo.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();

            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                 
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }

    public function inserir(){
        try{
            var_dump($_POST);
            //ACIONA A MODEL VEICULKO, ACIONA METODO INSERIR COM PARAMETROS POST DO FORMULARIO  
            $cliente = Veiculo::inserir($_POST); 
            echo '<script>alert("INSERIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=criar"</script>';
        }
    }

    public function excluir($id){
        try{
            //ACIONA A MODEL VEICULO, ACIONA METODO EXLUIR COM PARAMETROS ID  
            Veiculo::excluir($id); 
            echo '<script>alert("EXCLUIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA EXLUIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=index"</script>';
        }
    }
    public function alterar($id){
        try{
            //ACIONA A MODEL VEICULO, BUSCA O VEICULO QUE ESTA CADASTRADO PELO ID.  
            $veiculo = Veiculo::selecionaPorId($id);  
            
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('alterarVEiculo.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['veiculo'] = $veiculo;
            $parametros['idveiculo'] = $veiculo->idveiculo;
            $parametros['placa'] = $veiculo->placa;
            $parametros['marca'] = $veiculo->marca;
            $parametros['modelo'] = $veiculo->modelo;
            $parametros['cor'] = $veiculo->cor;
            $parametros['ano'] = $veiculo->ano;
            
            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                 
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }

    public function atualizar(){
        try{
            //ACIONA A MODEL VEICULO, ACIONA METODO ATUALIZAR COM PARAMETROS POST DO FORMULARIO  
            Veiculo::atualizar($_POST); 
            echo '<script>alert("ATUALIZADO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=veiculo&metodo=index"</script>';
        }
    }
}
?>