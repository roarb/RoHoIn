<?php

include '../core/Core.php';
$core = new AllCore();
$tiers = new AllTieredLists();

$list = $tiers->getTieredListById($_GET['id']);

echo json_encode($list);
