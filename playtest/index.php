<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php'; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Warmachine &amp; Hordes Playtesting &amp; Research Center</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../nav/main-nav.php'; ?>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title">Warmachine &amp; Hordes Playtesting &amp; Research Center</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <h2 class="cushion">Welcome to RoHo - experience the experiments</h2>
        <div class="horizontal layout">
            <div class="flex-2 cushion">
                <paper-button raised class="full-width-button link-playtest-all-abilities">View all Special Abilities and Actions</paper-button>
                <paper-button raised class="full-width-button link-playtest-all-spells">View all Spells</paper-button>
                <paper-button raised class="full-width-button link-playtest-all-weapons">View all Weapons</paper-button>
            </div>
            <div class="flex-2 cushion">
                <paper-button raised class="full-width-button link-playtest-all-units">View all Units</paper-button>
                <paper-button raised class="full-width-button link-playtest-single-unit">View Single Unit</paper-button>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>