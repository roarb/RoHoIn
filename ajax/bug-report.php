<?php
/**
 * Created by PhpStorm.
 * User: RMP2
 * Date: 6/14/2015
 * Time: 9:06 AM
 */
 ?>

<paper-material elevation="5" class="bug-report-wrapper">
    <h3>File a Bug Report</h3>
    <form id="submit-bug-report-form" method="post" action="/ajax/bug-report-submission.php" style="padding:10px; text-align:left;">
        <paper-input-container>
            <textarea rows="2" id="description" name="description" placeholder="Description of Problem"></textarea>
        </paper-input-container>
        <paper-input-container>
            <label>Page Affected:</label>
            <input name="url" is="iron-input" value="<?php echo $_GET['url'] ?>" readonly />
        </paper-input-container>
        <paper-input-container>
            <label>Your Email:</label>
            <input name="user-email" is="iron-input" />
        </paper-input-container>
    </form>
    <paper-button raised id="submit-bug-report">Submit</paper-button> <paper-button raised id="close-bug-report">Close</paper-button>
</paper-material>

<script>
    $('#close-bug-report').on('touchstart click', function() {
        $('#bug-report-form').hide();
    });
    $('#submit-bug-report').on('touchstart click', function() {
        submitBugForm();
    });
</script>