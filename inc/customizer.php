<?php
/**
 * Alpha Lite Theme Customizer
 *
 * @package alpha_lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function alpha_lite_customize_register( $wp_customize ) {

	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class alpha_lite_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
		<?php }
	}
	
	/** ===============
	* Add NEW customizer SECTIONS
	*/
	$add_sections = array(
		'content'			=> array(
			'id'			=> 'alpha_lite_content_section',
			'title'			=> __( 'Content Options', 'alpha_lite' ),
			'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'alpha_lite' ),
			'priority'		=> 30
		),
		'social'			=> array(
			'id'			=> 'alpha_lite_social_section',
			'title'			=> __( 'Social Networking Profiles', 'alpha_lite' ),
			'description'	=> __( 'Add your social profiles to be displayed in the theme. All options have a default value that can be left as-is but you are free to customize.', 'alpha_lite' ),
			'priority'		=> 35
		),
	);
	// Build the sections based on the $add_sections array
	foreach ( $add_sections as $section ) {
		$wp_customize->add_section( $section[ 'id' ], array(
			'title'			=> $section[ 'title' ],
			'description'	=> $section[ 'description' ],
			'priority'		=> $section[ 'priority' ],
		) );
	}

	/** ===============
	* Add NEW customizer SETTINGS
	*/
	$add_settings = array(
		'site copyright'	=> array(
			'id'			=> 'alpha_lite_credits_copyright',
			'default'		=> null
		),
		'twitter'			=> array(
			'id'			=> 'alpha_lite_twitter',
			'default'		=> null
		),
		'facebook'			=> array(
			'id'			=> 'alpha_lite_facebook',
			'default'		=> null
		),
		'gplus'				=> array(
			'id'			=> 'alpha_lite_gplus',
			'default'		=> null
		),
		'linkedin'			=> array(
			'id'			=> 'alpha_lite_linkedin',
			'default'		=> null
		),
	);
	// Build the settings based on the $add_settings
	foreach ( $add_settings as $setting ) {
		$wp_customize->add_setting( $setting[ 'id' ], array( 
			'default'	=> $setting[ 'default' ] 
		) );
	}

	/** ===============
	* Add NEW customizer CONTROLS ** by control type **
	*/        

	// Text input control types
	$add_text_controls = array(
		'alpha_lite_twitter'		=> array(
			'id'					=> 'alpha_lite_twitter',
			'label'					=> __( 'Twitter Profile URL', 'alpha_lite' ),
			'section'				=> 'alpha_lite_social_section',
			'priority'				=> 10,
		),
		'alpha_lite_facebook'		=> array(
			'id'					=> 'alpha_lite_facebook',
			'label'					=> __( 'Facebook Profile URL', 'alpha_lite' ),
			'section'				=> 'alpha_lite_social_section',
			'priority'				=> 20,
		),
		'alpha_lite_gplus'			=> array(
			'id'					=> 'alpha_lite_gplus',
			'label'					=> __( 'Google Plus Profile URL', 'alpha_lite' ),
			'section'				=> 'alpha_lite_social_section',
			'priority'				=> 30,
		),
		'alpha_lite_linkedin'		=> array(
			'id'					=> 'alpha_lite_linkedin',
			'label'					=> __( 'LinkedIn Profile URL', 'alpha_lite' ),
			'section'				=> 'alpha_lite_social_section',
			'settings'				=> 'alpha_lite_social_profiles',
			'priority'				=> 40,
		),
		'alpha_lite_credits_copyright'		=> array(
			'id'					=> 'alpha_lite_credits_copyright',
			'label'					=> __( 'Footer Credits & Copyright', 'alpha_lite' ),
			'section'				=> 'alpha_lite_content_section',
			'settings'				=> 'alpha_lite_credits_copyright',
			'priority'				=> 10,
		),
	);
	// Build the text input controls based on the $add_text_controls
	foreach ( $add_text_controls as $control ) {
		$wp_customize->add_control( $control[ 'id' ], array(
			'label'		=> $control[ 'label' ],
			'section'	=> $control[ 'section' ],
			'priority'	=> $control[ 'priority' ]
		) );
	}

	/** ===============
	* Add to, take away from, and edit EXISTING WordPress sections
	*/

	// logo uploader setting
	$wp_customize->add_setting( 'alpha_lite_logo', array( 'default' => null ) );

	// logo uploader control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alpha_lite_logo', array(
		'label'		=> __( 'Custom Site Logo', 'alpha_lite' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'alpha_lite_logo',
	) ) );
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'alpha_lite_customize_register' );

/** ===============
 * Sanitize checkbox options
 */
function alpha_lite_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return 0;
    }
}


/** ===============
 * Sanitize radio options
 */
function alpha_lite_sanitize_radio( $input ) {
    $valid = array(
		'excerpt'		=> 'Excerpt',
		'full_content'	=> 'Full Content'
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


/** ===============
 * Sanitize text input
 */
function alpha_lite_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alpha_lite_customize_preview_js() {
	wp_enqueue_script( 'alpha_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'alpha_lite_customize_preview_js' );
