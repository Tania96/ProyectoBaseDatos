<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de usuarios</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
       
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
                <a class="navbar-brand" href="index.html">Inicio</a>
            </div>
            <!-- Top Menu Items -->
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../menu.html"><i class="fa fa-fw fa-dashboard"></i> Menu</a>
                    </li>
                    <li class="active">
                        <a href="../users/list.php"><i class="fa fa-fw fa-bar-chart-o"></i> Usuario</a>
                    </li>
                    <li>
                        <a href="../region/list.php"><i class="fa fa-fw fa-table"></i> Regiones</a>
                    </li>
                    <li>
                        <a href="list.php"><i class="fa fa-fw fa-edit"></i> Ciudades</a>
                    </li>
                    <li>
                        <a href="../universidad/list.php"><i class="fa fa-fw fa-desktop"></i> Universidades</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
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
                            Regiones
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Lista de regiones</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Charts
                            </li>
                                   


                        </ol>
                        <?php
    require_once "../models/Ciudad.php";
    require_once "../models/Region.php";


    $id_ciu = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
 
    if( ! $id_ciu )
    {
        header("Location:" .  "list.php");
    }
    $db = new Database;
    $newCiudad = new Ciudad($db);
    $newCiudad->setID($id_ciu);
    $ciudad = $newCiudad->get();
    $newCiudad->checkUser($ciudad);
  
    ?>
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Edit Ciudad <?php echo $ciudad->name_ciu ?></h2>
            <form action="update.php" method="POST">
                      
                    <div class="form-group">
                    <label for="username">Nombre de Ciudad</label>
                    <input type="text" name="name_ciu" value="<?php echo $ciudad->name_ciu ?>" class="form-control" id="username" placeholder="NOMBRE CIUDAD">
                    </div>

                       <div class="form-group">
                        <label for="username">Region Pertenece</label>
                    
                        <select type="number" name="id_reg"  class="form-control" id="username" placeholder="Username">
                        <?php 
                           $db = new Database;
                           $region = new Region($db);
                           $regiones = $region->get();
                           foreach($regiones as $region){
                              $region->id_reg; 
                              $region->name_reg;

                              echo '<option value = "'.$region->id_reg.'">'.$region->name_reg.'</option>';
                            
                           }

                        ?>
                 </div>

                    
                   
                    <input type="hidden" name="id_ciu" value="<?php echo $ciudad->id_ciu ?>" />
                    <input type="submit" name="submit" class="btn btn-default" value="Update user" />
                    </form>
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
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../js/plugins/flot/flot-data.js"></script>

       
            </div>
        </div>
    </body>
</html>