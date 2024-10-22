<?php 

class Cliente{
    public static function selecionaTodos() {
        //BUSCA TODOS OS CLIENTES QUE ESTAO CADASTRADOS.  
        $con = Connection::getStringConn();
        $sql = "SELECT * FROM clientes ORDER BY nome";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        //TRANSFORMA RESULTADO EM OBJETO
        $resultado = array();
        while ($row = $sql->fetchObject()) {
            $resultado[] = $row;
        }
        
        //TRATAMENTO PARA RESULTADO VAZIO
        if (!$resultado) {throw new Exception("Não existe nenhum cliente cadastrado !");}

        // RETORNO DO RESULTADO DA BUSCA OU EXCEPTION CASO SEJA VAZIO.
        return $resultado;
    }

    public static function inserir($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['cpf']) || empty($paramPost['nome']) || empty($paramPost['datanasc'])  || empty($paramPost['sexo'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //INSERE CADASTRO DE UM CLIENTE NOVO. 
        $con = Connection::getStringConn();
        $sql = "INSERT INTO clientes (cpf, nome, datanasc, sexo) VALUES ('{$paramPost['cpf']}','{$paramPost['nome']}','{$paramPost['datanasc']}','{$paramPost['sexo']}')";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI INSERIDO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir cliente.");} 
        return true;
    }

    public static function excluir($id) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($id)){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //EXCLUI CADASTRO DE UM CLIENTE EXISTENTE.
        $con = Connection::getStringConn();
        $sql = "DELETE FROM clientes WHERE idcliente = '{$id}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI EXCLUIDO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao excluir cliente.");} 
        return true;
    }

    public static function selecionaPorId($id) {
        //BUSCA O CLIENTE QUE ESTA CADASTRADO PELO ID.  
        $con = Connection::getStringConn();
        $sql = "SELECT * FROM clientes WHERE idcliente = '{$id}'";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        //TRANSFORMA RESULTADO EM OBJETO
        $resultado = $sql->fetchObject();
        
        //TRATAMENTO PARA RESULTADO VAZIO
        if (!$resultado) {throw new Exception("Não existe nenhum cliente cadastrado !");}

        // RETORNO DO RESULTADO DA BUSCA OU EXCEPTION CASO SEJA VAZIO.
        return $resultado;
    }

    public static function atualizar($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['cpf']) || empty($paramPost['nome']) || empty($paramPost['datanasc'])  || empty($paramPost['sexo'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //ATUALIZA CADASTRO DE UM CLIENTE EXISTENTE PELO ID. 
        $con = Connection::getStringConn();
        $sql = "UPDATE clientes SET cpf = '{$paramPost['cpf']}', nome = '{$paramPost['nome']}', datanasc = '{$paramPost['datanasc']}', sexo = '{$paramPost['sexo']}' WHERE idcliente = '{$paramPost['id']}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI ATUALIZADO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir cliente.");} 
        return true;
    }
}

?>