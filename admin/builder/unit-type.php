<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    include '../../core/UnitType.php';
    include '../../admin/header.php';  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Unit Type Additions - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($_SESSION['user_name'] ==  'roarb'): ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../nav/main-nav.php'; ?>
        </paper-header-panel>

        <paper-header-panel main>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                <h1 class="full-page-title">Add a New Unit Type</h1>
                <div class="roho-logo"><a href="http://roho.in" title="Reactive Online Hobby Organizational . Interface">
                        <img src="/skin/images/roho-logo.png" alt="Reactive Online Hobby Organizational . Interface" /></a>
                </div>
            </paper-toolbar>
            <paper-toolbar class="front-toolbar faction-select-toolbar secondary">
                <?php include('../../admin/toolbar.php'); ?>
            </paper-toolbar>
            <div class="horizontal layout">
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Current Unit Types:</h3>
                        <paper-item>
                            <paper-item-body class="list-items">
                                <ul>
                                    <?php

                                    $allUnitTypes = new AllUnitTypes;
                                    $unitTypesList = $allUnitTypes->getAllUnitTypes();

                                    foreach ($unitTypesList as $unitType){
                                        echo '<li>'.$unitType['name'].'</li>';
                                    }

                                    ?>
                                </ul>
                            </paper-item-body>
                        </paper-item>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Unit Type:</h3>
                        <form action="unit-type-save.php" id="unit-type-form" method="post">
                            <paper-input-container>
                                <label>New Unit Type</label>
                                <input id="new-unit-type" name="new-unit-type" is="iron-input">
                            </paper-input-container>
                            <paper-button class="full-width-button" onclick="submitForm('#unit-type-form')">Submit</paper-button>
                        </form>
                    </paper-material>
                </div>
            </div>
        </paper-header-panel>
    </paper-drawer-panel>
<?php else: ?>
    <paper-drawer-panel>
        <paper-header-panel drawer>
            <paper-toolbar class="primary">
                <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            </paper-toolbar>
            <?php include '../../login/index.php'; ?>
            <?php include '../../nav/main-nav.php'; ?>
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
<script>
    $(document).ready(function(){
        $('.faction-select-toolbar .unit-type').addClass('active');
    });
</script>
</body>
</html>
