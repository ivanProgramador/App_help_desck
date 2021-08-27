<?php

  session_start();// INICIANDO ACESSAO PRA PEGAR O ID
   
  // este script vai criar e manipular um arquivo de texto onde ele vai escrever e persistir o conteudos dos chamados

  // neste caso um chamado e dividido em 3 partes titulo, categoria e descrição cada parte sera separada pelo simbolo # porem caso o cliente coloque o simbolo # no campo descritivo e necessario capturar e alterar para que isso nao comprometa a integidade do texto.


  // montando texto
  // usando a função str_replace() que recebe 3 parametros 
  /*    1 - o simbolo que ela deve encontrar
        2 - o simbolo que ela deve usar pra substituir
        3 - em qual string ela deve fazer a busca
  */
  // tratando todos os textos

  

  $titulo = str_replace('#','-', $_POST['titulo']);
  $categoria = str_replace('#','-', $_POST['categoria']);
  $descricao = str_replace('#','-', $_POST['descricao']);

  // montando um texto concatenando as strings ja tratadas e usando a PHP_EOL pra fazer a quebra de linha
  // pra saber onde começa e termona o texto de um chamado

  $texto = $_SESSION['id'].'#'.$titulo.'#'.$categoria.'#'.$descricao.PHP_EOL;

  // usando a função fopen() para manipular o aquivo de texto
  // no primeiro parametro ele recebe o nome do arquivo que sera gerado
  // e no segundo ele recebe o modo que o arquivo vai ser usado comando 'a'
  // significa que ele vai abrir so pra escrever no arquivo

  $arquivo = fopen('../../app_help_desk/arquivo.hd','a');

  // escrevendo no arquivo
  fwrite($arquivo,$texto);
  //fechando o arquivo
  fclose($arquivo);

  header('Location: abrir_chamado.php');













?>