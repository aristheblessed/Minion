<html>
<?php
include ("config/database.php");
$query="SELECT * FROM servicetype WHERE serviceCat_id='".$_POST["serviceCat_id"]."'";

$result=$db->query($query);
?>
<?php
while($rs=$result->fetch()){
    ?>
<option value="<?php echo $rs["serviceType_id"]; ?>"> <?php echo $rs["serviceType_name"]; ?></option>
<?php
}
?>
</html>
