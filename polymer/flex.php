<html>
<head>
    <script src="/bower_components/webcomponentsjs/webcomponents.js"></script>
    <script src="/bower_components/webcomponentsjs/CustomElements.js"></script>
    <script src="/bower_components/webcomponentsjs/HTMLImports.js"></script>
    <script src="/bower_components/webcomponentsjs/MutationObserver.js"></script>
    <!--script src="/bower_components/webcomponentsjs/ShadowDOM.js"></script-->
    <link rel="stylesheet" type="text/css" href="/skin/styles.css">
    <link rel="import" href="/bower_components/polymer/polymer.html"/>
    <link rel="import" href="/bower_components/iron-flex-layout/iron-flex-layout.html"/>
    <link rel="import" href="/bower_components/iron-icons/iron-icons.html"/>
    <link rel="import" href="/bower_components/iron-icons/editor-icons.html"/>
    <link rel="import" href="/bower_components/paper-button/paper-button.html"/>
    <link rel="import" href="/bower_components/paper-checkbox/paper-checkbox.html"/>
    <link rel="import" href="/bower_components/paper-drawer-panel/paper-drawer-panel.html"/>
    <link rel="import" href="/bower_components/paper-fab/paper-fab.html"/>
    <link rel="import" href="/bower_components/paper-icon-button/paper-icon-button.html"/>
    <link rel="import" href="/bower_components/paper-input/all-imports.html"/>
    <link rel="import" href="/bower_components/paper-item/paper-item.html"/>
    <link rel="import" href="/bower_components/paper-material/paper-material.html"/>
    <link rel="import" href="/bower_components/paper-menu/paper-menu.html"/>
    <link rel="import" href="/bower_components/paper-toolbar/paper-toolbar.html"/>
    <style>

    </style>
</head>
<body>

<paper-drawer-panel>
    <paper-header-panel drawer>
        <paper-toolbar></paper-toolbar>
        <paper-menu>
            <paper-item>Item 1</paper-item>
            <paper-item>Item 2</paper-item>
        </paper-menu>
    </paper-header-panel>

    <paper-header-panel main>
        <paper-toolbar>
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <h1><a href="http://roho.in">RoHo.in</a></h1>
        </paper-toolbar>
        <div class="horizontal layout cushion">
            <div class="flex-2 cushion">
                <paper-material elevation="3" class="cushion">testing left column</paper-material>
            </div>
            <div class="flex-2 cushion">
                <paper-material elevation="3">testing right column</paper-material>
            </div>
        </div>
    </paper-header-panel>
</paper-drawer-panel>
</body>
</html>
