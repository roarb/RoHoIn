<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $unit = $_GET['unit'] ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $unit ?> Detailed View</title>
<?php 

	include '../../core/Core.php';
	include '../../core/Unit.php';
	
	$unitBuilder = new AllUnits();
	$unitObj = $unitBuilder->getUnitByName($unit);

?>
<link rel="stylesheet" type="text/css" href="/skin/styles.css">
<script src="/skin/jquery-2.1.3.min.js"></script>
<script src="/skin/scripts.js"></script>
</head>

<body>
<h1><?php echo $unit ?></h1>

<?php var_dump($unitObj); ?>

</body>
</html>