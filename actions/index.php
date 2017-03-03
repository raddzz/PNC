<?php
include '../config.php';
if ($_GET['type'] == 'person'){
$pnctype = 'person';
$id = strip_tags($_GET['id']);
$pnc_query = "SELECT * FROM pnc WHERE id='$id'"; 
$pncquery = mysql_query($pnc_query);
$pncrow = mysql_fetch_array($pncquery);
}
if ($_GET['type'] == 'vehicle'){
$pnctype = 'vehicle';
$id = strip_tags($_GET['id']);
$pnc_query = "SELECT * FROM pnc WHERE id='$id'"; 
$pncquery = mysql_query($pnc_query);
$pncrow = mysql_fetch_array($pncquery);
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
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- select boxes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

  
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue layout-top-nav">
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


    <!-- Main content -->
    <div class="content-wrapper">
    
<?php if ($_GET['type'] == 'person') {
?>  
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $pncrow[fname];?> <?php echo $pncrow[lname];?>  
        <small><?php echo $pncrow[dob];?></small>
      </h1>

  </section>

    <!-- Main content -->
    <section class="content">
<form method="post" action="../actions/form.php?action=submit&type=person&id=<?php echo $pncrow[id];?>">
 <div class="form-group">
                  <label for="dob">Date of Birth</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="dob" data-provide="datepicker" id="dob" value="<?php echo $pncrow[dob]?>" placeholder="Enter Date of Birth!">
                </div>
                </div>
<div class="form-group">
                  <label for="marker">Marker</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="marker" id="marker" placeholder="Markers" value="<?php echo $pncrow[markers]?>";">
                </div>
                </div>
<div class="form-group">
                  <label for="plate">Plate</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="plate" id="plate" placeholder="Plate" value="<?php echo $pncrow[plate]?>";">
                </div>
                </div>
                <div class="form-group">
  <label for="extra">Additional Details</label>
  <textarea class="form-control" rows="5" name="extra" id="extra"><?php echo $pncrow[additional]?></textarea>
</div>                   <div class="form-group">
  <label for="address">Address</label>
  <textarea class="form-control" rows="2" name="address" id="address"><?php echo $pncrow[address]?></textarea>
</div>                   <div class="form-group">
  <label for="previous">Previous</label>
  <textarea class="form-control" rows="2" name="previous" id="previous"><?php echo $pncrow[previous]?></textarea>
</div>                   
                <input type="submit" class="btn btn-primary" value="Submit">              
                </form>
<?php 
}
elseif ($_GET['type'] == 'vehicle') {
?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $pncrow[plate];?> <?php echo $pncrow[lname];?>  
        <small><?php echo $pncrow[dob];?></small>
      </h1>

  </section>

    <!-- Main content -->
    <section class="content">
<form method="post" action="../actions/form.php?action=submit&type=vehicle&id=<?php echo $pncrow[id];?>";">
<div class="form-group">
                  <label for="marker">Marker</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <input type="text" class="form-control" name="marker" id="marker" placeholder="Markers" value="<?php echo $pncrow[markers]?>";">
                </div>
                </div>
<div class="form-group">
                  <label for="mot">MOT</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <select class="selectpicker form-control" name="mot" id="mot"">
  <option><?php echo $pncrow[mot]?></option>
  <option>MOT Held</option>
  <option>MOT Not Held</option>
</select>
                </div>
                </div>
<div class="form-group">
                  <label for="insurance">Insurance</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-car"></i>
                  </div>
                  <input type="text" class="form-control" name="insurance" id="insurance" placeholder="Markers" value="<?php echo $pncrow[insurance]?>";">
                </div>
                </div>
                <div class="form-group">
  <label for="extra">Additional Details</label>
  <textarea class="form-control" rows="5" name="extra" id="extra"><?php echo $pncrow[additional]?></textarea>
</div>                       
                <input type="submit" class="btn btn-primary" value="Submit">              
                </form>
<?php };?>
<br>
<button onclick="cadclose(this)" value="<?php echo $pncrow['id'] ;?>" class="btn btn-danger">Delete</button>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- /.content -->
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
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    startView: 3
});
</script>
<script type="text/javascript">
  function cadclose(objButton) {
   var r = confirm("Do you want to delete this? ");
  if (r == true) {
      window.location = "../actions/form.php?type=delete&id=" + objButton.value;
      
  } else {
      alert("Thanks for wasting my time ;)"); 
  }   
}
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
