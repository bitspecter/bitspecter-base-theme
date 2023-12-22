<?php

add_action('wp_head', function () {
    echo '<meta name="ajaxurl" content="' . admin_url('admin-ajax.php') . '">';
});