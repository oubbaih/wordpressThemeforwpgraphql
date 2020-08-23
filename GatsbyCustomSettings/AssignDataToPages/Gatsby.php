<?php settings_errors(); ?>
<form method="post" action="options.php" enctype="multipart/form-data">
    <?php settings_fields( 'generalinfo');?>
    <?php do_settings_sections( 'gatsby' );?>
    <?php submit_button(); ?>
</form>
