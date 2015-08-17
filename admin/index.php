<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RoHo.in Admin Dashboard</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
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
            <h1 class="full-page-title">RoHo.In Admin Dashboard</h1>
            <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                    <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
            </div>
        </paper-toolbar>
        <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
            <?php include('../admin/toolbar.php'); ?>
        </paper-toolbar>
        <div class="info-block cushion">
            <ul>
                <li><a href="/admin/builder/unit-view.php" title="View All Units">View All Units</a></li>
                <li><a href="/admin/builder.php" title="Builder Land">Builder Land</a></li>
                <li><a href="/admin/stats/index.php" title="Stat-o-Matic">Stat-o-Matic</a></li>
            </ul>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
<?php else: ?>
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
                <h1 class="full-page-title">Please login as Admin first</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <div class="info-block">
                <p class="cushion center">This area is off limits for all but the most awesome of people.</p>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php endif; ?>
</body>
</html>
