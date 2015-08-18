<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php'; ?>
    <?php include '../core/Core.php'; ?>
    <?php include '../core/ArmyBuilder.php'; ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Army List Dashboard - RoHo.In</title>
</head>

<body class="default">

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
        </paper-toolbar>
        <?php include '../login/index.php'; ?>
        <?php include '../nav/main-nav.php'; ?>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar class="primary">
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1 class="full-page-title">Army List Dashboard</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <div class="horizontal layout info-block">
            <div class="flex-2">
                <paper-button raised class="full-button" onclick="location.href='/armybuilder/create.php'">
                    Create a New Army List
                </paper-button>
            </div>
            <div class="flex-2">
                <?php if ($_SESSION['user_id'] != ''): ?>
                    <paper-button raised class="full-button" onclick="location.href='/armybuilder/view-owned.php'">
                        View My Army Lists
                    </paper-button>
                <?php endif; ?>
                <paper-button raised class="full-button" onclick="location.href='/armybuilder/view-public.php'">
                    View Public Army Lists
                </paper-button>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>