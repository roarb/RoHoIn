<html lang="en">
<head>
    <?php
    include '../../core/Core.php';
    $core = new AllCore();
    $allUnits = new AllUnits();
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create a Warmachine or Hordes Army with RoHo.In</title>
</head>
<body>

        <?php $write = $allUnits->writeModelsToJsonFile(); ?>
        <?php //var_dump($write); ?>
        running

</body>
</html>