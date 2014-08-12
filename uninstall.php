<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/08/14
 * Time: 11:00
 */
function uninstall(){
    if (!defined('WP_UNINSTALL_PLUGIN'))
        exit();
    delete_option('reveal-modal-string-random');
}
