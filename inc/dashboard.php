<?php

function menu_item_classes($item_id, $item) {
    $menu_item_classes = esc_attr(get_post_meta($item_id, '_menu_item_classes', true));
    ?>
    <div style="clear: both;">
    <span class="description"><?= __("CSS Classes", 'bitspecter'); ?></span><br />
    <input type="hidden" class="nav-menu-id" value="<?= $item_id; ?>" />
        <input type="text" name="menu_item_classes[<?= $item_id; ?>]" id="menu-item-classes-<?= $item_id; ?>" value="<?= esc_attr($menu_item_classes); ?>" style="width: 100%;" />
</div>
<?php }

add_action('wp_nav_menu_item_custom_fields', 'menu_item_classes', 10, 2);

function save_menu_item_classes($menu_id, $menu_item_db_id) {
if (isset($_POST['menu_item_classes'][$menu_item_db_id]) && current_user_can('edit_theme_options')) {
    $sanitized_data = sanitize_text_field($_POST['menu_item_classes'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_classes', $sanitized_data);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_classes');
    }
}

add_action('wp_update_nav_menu_item', 'save_menu_item_classes', 10, 2);

