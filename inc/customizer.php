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
	 * Content Options
	 */
	$wp_customize->add_section( 'alpha_lite_content_section', array(
    	'title'       	=> __( 'Content Options', 'alpha_lite' ),
		'description' 	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'alpha_lite' ),
		'priority'   	=> 20,
	) );
	
	// show single post footer?
	$wp_customize->add_setting( 'alpha_lite_post_footer', array( 
		'default' => 1,
		'sanitize_callback' => 'alpha_lite_sanitize_checkbox'  
	) );
	$wp_customize->add_control( 'alpha_lite_post_footer', array(
		'label'		=> __( 'Show Post Footer on Single Posts?', 'alpha' ),
		'section'	=> 'alpha_lite_content_section',
		'priority'	=> 50,
		'type'      => 'checkbox',
	) );
	// twitter url
	$wp_customize->add_setting( 'alpha_lite_twitter', array( 
		'default' => null,
		'sanitize_callback' => 'alpha_lite_sanitize_text'
	) );
	$wp_customize->add_control( 'alpha_lite_twitter', array(
		'label'		=> __( 'Twitter Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'settings'	=> 'alpha_lite_twitter',
		'priority'	=> 80,
	) );
	// facebook url
	$wp_customize->add_setting( 'alpha_lite_facebook', array( 
		'default' => null,
		'sanitize_callback' => 'alpha_lite_sanitize_text'
	) );
	$wp_customize->add_control( 'alpha_lite_facebook', array(
		'label'		=> __( 'Facebook Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'settings'	=> 'alpha_lite_facebook',
		'priority'	=> 90,
	) );
	// google plus url
	$wp_customize->add_setting( 'alpha_lite_gplus', array( 
		'default' => null,
		'sanitize_callback' => 'alpha_lite_sanitize_text'
	) );
	$wp_customize->add_control( 'alpha_lite_gplus', array(
		'label'		=> __( 'Google Plus Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'settings'	=> 'alpha_lite_gplus',
		'priority'	=> 100,
	) );
	// linkedin url
	$wp_customize->add_setting( 'alpha_lite_linkedin', array( 
		'default' => null,
		'sanitize_callback' => 'alpha_lite_sanitize_text'
	) );
	$wp_customize->add_control( 'alpha_lite_linkedin', array(
		'label'		=> __( 'LinkedIn Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'settings'	=> 'alpha_lite_linkedin',
		'priority'	=> 110,
	) );
	// credits & copyright
	$wp_customize->get_setting( 'alpha_lite_credits_copyright' )->transport = 'postMessage';
	$wp_customize->add_setting( 'alpha_lite_credits_copyright', array( 
		'default' => null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'settings'	=> 'alpha_lite_credits_copyright',
		'priority'	=> 120,
	) );
	
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
	wp_enqueue_script( 'alpha_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'alpha_lite_customize_preview_js' );
