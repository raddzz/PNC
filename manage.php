<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if ($_GET['type'] == 'person') {
  $pnctype = 'person';
  $name = strip_tags($_POST['name']);
$names = explode(" ", $name);
$fname = ucfirst($names[0]); // fname
$lname = ucfirst($names[1]); // lname
$dob = strip_tags($_POST['dob']);
$pnc_query = "SELECT * FROM pnc WHERE fname='$fname' AND lname ='$lname' AND dob = '$dob'"; 
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
$veh_query = "SELECT * FROM pnc WHERE plate='$plate' AND type='vehicle";
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
$veh_query = "SELECT * FROM pnc WHERE plate='$plate'"; 
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
  <title>PNC</title>
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
  <!-- datatables -->
  <link rel="stylesheet" href="plugins/datatables/jquery.dataTables.css">
  
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
      <span class="logo-mini"><b>PNC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">MPRPC<b>PNC</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Session user or however you want it</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  PC Test
                  <small>RTPC</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
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
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>PC Test</p>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li><a href="?"><i class="fa fa-id-card"></i> <span>PNC</span></a></li>
        <li class="active"><a href=""><i class="fa fa-keyboard-o"></i> <span>Civilian Management</span></a></li>
        <li><a href=""><i class="fa fa-mobile"></i> <span>MDT</span></a></li>
        <li><a href=""><i class="fa fa-map-pin"></i> <span>CAD</span></a></li>
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
        CIVM
        <small>Civilian Management</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Systems</a></li>
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
}
?>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="person">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">People</h3>
        </div>
        <table id="users" class="table table-striped">
      <thead>
        <tr>
          <th class="sorting_desc">First Name</th><th>Last Name</th><th>Date of Birth</th><th>View more!</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
        error_reporting(0);
          //set up mysql connection
mysql_connect($host,$username,$password);
mysql_select_db($db) or die(mysql_error());
          $result = mysql_query("SELECT * FROM pnc WHERE type = 'person'")
          or die(mysql_error());  

          while($row = mysql_fetch_array($result)){
          // Print out the contents of the entry 
          echo '<tr>';
          echo '<td>'.$row['fname'].'</td>';
          echo '<td>'.$row['lname'].'</td>';
          echo '<td>'.$row['dob'].'</td>';
                    echo '<td><a href="#" onclick="popupCenter(\'actions?type=person&id=' . $row['id'] . ' \', \'myPop1\',950,450)">View more!</a></td>';
                   }

        ?>
  
        
        </tr>
      </tbody></table>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="vehicle">
    <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Vehicles</h3>
        </div>
        <table id="veh" class="table table-striped">
      <thead>
        <tr>
          <th class="sorting_desc">Plate</th><th>Current Marker</th><th>View more!</th>
        </tr>
      </thead>
      
      <tbody>
        <?php
        error_reporting(0);
          //set up mysql connection
mysql_connect($host,$username,$password);
mysql_select_db($db) or die(mysql_error());
          $result = mysql_query("SELECT * FROM pnc WHERE type = 'vehicle'")
          or die(mysql_error());  

          while($row = mysql_fetch_array($result)){
          // Print out the contents of the entry 
          echo '<tr>';
          echo '<td>'.$row['plate'].'</td>';
          echo '<td>'.$row['markers'].'</td>';
                    echo '<td><a href="#" onclick="popupCenter(\'actions?type=vehicle&id=' . $row['id'] . ' \', \'myPop1\',950,450)">View more!</a></td>';
                   }

        ?>
  
        
        </tr>
      </tbody></table>
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
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
  $('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
<script type="text/javascript">
                    $(document).ready(function() {
                    $('#users').dataTable( {
                        "paging": true,
                        "info": false
                    } );
                    $('#veh').dataTable( {
                        "paging": true,
                        "info": false
                    } );
                } );
function popupCenter(url, title, w, h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
                </script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
