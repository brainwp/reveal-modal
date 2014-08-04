<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/07/14
 * Time: 20:57
 */
require_once plugin_dir_path( __FILE__ ) . '/odin-options.php' ;
$_options = new Odin_Plugin_Options(
    'reveal-cfg', // Slug
    'Reveal Modal', // Page title
    'manage_options' // Permission
);
$_options->set_tabs(
    array(
        array(
            'id' => 'reveal_general', // ID da aba e nome da entrada no banco de dados.
            'title' => __( 'Configuration', 'reveal-modal' ), // Título da aba.
        ),
        array(
            'id' => 'reveal_visual',
            'title' => __( 'Appearance', 'reveal-modal' )
        )
    )
);
$_options->set_fields(
    array(
        'reveal_general_section' => array(
            'tab'   => 'reveal_general', // Sessão da aba odin_general
            'title' => __( 'Section Example', 'reveal-modal' ),
            'fields' => array(
                array(
                    'id' => 'field1',
                    'label' => __( 'Field 1', 'odin' ),
                    'type' => 'text',
                    'default' => 'Hello world',
                    'description' => __( 'Descrition Example', 'odin' )
                ),
                array(
                    'id' => 'field2',
                    'label' => __( 'Field 2', 'odin' ),
                    'type' => 'text'
                )
            )
        ),
        'reveal_visual_section' => array(
            'tab'   => 'reveal_visual', // Sessão da aba odin_adsense
            'title' => __( 'Blocos Adsense Homepage', 'odin' ),
            'fields' => array(
                array(
                    'id' => 'banner1',
                    'label' => __( 'Banner 1', 'odin' ),
                    'type' => 'textarea',
                    'default' => 'Default text',
                    'description' => __( 'Descrition Example', 'odin' )
                ),
                array(
                    'id' => 'banner2',
                    'label' => __( 'Banner 2', 'odin' ),
                    'type' => 'textarea'
                )
            )
        ),
    )
);