<?php
include '../config.php';
if ($_GET['type'] == 'person') {
$dob = strip_tags($_POST['dob']);
$id = strip_tags($_GET['id']);
$extra = strip_tags($_POST['extra']);
$markers = strip_tags($_POST['marker']);
$plate = strip_tags($_POST['plate']);
$previous = strip_tags($_POST['previous']);
$address = strip_tags($_POST['address']);
echo $plate;
echo $markers;
mysql_query("UPDATE `pnc` SET dob = '$dob', markers = '$markers', plate = '$plate', additional = '$extra', address = '$address', previous = '$previous' WHERE id = '$id'") or die(mysql_error());
}
elseif ($_GET['type'] == 'vehicle') {
$extra = strip_tags($_POST['extra']);
$id = strip_tags($_GET['id']);
$markers = strip_tags($_POST['marker']);
$plate = strip_tags($_POST['plate']);
echo $plate;
echo $markers;
mysql_query("UPDATE `pnc` SET additional = '$extra', markers = '$markers', plate = '$plate' WHERE id = '$id'") or die(mysql_error());
}
elseif ($_GET['type'] == 'delete') {
$id = $_GET['id'];
mysql_query("DELETE FROM `pnc` WHERE id='$id'");
echo "jobdone";
}?>
<script type="text/javascript">
setTimeout(function(){window.close(self)}, 1000);
</script>