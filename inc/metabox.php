<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04/08/14
 * Time: 18:33
 */
require_once plugin_dir_path( __FILE__ ) . '/odin-metabox.php' ;
$_types = get_option( 'reveal-modal-options' );
$_types = $_types['reveal-modal-types'];
$_types = explode(',',$_types);
$_meta = new Reveal_Modal_Metabox(
    'reveal-modal-meta', // Metabox slug
    'Reveal Modal', // Metabox name
    $_types // post type
);
$_meta->set_fields(
    array(
        /**
         * set meta field to active plugin in post
         */
        // Radio field.
        array(
            'id'          => 'is_reveal_modal', // Required
            'label'       => __( 'Active Reveal Modal in this post?', 'reveal-modal' ), // Required
            'type'        => 'radio', // Required
            // 'attributes' => array(), // Optional (html input elements)
            'default'    => 'false', // Optional
            //'description' => __( 'Radio field description', 'odin' ), // Optional
            'options' => array( // Required (id => title)
                'true'   => __( 'True', 'reveal-modal' ),
                'false'   => __( 'False', 'reveal-modal' ),
            ),
        ),
    )
);