<?php 
include("../controll/controlLoginAdmin.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/media_screen.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="../img/SAD3.png" type="image/x-icon">

    <title>Login-Admin</title>
</head>

<body style="background: linear-gradient(to right, #F6F8FB, #0D6EFD);">




<!-- conteudo -->

<div id="conteudo">

    <!-- área do login -->
    <div class="container px-4 shadow p-3 mb-5 rounded border border-primary" style="background-color: #F6F8FB;">
        <div class="row">

        
        <img src="../img/SAD3.png" alt="" style="width: 90px; height: 50px;">
        <strong>Sistema de Avalição de Docentes</strong>

            <!-- local do formulário -->
            <div class="col">
                <div class="" style="padding-top: 10px;">
                    <form action="" method="post">

                        <div style="padding-bottom: 1px;"></div>
                        <!-- input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Senha</span>
                            <input type="password" name="senha" id="inputPassword5" class="form-control border border-primary" aria-describedby="passwordHelpBlock" required>

                            <!-- botão de entrar -->
                            <div class="d-flex justify-content-end" style="margin-left: 20px; margin-right: 20px;">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                        <div style="padding-bottom: 1px;"></div>
                        
                        <!-- texto ou informação abaixo -->
                        <div id="passwordHelpBlock" class="form-text">
                            <hr>
                                <strong>Digite a Senha do Administrador</strong><br>
                                <strong></strong>
                            <hr>
                        </div>
                        
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>