<?php
require_once("baseDatos.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formularios</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <!-- INICIA NAVBAR -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">APLICACIÓN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Películas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Punto de venta</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- TERMINA NAVBAR -->


  <!-- INICIA CONTENEDOR -->
  <div class="container">

    <h1>.::USUARIOS</h1>
    <hr>

    <div class="row">
      <!-- INICIA FORMULARIO DE CAPTURA -->
      <div class="col-md-6 col-sm-12">

        <form action="controlador.php" method="post" id="formulario">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Correo electrónico</label>
              <input type="email" class="form-control" name="correo" id="correo" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label for="inputAddress">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escribe tu(s) nombre(s)">
          </div>
          <div class="form-group">
            <label for="inputAddress2">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" placeholder="Escribe tu(s) apellidos(s)">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">Ciudad</label>
              <input type="text" class="form-control" name="ciudad">
            </div>
            <div class="form-group col-md-6">
              <label for="inputState">Estado</label>
              <select name="estado" class="form-control">
                <option selected>-- Elige un estado --</option>
                <option value="1">Michoacán</option>
                <option value="2">CDMX</option>
                <option value="3">Querétaro</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip">Código postal</label>
              <input type="text" class="form-control" name="cp">
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="noticias">
              <label class="form-check-label" for="gridCheck">
                Deseo recibir novedades del sitio web
              </label>
            </div>
          </div>

          <input type="hidden" name="accion" value="verificar">
          <button type="submit" name="accion" value="registrar" class="btn btn-primary">Registrarse</button>
        </form>
      </div>
      <!-- FINALIZA FORMULARIO DE CAPTURA -->

      <!-- INICIA TABLA -->

      <?php
      $usuarios = obtenerTodos("usuario", $BD);
      ?>

      <div class="col-md-6 col-sm-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Correo</th>
              <th scope="col"></th>
            </tr>
            <?php

            foreach ($usuarios as $key => $usuario) {
            ?>

              <tr>
                <td scope="col"><?= $key + 1 ?></td>
                <td scope="col"><?= $usuario["nombre"] ?></td>
                <td scope="col"><?= $usuario["apellidos"] ?></td>
                <td scope="col"><?= $usuario["correo"] ?></td>
                <td scope="col">
                <form action="controlador.php" method="post">
                  <a class="btn btn-dark" href="detalles.php?id=<?= $usuario["id"] ?>">Modificar</a>
                  <input type="hidden" class="form-control" name="id" value="<?= $usuario["id"] ?>">
                  <button type="submit" name="accion" value="eliminar" class="btn btn-dark">Eliminar</button>
                </form>
                </td>
              </tr>
            <?php
            }
            ?>

          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
      <!-- FINALIZA TABLA -->
    </div>



  </div>
  <!-- FINALIZA CONTENEDOR-->

  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  
  <script type="text/javascript">

  
    $(document).ready(function() {
      $('#correo').focusout(function () {                
        $.ajax({
          url: 'controlador.php',
          type: "POST",          
          data: $("#formulario").serialize(),
          success: function(response) {                 
            var respuesta = JSON.parse(response);   
            if (respuesta.success == 1) {
              alert("Ese correo ya se encuentra registrado");
              $('#correo').val("");
              $('#correo').focus();
              $('#correo').css('background-color','#FDD');
            }else{
              $('#correo').css('background-color','#DFD');
            }
          }
        });
      });
    });

  </script>

</body>

</html>