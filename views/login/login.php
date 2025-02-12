<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto-POLI- 2022</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_PATH; ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo URL_PATH; ?>assets/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_PATH; ?>assets/dist/css/adminlte.min.css">


  <!-- jQuery -->
  <script src="<?php echo URL_PATH; ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo URL_PATH; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo URL_PATH; ?>assets/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL_PATH; ?>assets/dist/js/adminlte.min.js"></script>


</head>


<body class="hold-transition login-page">

  <?php

  $Datamessage = (!empty($_SESSION['Datamessage'])) ? $_SESSION['Datamessage'] : null;


  if ($Datamessage != null || $Datamessage) {

    $statusmsg = $Datamessage['message']['error'];
    $typemsg = $Datamessage['message']['type'];
    $titlemsg = $Datamessage['message']['title'];
    $textmsg = $Datamessage['message']['msg'];

    unset($_SESSION['Datamessage']);

    echo "
      <script>
          toastr." . $typemsg . "(
            '" . $textmsg . "', '" . $titlemsg . "', {
              showDuration: 400,
              'progressBar': true,
              'closeButton': true,
              'iconClass': 'toast-" . $typemsg . "'
            })
      </script>
    ";
  }

  ?>

  <div class="login-box">
    <div class="login-logo">
      <a href="" style="color:#196945"><b style="color: #29AB70">Proyecto</b>-POLI</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Iniciar sesion</p>

        <form action="login/validalogin" id="login_form" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email_input" id="email_input" class="form-control" placeholder="a@b.com" autocomplete="off" value="" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope" style="color: #29AB70"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="pass_input" name="pass_input" class="form-control" placeholder="Contraseña" autocomplete="off" value="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock" style="color: #29AB70"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="button" id="login_user" name="login_user" class="btn btn btn-block" style="background-color: #196945; color:white" onclick="validar_form_login();">Entrar</button>
            </div>
          </div>
        </form>
        <p class="mb-1" style="margin-top: 20px">
          <a href="login/forgotpass" style="color: #29AB70">Recordar clave</a>
        </p>

      </div>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function() {

    });

    function validar_form_login() {
      var email_input = $("#email_input").val();
      var pass_input = $("#pass_input").val();

      if (email_input == "" || pass_input == "") {

        toastr.error(
          'Los datos son obligatorios.', 'Error !', {
            showDuration: 400,
            "progressBar": true,
            "closeButton": true,
            "iconClass": 'toast-error'
          })

      } else {

        if (email_input.indexOf('@', 0) == -1 || email_input.indexOf('.', 0) == -1) {
          toastr.error(
            'El correo electrónico <br> debe contener la estructura: <b>usuario@dominio.com</b>', 'Error !', {
              showDuration: 400,
              "progressBar": true,
              "closeButton": true,
              "iconClass": 'toast-error'
            })
        } else {

          $("#login_form").submit();

        }

      }
    }

    function registro_usuario(){

      nombre=$("#nombre_registro_usuario").val();
      nombre_corto=$("#nombrecorto_registro_usuario").val();
      email=$("#email_registro_usuario").val();
      clave=$("#clave_registro_usuario").val();
      

      if(nombre=="" || nombre_corto=="" || email=="" || clave==""){
          
          toastr.warning(
            'Los campos son obligatorios ,<br>por favor complete.',	'Atencion !',
            {
              showDuration: 400,
              "progressBar": true,
              "closeButton": true,
              "iconClass": 'toast-warning'
            }
          )

      }else{
        
        if(clave.length < 8){
          toastr.warning(
            'La clave debe ser mayor de 8 caracteres ,<br>por favor valide.',	'Atencion !',
            {
              showDuration: 400,
              "progressBar": true,
              "closeButton": true,
              "iconClass": 'toast-warning'
            }
          )
        }else{
          var from="registro_usuario"
          var data={from,nombre,nombre_corto,email,clave};
          $.ajax({
              type: "POST",
              url: "http://proyectopoli.generandocodigo.com/ajaxcontroller/usuarios.php",
              data: data,
              // dataType: "JSON",
              success: function (response) {
                
                if(response==1){
                
                  toastr.success(
                    mensaje,	'Hecho !',
                    {showDuration: 300,
                    "progressBar": true,
                    "closeButton": true,
                    "iconClass": 'toast-success'})
                    
                }else{
                    toastr.warning(
                    'Ese correo ya se encuentra registrado. <br> Por favor intente con otro.',	'Atencion !',
                    {showDuration: 400,
                    "progressBar": true,
                    "closeButton": true,
                    "iconClass": 'toast-warning'})
                }
              }
              
          });
        
        }

      }
        

      // toastr.error(
      //       'Ocurrio un error.<br>Por favor contactar a soporte',	'Error !',
      //       {showDuration: 400,
      //       "progressBar": true,
      //       "closeButton": true,
      //       "iconClass": 'toast-error'})
          
      
    }
  </script>
</body>

</html>