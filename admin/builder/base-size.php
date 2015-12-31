<?php include('../../login/index-start.php'); ?>
<html lang="en">
<head>
    <?php include '../../core/Core.php';
    $core = new AllCore();
    include '../../admin/header.php';
    $allSizes = new AllBaseSizes;
    $baseSizesList = $allSizes->getAllBaseSizes();  ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Base Size Additions - RoHo.in Admin Panel</title>
</head>

<body class="default">
<?php if($core->getAdmin()): ?>
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
                <h1 class="full-page-title">Base Size Additions</h1>
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
                        <h3>Current Base Sizes:</h3>
                        <paper-item>
                            <paper-item-body class="list-items">
                                <div class="md-tile-content">
                                    <ul>
                                        <?php
                                         foreach ($baseSizesList as $size){
                                            echo '<li>'.$size['base_size'].'</li>';
                                        }
                                         ?>
                                    </ul>
                                </div>
                            </paper-item-body>
                        </paper-item>
                    </paper-material>
                </div>
                <div class="flex-2 info-block-tools cushion">
                    <paper-material elevation="1" class="cushion">
                        <h3>Add a Base Size:</h3>
                        <form action="base-size-save.php" id="base-size-form" method="post">
                            <paper-input-container>
                                <label>New Base Size</label>
                                <input id="new-base-size" name="new-base-size" is="iron-input">
                            </paper-input-container>
                            <paper-button class="full-width-button" onclick="submitForm('#base-size-form')">Submit</paper-button>
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
        $('.faction-select-toolbar .base-size').addClass('active');
    });
</script>
</body>
</html>
