<?php 

// REQUISICAO DAS CLASSES UTILIZADAS (MVC)
require_once "app/core/Core.php";
require_once "app/controller/ErroController.php";
require_once "app/controller/HomeController.php";

require_once "app/model/Home.php";

require_once "lib/database/connection.php";

//CARREGA A PAGINA ESTRUTURA.HTML
$estrutura = file_get_contents('app/template/estrutura.html'); 

//INICIA A CLASSE CORE, METODO DEFAULT: START
ob_start(); 
  $core = new Core;
  $core->start($_GET);
  $saida = ob_get_contents();
ob_end_clean();

//CARREGA A ESTRUTURA DEFAULT COM CONTEUDO DINAMICO
$estruturaFinal = str_replace('{{conteudo}}', $saida, $estrutura);
echo $estruturaFinal;

?>