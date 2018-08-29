<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Areas de Conocimiento</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen"
          title="no title" charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.html">Gestion Centros de Investigacion (LRC)</a>
        </div>
        <!-- Top Menu Items -->

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="../menu.html"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                </li>
                <li>
                    <a href="../users/list.php"><i class="fa fa-fw fa-bar-chart-o"></i> Usuarios</a>
                </li>
                <li>
                    <a href="../region/list.php"><i class="fa fa-fw fa-table"></i> Regiones</a>
                </li>
                <li>
                    <a href="../ciudad/list.php"><i class="fa fa-fw fa-edit"></i> Ciudades</a>
                </li>
                <li>
                    <a href="../universidad/list.php"><i class="fa fa-fw fa-desktop"></i> Universidades</a>
                </li>
                <li>
                    <a href="../centroinvestigacion/list.php"><i class="fa fa-fw fa-wrench"></i> Centros de
                        Investigaciones</a>
                </li>
                <li>
                    <a href="../rol/list.php"><i class="fa fa-fw fa-wrench"></i> Roles</a>
                </li>
                <li>
                    <a href="../categoria/list.php"><i class="fa fa-fw fa-wrench"></i> Categorias</a>
                </li>
                <li>
                    <a href="../investigador/list.php"><i class="fa fa-fw fa-wrench"></i> Investigadores</a>
                </li>
                <li>
                    <a href="../areaconocimiento/list.php"><i class="fa fa-fw fa-wrench"></i> Areas de Conocimiento</a>
                </li>
                <li>
                    <a href="../tipoproyecto/list.php"><i class="fa fa-fw fa-wrench"></i> Tipos de Proyecto</a>
                </li>
                <li>
                    <a href="../categoriarevista/list.php"><i class="fa fa-fw fa-wrench"></i> Categorias de Revista</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i
                                class="fa fa-fw fa-arrows-v"></i> Consultas <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="query1.php">Consulta 1</a>
                        </li>
                        <li>
                            <a href="#">Dropdown Item</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                </li>
                <li>
                    <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        VISTA N°2
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Consultas</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Charts
                        </li>


                    </ol>

                    <?php
                    include("../db/conexion.php");
                    $sql = "select * from PROYECTOS_POSTULADOS";
                    $resultado = pg_query($sql) or die('La consulta fallo: ' . pg_last_error());
                    ?>


                    <div class="col-lg-2 pull-right" style="margin-bottom: 10px">

                    </div>

                    <table class="table table-striped" style="font-size:13.5px">
                        <h3 class="page-header">
                            PROYECTOS POSTULADOS TIPO EXTERNOS
                        </h3>
                        <tr>

                            <th>Rut Investigador</th>
                            <th>Postulaciones Proyectos Externos</th>


                        </tr>
                        <?php while ($line = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
                            echo "<tr>";

                            echo "<td>" . $line['rut_inv'] . "</td>";

                            echo "<td>" . $line['postulaciones_proyectos_externos'] . "</td>";

                            echo "</tr>";
                        }
                        ?>
                    </table>

                    <?php

                    $sql2 = "SELECT *FROM PROYECTOS_ADJUDICADOS";
                    $resultado2 = pg_query($sql2) or die('La consulta fallo: ' . pg_last_error());
                    ?>


                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Consulta a esa vista
                            </h1>
                            <div class="col-lg-2 pull-right" style="margin-bottom: 10px">

                            </div>

                            <table class="table table-striped" style="font-size:13.5px">
                                <h3 class="page-header">
                                    PROYECTOS ADJUDICADOS TIPO EXTERNOS
                                </h3>
                                <tr>

                                    <th>Rut Investigador</th>
                                    <th>Adjudicaciones Proyectos Externos</th>

                                </tr>
                                <?php while ($line = pg_fetch_array($resultado2, null, PGSQL_ASSOC)) {
                                    echo "<tr>";


                                    echo "<td>" . $line['rut_inv'] . "</td>";

                                    echo "<td>" . $line['proyectos_externos_adjudicados'] . "</td>";

                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>

                    <?php

                    $sql3 = "SELECT PP.ID_INV ,INV.NAME_INV ,
                                PP.POSTULACIONES_PROYECTOS_EXTERNOS,PA.PROYECTOS_EXTERNOS_ADJUDICADOS,
                                PA.PROYECTOS_EXTERNOS_ADJUDICADOS*100/PP.POSTULACIONES_PROYECTOS_EXTERNOS AS TASA_APROBACION
                                FROM PROYECTOS_POSTULADOS PP ,PROYECTOS_ADJUDICADOS PA ,INVESTIGADOR INV
                                WHERE INV.ID_INV=PP.ID_INV 
                                AND PA.ID_INV=INV.ID_INV 
                                AND PP.ID_INV=PA.ID_INV";
                    $resultado2 = pg_query($sql3) or die('La consulta fallo: ' . pg_last_error());
                    ?>


                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Consulta a esa vista
                            </h1>
                            <div class="col-lg-2 pull-right" style="margin-bottom: 10px">

                            </div>

                            <table class="table table-striped" style="font-size:13.5px">
                                <h3 class="page-header">
                                    TASA DE APROBACION DE PROYECTOS
                                </h3>
                                <tr>

                                    <th>NOMBRE INVESTIGADOR</th>
                                    <th>Adjudicaciones Proyectos Externos</th>
                                    <th>Postulaciones Proyectos Externos</th>
                                    <th>Tasa de Aprobacion</th>

                                </tr>
                                <?php while ($line = pg_fetch_array($resultado2, null, PGSQL_ASSOC)) {
                                    echo "<tr>";


                                    echo "<td>" . $line['name_inv'] . "</td>";

                                    echo "<td>" . $line['postulaciones_proyectos_externos'] . "</td>";

                                    echo "<td>" . $line['proyectos_externos_adjudicados'] . "</td>";

                                    echo "<td>" . $line['tasa_aprobacion'] . "</td>";


                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.row -->

            <!-- Flot Charts -->


            <!-- Morris Charts -->

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../js/plugins/morris/raphael.min.js"></script>
    <script src="../js/plugins/morris/morris.min.js"></script>
    <script src="../js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]>
    <script src="js/excanvas.min.js"></script><![endif]-->
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../js/plugins/flot/flot-data.js"></script>


</div>
</div>

</body>
</html>