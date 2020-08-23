<?php settings_errors(); ?>
<form method="post" action="options.php" enctype="multipart/form-data">
    <?php settings_fields( 'generalinfoMedia');?>
    <?php do_settings_sections( 'social-media' );?>
    <?php submit_button(); ?>
</form>
