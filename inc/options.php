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
            'id' => 'reveal-modal-options',
            'title' => __( 'Options', 'reveal-modal' ),
        ),
    )
);
$_types = get_post_types('','names');
$_types = implode(',',$_types);
$_options->set_fields(
    array(
        'reveal-modal-style_section' => array(
            'tab'   => 'reveal-modal-options',
            'title' => '',
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
                    'description' => __( 'Change color of close icon (DEFAULT: #B1AFAF)', 'reveal-modal' ),
                ),
                array(
                    'id' => 'reveal-modal-types',
                    'label' => __( 'Valid post types', 'reveal-modal' ),
                    'type' => 'text',
                    'default' => $_types,
                    //'description' => __( 'Option visible in post types', 'reveal-modal' ),
                ),
	            array(
		            'id'          => 'reveal-modal-inload',
		            'label'       => __( 'Open pages with reveal modal in load', 'reveal-modal' ),
		            'type'        => 'checkbox',
		            'default'     => '',
		           // 'description' => __( 'Descrition Example', 'odin' ), // Opcional
	            )
            )
        ),
    )
);
