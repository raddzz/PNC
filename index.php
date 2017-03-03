<?php
include 'config.php';
if ($_GET['task'] == 'civ' AND $_GET['supersecret'] == 'letmein') {
  include 'manage.php';
}
else{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if ($_GET['type'] == 'person') {
  $pnctype = 'person';
  $name = strip_tags($_POST['name']);
$names = explode(" ", $name);
$fname = ucfirst($names[0]); // fname
$lname = ucfirst($names[1]); // lname
$dob = strip_tags($_POST['dob']);
$pnc_query = "SELECT * FROM pnc WHERE fname='$fname' AND lname ='$lname'"; 
$pncquery = mysql_query($pnc_query);
$pncrow = mysql_fetch_array($pncquery);
$markers=array("Drugs","Firearms","Missed Court","Missing","Dangerous");
$randmark = $markers[array_rand($markers)];
if ($pncrow == "") {
mysql_query("INSERT INTO `pnc` (`fname` , `lname` , `markers` , `dob` , `ip`, `type`) VALUES ('$fname' , '$lname' , '$randmark' , '$dob' , '$_SERVER[HTTP_X_FORWARDED_FOR]', 'person')") or die(mysql_error());
}
$pnc_query = "SELECT * FROM pnc WHERE fname='$fname' AND lname ='$lname'"; 
  $pncquery = mysql_query($pnc_query);
  $pncrow = mysql_fetch_array($pncquery);
}
elseif ($_GET['type'] == 'vehicle') {
$pnctype = 'vehicle';
$plate = strip_tags($_POST['plate']);
$veh_query = "SELECT * FROM pnc WHERE plate='$plate' AND type='vehicle'";
$vehquery = mysql_query($veh_query);
$vehrow = mysql_fetch_array($vehquery);
$markers=array("Drugs","Weapons","Stolen","Used in crime","Owner wanted");
$randmark = $markers[array_rand($markers)];
$ins=array("Insurance Held","Insurance not Held");
$randins = $ins[array_rand($ins)];
$mot=array("MOT Held","MOT not Held");
$randmot = $mot[array_rand($mot)];
if ($vehrow == "") {
mysql_query("INSERT INTO `pnc` (`plate` , `insurance` , `markers` ,`mot` , `ip`, `type`) VALUES ('$plate' , '$randins' , '$randmark' , '$randmot' , '$_SERVER[HTTP_X_FORWARDED_FOR]', 'vehicle')") or die(mysql_error());
}
$veh_query = "SELECT * FROM pnc WHERE plate='$plate' AND type='vehicle'"; 
$vehquery = mysql_query($veh_query);
$vehrow = mysql_fetch_array($vehquery);
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MPRPC | PNC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PNC     </b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">MPRPC<b>PNC</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="active"><a href="#"><i class="fa fa-id-card"></i> <span>PNC</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PNC
        <small>Police National Computer Lookup</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Systems</a></li>
        <li class="active">PNC</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
          <a class="btn btn-app" href="#person" aria-controls="home" role="tab" data-toggle="tab">
                <i class="fa fa-users"></i> Person
              </a>
          <a class="btn btn-app">
                <i class="fa fa-car" href="#vehicle" aria-controls="home" role="tab" data-toggle="tab"></i> Vehicle
              </a>
      </div>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if ($_GET['type'] == 'person') {
  echo '<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Person PNC Result - ',$pncrow[fname],' ',$pncrow[lname],' - Born ', $pncrow[dob],'</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            ';
          echo 
          '<div class="col-md-1 name">
                <b>Marker:</b>
                </div>
                <div class="col-md-3 value">
                ',$pncrow[markers],'</div>
                <br>
                <div class="col-md-1 name">
                <b>Notes:</b>
                </div>
                <div class="col-md-3 value">
                ',$pncrow[additional],'</div>
                <br>
                <div class="col-md-1 name">
                <b>Address:</b>
                </div>
                <div class="col-md-3 value">
                ',$pncrow[address],'</div>
                <br>
                <div class="col-md-1 name">
                <b>Previous:</b>
                </div>
                <div class="col-md-3 value">
                ',$pncrow[previous],'</div>
                <br>
                ';
  
          
          ?>
            <!-- /.box-body -->
        
            <!-- /.box-body -->
            </div>
          </div>
          <?php
}
elseif ($_GET['type'] == 'vehicle') {
  echo '<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Vehicle PNC Result - ',$vehrow[plate],'</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
            ';
            if (isset($vehrow[markers]) != '1') {
              echo 'No markers';
            }
            else {
            echo '<div class="col-md-1 name">
                <b>Marker:</b>
                </div>
                <div class="col-md-3 value">
                ',$vehrow[markers],'</div>
                <br>
                <div class="col-md-1 name">
                <b>Insurance:</b>
                </div>
                <div class="col-md-3 value">
                ',$vehrow[insurance],'</div>
                <br>
                <div class="col-md-1 name">
                <b>MOT:</b>
                </div>
                <div class="col-md-3 value">
                ',$vehrow[mot],'</div>
                <br>
                <div class="col-md-1 name">
                <b>Notes:</b>
                </div>
                <div class="col-md-3 value">
                ',$vehrow[additional],'</div>
                <br>';                
  $p_query = "SELECT * FROM pnc WHERE plate='$vehrow[plate]' AND type ='person'"; 
  $pquery = mysql_query($p_query);
  $prow = mysql_fetch_array($pquery);
  if ($prow != "") {
    echo '
    <div class="col-md-1 name">
                <b>Owner:</b>
                </div>
                <div class="col-md-3 value">
                ',$prow[fname],' ',$prow[lname],' - Born ',$prow[dob],'</div>
                <br>';
  }
          }
          ?>
            <!-- /.box-body -->
            </div>
          </div>
          <?php
}
}
?>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="person">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Person PNC</h3>
        </div>
        <form action="?type=person" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-male"></i>
                  </div>
                  <input type="text" class="form-control" name="name" id="name" required placeholder="Enter name here!">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="dob" data-provide="datepicker" id="dob" required placeholder="Enter Date of Birth!">
                </div>

                </div>
              </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

              <CENTER> <h3>This system is being monitered. Please <STRONG>NOTE</STRONG> Everything you do is logged. </h3></CENTER> <br />
              </form>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="vehicle">
    <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Vehicle PNC</h3>
        </div>
        <form action="?type=vehicle" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Vehicle Registration</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <input type="text" class="form-control" name="plate" id="plate" required placeholder="Enter Plate here!">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Submit">

                <CENTER> <h3>This system is being monitered. Please <STRONG>NOTE</STRONG> Everything you do is logged. </h3></CENTER> <br />
              </div>
              </form>
      </div>
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      MPRPC Systems
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="https://radley.xyz">James Radley</a> for MetPoliceRPC.</strong> All rights reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script type="text/javascript">
  $('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    startView: 3
});
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
<?php }