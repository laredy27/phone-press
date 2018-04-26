<?php

/** 
 * Admin menu page Template
 * 
 * @package Phone Press
 * @author Bayonle Ladipo
 */

?>
<div class="wrap">
    <h1><?php _e(get_admin_page_title()) ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields("phone_press_opt_group");
        do_settings_sections( "phonepress" );
        submit_button( __("Save Settings", "phone-press") );
        ?>
    </form>
</div>

