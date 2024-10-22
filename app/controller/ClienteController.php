<?php 

class ClienteController{
    public function index(){
        try{
            //ACIONA A MODEL CLIENTE, BUSCA TODOS OS CLIENTES QUE ESTAO CADASTRADOS.  
            $cliente = Cliente::selecionaTodos();  
            
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('cliente.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['clientes'] = $cliente;
            
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
            $template = $twig->load('criarCliente.html');

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
            //ACIONA A MODEL CLIENTE, ACIONA METODO INSERIR COM PARAMETROS POST DO FORMULARIO  
            $cliente = Cliente::inserir($_POST); 
            echo '<script>alert("INSERIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=criar"</script>';
        }
    }

    public function excluir($id){
        try{
            //ACIONA A MODEL CLIENTE, ACIONA METODO EXLUIR COM PARAMETROS ID  
            Cliente::excluir($id); 
            echo '<script>alert("EXCLUIDO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA EXLUIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=index"</script>';
        }
    }

    public function alterar($id){
        try{
            //ACIONA A MODEL CLIENTE, BUSCA O CLIENTE QUE ESTA CADASTRADO PELO ID.  
            $cliente = Cliente::selecionaPorId($id);  
            
            //PREPARA O TWIG COM O CONTEUDO DINAMICO
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('alterarcliente.html');

            //DEFINE OS PARAMETROS DINAMICOS
            $parametros = array();
            $parametros['cliente'] = $cliente;
            $parametros['idcliente'] = $cliente->idcliente;
            $parametros['cpf'] = $cliente->cpf;
            $parametros['nome'] = $cliente->nome;
            $parametros['datanasc'] = $cliente->datanasc;
            $parametros['sexo'] = $cliente->sexo;
            
            //EXIBE O CONTEUDO DINAMICO
            $conteudo = $template->render($parametros);
            echo $conteudo;                 
        }
        catch (Exception $e) {echo($e->getMessage());
        }
    }

    public function atualizar(){
        try{
            //ACIONA A MODEL CLIENTE, ACIONA METODO ATUALIZAR COM PARAMETROS POST DO FORMULARIO  
            Cliente::atualizar($_POST); 
            echo '<script>alert("ATUALIZADO COM SUCESSO !");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=index"</script>'; 
  
        }
        catch (Exception $e) {
            //TRATAMENTO DE ERRO, REDIRECIONA A PAGINA CASO NAO SEJA INSERIDO 
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost/SistemaLocacaoCarros-MVC-PHP-SQL/?pagina=cliente&metodo=index"</script>';
        }
    }
}
?>