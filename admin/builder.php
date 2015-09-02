<?php include('../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../admin/header.php';  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RoHo.in Admin Builderland Dashboard</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
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
                <h1 class="full-page-title">RoHo.In Admin Builderland Dashboard</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="info-block cushion">
                <ul class="model-additions">
                    <li><a href="/admin/builder/unit-view.php" title="View all Models and Units">View All Models and Units</a></li>
                    <li><a href="/admin/builder/unit.php" title="Add a Model / Unit">Add a Model / Unit</a></li>
                </ul>
                <ul>
                    <li><a href="/admin/builder/animus.php" title="Add an Animus">Add an Animus</a></li>
                    <li><a href="/admin/builder/base-size.php" title="Add a Base Size">Add a Base Size</a></li>
                    <li><a href="/admin/builder/damage-type.php" title="Add Damage / Immunity Type">Add a Damage / Immunity Type</a></li>
                    <li><a href="/admin/builder/faction.php" title="Add Faction">Add a Faction</a></li>
                    <li><a href="/admin/builder/special-abilities.php" title="Add a Special Ability or Action">Add a Special Ability or Action</a></li>
                    <li><a href="/admin/builder/spells.php" title="Add a Spell">Add a Spell</a></li>
                    <li><a href="/admin/builder/tiered.php" title="Add a Tiered List">Add a Tiered List</a></li>
                    <li><a href="/admin/builder/unit-type.php" title="Add Unit Type">Add a Unit Type</a></li>
                    <li><a href="/admin/builder/weapon.php" title="Add Weapon">Add a Weapon</a></li>
                </ul>
                <p><a href="/admin/">Back to Admin</a></p>
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
