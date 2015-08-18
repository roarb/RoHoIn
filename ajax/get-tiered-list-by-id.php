<?php

include '../core/Core.php';
include '../core/tiered-list.php';

$tiers = new AllTieredLists();

$list = $tiers->getTieredListById($_GET['id']);

echo json_encode($list);
