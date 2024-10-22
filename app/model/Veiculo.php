<?php 

class Veiculo{
    public static function selecionaTodos() {
        //BUSCA TODOS OS VEICULOS QUE ESTAO CADASTRADOS.  
        $con = Connection::getStringConn();
        $sql = "SELECT * FROM veiculos ORDER BY modelo";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        //TRANSFORMA RESULTADO EM OBJETO
        $resultado = array();
        while ($row = $sql->fetchObject()) {
            $resultado[] = $row;
        }
        
        //TRATAMENTO PARA RESULTADO VAZIO
        if (!$resultado) {throw new Exception("Não existe nenhum veiculo cadastrado !");}

        // RETORNO DO RESULTADO DA BUSCA OU EXCEPTION CASO SEJA VAZIO.
        return $resultado;
    }

    public static function inserir($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['placa']) || empty($paramPost['marca']) || empty($paramPost['modelo']) || empty($paramPost['cor'])  || empty($paramPost['ano'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //INSERE CADASTRO DE UM CLIENTE NOVO. 
        $con = Connection::getStringConn();
        $sql = "INSERT INTO veiculos (placa, marca, modelo, cor, ano) VALUES ('{$paramPost['placa']}','{$paramPost['marca']}','{$paramPost['modelo']}','{$paramPost['cor']}','{$paramPost['ano']}')";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI INSERIDO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir veiculo.");} 
        return true;
    }

    public static function excluir($id) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($id)){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //EXCLUI CADASTRO DE UM VEICULO EXISTENTE.
        $con = Connection::getStringConn();
        $sql = "DELETE FROM veiculos WHERE idveiculo = '{$id}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI EXCLUIDO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao excluir veiculo.");} 
        return true;
    }

    public static function selecionaPorId($id) {
        //BUSCA O VEICULO QUE ESTA CADASTRADO PELO ID.  
        $con = Connection::getStringConn();
        $sql = "SELECT * FROM veiculos WHERE idveiculo = '{$id}'";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        //TRANSFORMA RESULTADO EM OBJETO
        $resultado = $sql->fetchObject();
        
        //TRATAMENTO PARA RESULTADO VAZIO
        if (!$resultado) {throw new Exception("Não existe nenhum veiculo cadastrado !");}

        // RETORNO DO RESULTADO DA BUSCA OU EXCEPTION CASO SEJA VAZIO.
        return $resultado;
    }

    public static function atualizar($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['placa']) || empty($paramPost['marca']) || empty($paramPost['modelo']) || empty($paramPost['cor']) || empty($paramPost['ano'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //ATUALIZA CADASTRO DE UM VEICULO EXISTENTE PELO ID. 
        $con = Connection::getStringConn();
        $sql = "UPDATE veiculos SET placa = '{$paramPost['placa']}', marca = '{$paramPost['marca']}', modelo = '{$paramPost['modelo']}', cor = '{$paramPost['cor']}', ano = '{$paramPost['ano']}' WHERE idveiculo = '{$paramPost['id']}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI ATUALIZADO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir cliente.");} 
        return true;
    }
}

?>