<?php 

class Locacao{

    public static function index() {
        //BUSCA TODOS OS VEICULOS QUE ESTAO DISPONIVEIS PARA LOCACAO.  
        $con = Connection::getStringConn();
        $sql = "SELECT * FROM veiculos WHERE cpflocador IS NULL ORDER BY modelo";
        $sql = $con->prepare($sql);
        $sql->execute();
        
        //TRANSFORMA RESULTADO EM OBJETO
        $resultado = array();
        while ($row = $sql->fetchObject()) {
            $resultado[] = $row;
        }
        
        //TRATAMENTO PARA RESULTADO VAZIO
        //if (!$resultado) {throw new Exception("Não existe nenhum veiculo disponivel no momento !");}

        // RETORNO DO RESULTADO DA BUSCA OU EXCEPTION CASO SEJA VAZIO.
        return $resultado;      
    }

    public static function locar($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['cpf']) || empty($paramPost['placa'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //INSERE LOCACAO DE UM CLIENTE X VEICULO NOVO. 
        $con = Connection::getStringConn();
        $sql = "UPDATE veiculos SET cpflocador = '{$paramPost['cpf']}' WHERE placa = '{$paramPost['placa']}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI LOCADO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir veiculo.");} 
        return true;
    }

    public static function devolver($paramPost) {
        //VALIDA SE OS DADOS SAO INVALIDOS 
        if(empty($paramPost['cpf']) || empty($paramPost['placa'])){
            throw new Exception("Erro, dados invalidos.");
            return false;
        }

        //INSERE LOCACAO DE UM CLIENTE X VEICULO NOVO. 
        $con = Connection::getStringConn();
        $sql = "UPDATE veiculos SET cpflocador = NULL WHERE placa = '{$paramPost['placa']}' AND cpflocador = '{$paramPost['cpf']}'";
        $sql = $con->prepare($sql);
        $resultado = $sql->execute();
        
        //CONFIRMA SE FOI LOCADO CORRETAMENTE.
        if($resultado == 0) {throw new Exception("Erro, falha ao inserir veiculo.");} 
        return true;
    }
}
?>