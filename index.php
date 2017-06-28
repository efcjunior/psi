<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Define o titulo da aplicacao buscando as propriedades no arquivo project.seed-->
    <title>Ouvidoria</title>
    <!-- Informa o browser para ser responsive ao tamanho da tela  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no">
    <!-- Define o icone da aplicacao -->
    <link rel="shortcut icon" type="image/x-icon" href="resources/img/layout/favicon.ico"/>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tema AdminLTE -->
    <link rel="stylesheet" href="resources/adminLTE/css/AdminLTE.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/iCheck/all.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- AdminLTE Datatables -->
    <link rel="stylesheet" href="resources/adminLTE/plugins/datatables/dataTables.bootstrap.css">
    <!-- AdminLTE Select2 -->
    <link rel="stylesheet" href="resources/adminLTE/plugins/select2/select2.min.css">

    <!-- Skin blue light -->
    <link rel="stylesheet" href="resources/adminLTE/css/skins/skin-blue-light.min.css">
    <!-- CSS arquitetura -->
    <link rel="stylesheet" href="resources/css/arquitetura.css">
</head>

<body class="hold-transition skin-blue-light">

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <?php include('inc/header.php'); ?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div id="principal" class="content-wrapper">
        <?php

        $db = open_database();

        if ($db) {
            echo '<h1>Banco de Dados Conectado!</h1>';
        } else {
            echo '<h1>ERRO: Não foi possível Conectar!</h1>';
        }
        ?>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer fundo-azul-caixa">
        <?php include('inc/footer.php'); ?>
    </footer>

</div>

<!-- jQuery 2.2.3 -->
<script src="resources/adminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="resources/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="resources/adminLTE/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="resources/adminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="resources/adminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="resources/adminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="resources/adminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="resources/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="resources/adminLTE/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="resources/adminLTE/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="resources/adminLTE/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="resources/adminLTE/js/demo.js"></script>

<!-- Page script -->
<script>
    $(function () {
        //Filtro periodo
        $('#pesquisa').daterangepicker();

        $('#pesquisa').on('apply.daterangepicker', function(ev, picker) {

            $.ajax({
                method: "GET",
                url: "model/servicos.php",
                data: {dataIn:'1'},
                success: function(data) {
                    alert(data);
                    window.open("model/servicos.php");
                }
            });
        });

        $('#datepicker').datepicker({
            autoclose: true
        });
    });
</script>


</body>

</html>