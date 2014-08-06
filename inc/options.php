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
            'id' => 'reveal-modal-style',
            'title' => __( 'Style/Visual', 'reveal-modal' ),
        ),
    )
);
$_options->set_fields(
    array(
        'reveal-modal-style_section' => array(
            'tab'   => 'reveal-modal-style',
            'title' => __( 'Change style options', 'reveal-modal' ),
            'fields' => array(
				array(
					'id'          => 'reveal-modal-color',
					'label'       => __( 'Modal Color', 'reveal-modal' ),
					'type'        => 'input',
					'default'     => '#FFFFFF',
					'attributes'  => array( // Optional (html input elements)
						'type' => 'color',
						'style' => 'width:32%;height:32px;'
					),
					'description' => __( 'Change color of the modal (DEFAULT: #FFFFFF)', 'reveal-modal' ),
				),
                array(
                    'id' => 'reveal-modal-bg-opacity',
                    'label' => __( 'Background Opacity', 'reveal-modal' ),
                    'type' => 'text',
					'default' => '0.80',
				),
                array(
                    'id'          => 'reveal-modal-closeicon-color',
                    'label'       => __( 'Close icon color', 'reveal-modal' ),
                    'type'        => 'input',
                    'default'     => '#B1AFAF',
                    'attributes'  => array( // Optional (html input elements)
                        'type' => 'color',
                        'style' => 'width:32%;height:32px;'
                    ),
                    'description' => __( 'Change color of the modal (DEFAULT: #B1AFAF)', 'reveal-modal' ),
                ),
            )
        ),
    )
);