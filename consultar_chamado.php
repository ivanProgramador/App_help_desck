<?php require_once "validador_acesso.php"; ?>


<?php

   //esse array vai guardar os chamados
   $chamados = array();




   // abrir o arquivo.hd

   $arquivo = fopen('../../app_help_desk/arquivo.hd','r'); // usando a funçao fopen() com o comando 'r' somente leitura

   /* enquanto houver registros (linhas) a serem lidas o while continua
      usando a função feof() que percorre as linhas ate achar o PHP_EOL
      achando ele a funçao entende que a linha acabou e passa o ponteiro pra proxima
      ate fazer uma busca e nao achar nada, porem ela so retorna true e inicia o laço se ela retonar true entao usaei o simbolo ! pra inverter todos os false que ela retornar para ela continuar executando enquanto houver linhas
      quando nao tiver mais ela retorna true quaninvertido e false e o laço para
   */
   while (!feof($arquivo)){

      // a funçao abaxo escaneia o arquivo e pega tudo qoue tiver dentro dele 

      $registro = fgets($arquivo);
      $chamados[] = $registro; // cada registo que for aparecendo assume uma posiçao do array
      
    } 

    /*fechando o arquivo que estava aberto*/

    fclose($arquivo);





?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
       <ul class="navbar-nav">
        <li class="nav-item">
           <a class="nav-link"  href="logof.php">SAIR</a>
          
        </li>
        

      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>

           <div class="card-body">

             <?php foreach ($chamados as $chamado){ ?>



              <?php $chamado_dados = explode('#',$chamado);

                    // testando o id do usuario pra saber se a consulta partiu do administrador

                    if ($_SESSION['perfil_id'] == 2){

                      // so seram exibidos os chamados abertos pelo usuario logado

                      if ($_SESSION['id'] != $chamado_dados[0]) {
                        continue;
                      }
                         
                    }


                    if (count($chamado_dados)<3) {
                      continue;
                      
                    }

              ?>
              
              <div class="card mb-3 bg-light">
              <div class="card-body">
              <h5 class="card-title"><?= $chamado_dados[1] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted"><?= $chamado_dados[2] ?></h6>
              <p class="card-text"><?= $chamado_dados[3] ?></p>
            </div>

            </div>
            <?php } ?>
          
              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="home.php">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>