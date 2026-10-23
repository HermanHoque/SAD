<?php 
include("./controll/controlSessao.php");
include("./controll/controlAvaliar.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar</title>
    <link rel="shortcut icon" href="/img/SAD3.png" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>


<!-- menu principal -->
<nav class="navbar navbar-expand-lg shadow" style="background-color: #0D6EFD; padding-left: 15px; padding-right: 15px;">
        <div class="container">

          <a class="navbar-brand" href="#"><img src="./img/SAD.png" alt="" style="width: 70px; height: 50px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
              <li class="nav-item">
                <div  data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <a class="nav-link active" aria-current="page" href="#">Perfil</a>
                </div>
              </li>

              <!-- botão do modal -->
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="#">
                  Profs Avaliados
                </a>
              </li>

            </ul>
          </div>
        </div>
      </nav>


<!-- modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Professores Avaliados</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- corpo do modal -->
        <div class="container">

          <?php if ($sql_consulta3->num_rows == 0):?>
            <h3><strong>Sem Avaliação</strong></h3>   
          
          <?php else:?>
            <?php while ($profV = $sql_consulta3->fetch_assoc()):?>

              <div class="row p-3 mb-5 bg-body-tertiary rounded border border-primary-subtle">
                <div class="col">
                  <div><strong><?php echo ucwords($profV["prof"]);?></strong></div>
                  <hr>
                  <ul>
                    <li><?php echo ucwords($profV["disci"]);?></li>
                  </ul>
                </div>
              </div>

            <?php endwhile?>
          <?php endif?>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>




  <!-- Menu oculto -->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel" >

  <div class="offcanvas-header">
    <h3 class="offcanvas-title" id="offcanvasScrollingLabel">Info. Estudante</h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
    <!-- info do aluno -->
  <div class="offcanvas-body">
  <hr class="border border-primary">
    <div style="padding-left: 10px;">
        <p><strong>Nome: </strong> <?php echo ucwords($_SESSION["nome"])?></p>
        <p><strong>Género: </strong> <?php echo ucwords($_SESSION["genero"])?></p>
        <p><strong>Curso: </strong>  <?php echo ucwords($_SESSION["curso"])?></p>
        <p><strong>Ano: </strong>  <?php echo ucwords($_SESSION["ano"])?></p>
        <p><strong>Turma: </strong>  <?php echo ucwords($_SESSION["turma"])?></p>
        <p><strong>Turno: </strong>  <?php echo ucwords($_SESSION["turno"])?></p>
        <p><strong>Sala: </strong>  <?php echo ucwords($_SESSION["sala"])?></p>
    </div>
    
    <hr class="border border-primary">
    <p>
        <a href="./controll/controlLogout.php" class="btn btn-outline-primary">Sair</a>
    </p>
  </div>
</div>


<!-- conteudo -->


<div class="container" style="padding-top: 20px;">

    <h3 class="text-center">Formulário de Avaliação</h3>
    <br>

    <div class="border border-primary rounded-top shadow p-3 mb-5" style="background-color: #ffffff;">
        <form action="./controll/EnviarAvaliacao.php" method="post">
            <input type="hidden" name="id_aluno" value="<?php echo $_SESSION["matricula"]?>">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                    <div class="p-3">
                        <div style="margin-bottom: 15px;"></div>
                        <!-- selector do professor -->
                        <strong>Professor</strong>
                        <div style="margin-bottom: 10px;"></div>
                        <select class="form-select" aria-label="Default select example" name="prof" required>
                            <option selected disabled>Seleciona um Professor</option>
                                <?php if ($sql_consulta->num_rows == 0):?>
                                    <option value="">Sem Professor no momento</option>
                                <?php else:?>
                                    <?php while ($profs = $sql_consulta->fetch_assoc()):?>
                                    <option value=<?php echo ucwords($profs["id"])?>><?php echo ucwords($profs["nome"])?></option>
                                    <?php endwhile?>
                                <?php endif?>
                        </select> <br>

                        <!-- selector da disciplina -->
                        <strong>Disciplina</strong>
                        <div style="margin-bottom: 10px;"></div>
                        <select class="form-select" aria-label="Default select example" name="disci" required>
                            <option selected disabled>Seleciona uma Disciplina</option>
                            <?php if($sql_consulta2->num_rows == 0):?>
                                <option value="">Sem disciplinas no momento</option>
                            <?php else:?>
                                <?php while($disci = $sql_consulta2->fetch_assoc()):?>
                                    <option value=<?php echo ucwords($disci["id"])?>><?php echo ucwords($disci["nome"])?></option>
                                <?php endwhile?>
                            <?php endif?>
                        </select>


                    </div>
                    </div>

                    <div class="col">
                    <div class="p-3">

                    <!-- Tabela de avaliação -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">Nº</th>
                                <th scope="col">Pontos de Avaliação</th>
                                <th scope="col">Nota da Avaliação</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr>
                                <th scope="row">1</th>
                                <td>Pontualidade:</td>
                                <td>
                                    <input type="number" name="pontualidade" id="" min="0" max="10" required></td>
                                </tr>

                                <tr>
                                <th scope="row">2</th>
                                <td>Apresentação:</td>
                                <td>
                                    <input type="number" name="apresentacao" id="" min="0" max="10" required>
                                </td>
                                </tr>

                                <tr>
                                <th scope="row">3</th>
                                <td>Presença:</td>
                                <td>
                                    <input type="number" name="presenca" id="" min="0" max="10" required>
                                </td>
                                </tr>

                                <tr>
                                <th scope="row">4</th>
                                <td>Organização:</td>
                                <td>
                                    <input type="number" name="organizacao" id="" min="0" max="10" required>
                                </td>
                                </tr>

                                <tr>
                                <th scope="row">5</th>
                                <td>Dominio da cadeira:</td>
                                <td>
                                    <input type="number" name="dominio_cadeira" id="" min="0" max="10" required>
                                </td>
                                </tr>

                                <tr>
                                <th scope="row">6</th>
                                <td>Explicação da Matéria:</td>
                                <td>
                                    <input type="number" name="explicacao_materia" id="" min="0" max="10" required>
                                </td>
                                </tr>

                                <tr>
                                <th scope="row">7</th>
                                <td>Modo de Avaliação:</td>
                                <td>
                                    <input type="number" name="modo_avaliacao" id="" min="0" max="10" required>
                                </td>
                                </tr>

                            </tbody>
                            </table>


                    </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Enviar Avaliação</button>
            </div>
        </form>
    </div>

</div>
    
    
</body>
</html>