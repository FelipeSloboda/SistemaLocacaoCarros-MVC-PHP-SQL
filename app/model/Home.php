<?php 

class Home{
    public static function selectDisponiveis() {
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
}

?>