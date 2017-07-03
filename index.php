<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Ouvidoria</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="resources/img/layout/favicon.ico"/>

    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="resources/font-awesome/font-awesome.min.css">

    <link rel="stylesheet" href="resources/ionicons/ionicons.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/datepicker/datepicker3.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/iCheck/all.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/select2/select2.min.css">

    <link rel="stylesheet" href="resources/adminLTE/css/AdminLTE.min.css">

    <link rel="stylesheet" href="resources/adminLTE/plugins/datatables/dataTables.bootstrap.css">

    <link rel="stylesheet" href="resources/adminLTE/css/skins/skin-blue-light.min.css">

    <link rel="stylesheet" href="resources/css/arquitetura.css">
</head>

<body class="hold-transition skin-blue-light">

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <?php include('inc/header.php'); ?>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div id="totOcorrenciaGrupoDataChart" class="col-md-6">

                </div>
                <div id="totOcorrenciaOrigemDataChart" class="col-md-6">
                </div>
            </div>
            <div class="row">
                <div id="totOcorrenciaAreaGrupoChart" class="col-md-8">
                </div>
            </div>
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer fundo-azul-caixa">
        <?php include('inc/footer.php'); ?>
    </footer>

</div>

<script src="resources/adminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="resources/bootstrap/js/bootstrap.min.js"></script>
<script src="resources/adminLTE/plugins/select2/select2.full.min.js"></script>
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="resources/adminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="resources/lib/moment.min.js"></script>
<script src="resources/adminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<script src="resources/adminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="resources/adminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="resources/adminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="resources/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="resources/adminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="resources/lib/Chart.min.js"></script>
<script src="resources/adminLTE/plugins/fastclick/fastclick.js"></script>
<script src="resources/adminLTE/js/app.min.js"></script>
<script src="resources/adminLTE/js/demo.js"></script>
<script src="resources/lib/jquery.fileDownload.js"></script>
<script src="view/controll.js"></script>


<script>
    loadDashboard('2016-01-01', '2016-12-31');

    $(function () {

        //Filtro periodo
        $('#pesquisa').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
            },
            startDate: '01/01/2016'
        }).on('apply.daterangepicker', function (ev, picker) {
            loadDashboard(picker.startDate, picker.endDate);
        });
    });

    function loadDashboard(startDate, endDate) {
        $('#totOcorrenciaGrupoDataChart').load('view/totOcorrenciaGrupoDataChart.php', function () {
            loadGrupoDataChart(startDate, endDate);
            loadSelect(startDate,endDate,'#selectGrupo','grupo');
        });

        $('#totOcorrenciaAreaGrupoChart').load('view/totOcorrenciaAreaGrupoChart.php', function () {
            loadAreaGrupoChart(startDate, endDate);
            loadSelect(startDate,endDate,'#selectSR','sr');
        });

    }

</script>


</body>

</html>