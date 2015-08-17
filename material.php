<?php include('login/index-start.php'); ?>
<html>
    <head>
        <title>Polymer Designs - Testing Grounds</title>
        <script src="/skin/jquery-2.1.3.min.js"></script>
        <script src="/skin/scripts.js"></script>
        <?php include 'admin/header.php'; ?>
    </head>
    <body class="default">

        <paper-drawer-panel>
            <paper-header-panel drawer>
                <paper-toolbar  class="primary">></paper-toolbar>
                <?php include 'login/index.php'; ?>
                <?php include 'nav/main-nav.php'; ?>
            </paper-header-panel>

            <paper-header-panel main>
                <paper-toolbar  class="primary">>
                    <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
                    <h1 class="full-page-title"><a href="http://roho.in">Reactive Online Hobby Organizational . Interface</a></h1>
                </paper-toolbar>
                <div class="container col2-set">
                    <div class="col-1">
                        <div class="cushion">
                            <paper-button raised class="link-google">raised button - go to google</paper-button>
                        </div>
                        <br />
                        <div class="cushion">
                            <paper-checkbox>label</paper-checkbox>
                        </div>
                        <br />
                        <div class="cushion">
                            <paper-material elevation="1" class="cushion">
                                ... content ...
                            </paper-material>
                        </div>
                        <div class="cushion">
                            <paper-textarea label="Testing Text Area" id="textbox-test"></paper-textarea>
                        </div>
                        <div class="cushion">
                            <form is="iron-form" id="testForm" method="post" action="/polymer/material-test-save.php">
                                <paper-input-container>
                                    <label>Your name</label>
                                    <input is="iron-input" name="name">
                                </paper-input-container>
                                <paper-checkbox onclick="toggleCheckbox('#checkbox1')">label</paper-checkbox><br /><br />
                                <paper-toggle-button onclick="toggleCheckbox('#toggle-switch1')"></paper-toggle-button><label>Toggle</label><br /><br />
                                <paper-button raised onclick="submitForm('#testForm')">Submit</paper-button>
                                    <input type="checkbox" name="checkbox1" id="checkbox1" value="0" />
                                    <input type="checkbox" name="toggle-switch1" id="toggle-switch1" value="0" />
                            </form>
                        </div>
                    </div>
                    <div class="col-2">
                        kachow spinner <br />
                        <paper-spinner active></paper-spinner><br /><br />
                        <paper-toast id="faction-error" text="testing text"></paper-toast>
                        <paper-button raised onclick="document.querySelector('#faction-error').show()">show toast</paper-button>
                    </div>
                </div>
            </paper-header-panel>
        </paper-drawer-panel>
        <paper-fab mini icon="visibility" class="edit-fab" onclick="alertThing();"></paper-fab>

    <script>
        function alertThing() {
            alert('yep, this was clicked');
        }
        $('.link-google').on('touchstart click', function(){ window.location = 'http://www.google.com'});
    </script>
  </body>
</html>