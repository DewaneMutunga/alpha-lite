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
	 * Site Title & Tagline
	 */
	// Section settings
	$wp_customize->get_section( 'title_tagline' )->priority = 10;
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Title (Logo) & Tagline', 'alpha_lite' );
	
	// Site Title
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogname' )->priority = 10;
	
	// logo uploader setting
	$wp_customize->add_setting( 'alpha_lite_logo', array( 'default' => null ) );
	// logo uploader control
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alpha_lite_logo', array(
		'label'		=> __( 'Custom Site Logo', 'alpha_lite' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'alpha_lite_logo',
		'priority'	=> 20,
	) ) );
	
	// Site Tagline
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_control( 'blogdescription' )->priority = 30;	
	
	
	
	/** ===============
	 * Content Options
	 */
	$wp_customize->add_section( 'alpha_lite_content_section', array(
		'title'			=> __( 'Content Options', 'alpha_lite' ),
		'description'	=> __( 'Adjust the display of content on your website. All options have a default value that can be left as-is but you are free to customize.', 'alpha_lite' ),
		'priority'		=> 20
	) );
	
	// Footer Credits & Copyright
	$wp_customize->add_setting( 'alpha_lite_credits_copyright', array( 
		'default'	=> null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_credits_copyright', array(
		'label'		=> __( 'Footer Credits & Copyright', 'alpha_lite' ),
		'section'	=> 'alpha_lite_content_section',
		'priority'	=> 10,
	) );
	
		
	
	/** ===============
	 * Social Networking Profiles
	 */
	$wp_customize->add_section( 'alpha_lite_social_section', array(
		'title'			=> __( 'Social Networking Profiles', 'alpha_lite' ),
		'description'	=> __( 'Add your social profiles to be displayed in the theme. All options have a default value that can be left as-is but you are free to customize.', 'alpha_lite' ),
		'priority'		=> 35
	) );
	
	// Twitter
	$wp_customize->add_setting( 'alpha_lite_twitter', array( 
		'default'	=> null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_twitter', array(
		'label'		=> __( 'Twitter Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_social_section',
		'priority'	=> 10,
	) );
	
	// Facebook
	$wp_customize->add_setting( 'alpha_lite_facebook', array( 
		'default'	=> null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_facebook', array(
		'label'		=> __( 'Facebook Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_social_section',
		'priority'	=> 20,
	) );
	
	// GPlus
	$wp_customize->add_setting( 'alpha_lite_gplus', array( 
		'default'	=> null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_gplus', array(
		'label'		=> __( 'Google Plus Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_social_section',
		'priority'	=> 30,
	) );
	
	// LinkedIn
	$wp_customize->add_setting( 'alpha_lite_linkedin', array( 
		'default'	=> null,
		'sanitize_callback' => 'alpha_lite_sanitize_link_text' 
	) );
	$wp_customize->add_control( 'alpha_lite_linkedin', array(
		'label'		=> __( 'LinkedIn Profile URL', 'alpha_lite' ),
		'section'	=> 'alpha_lite_social_section',
		'priority'	=> 40,
	) );	
}
add_action( 'customize_register', 'alpha_lite_customize_register' );


/** ===============
 * Sanitize text input to allow anchors
 */
function alpha_lite_sanitize_link_text( $input ) {
    return strip_tags( stripslashes( $input ), '<a>' );
}

/** ===============
 * Sanitize text input
 */
function alpha_lite_sanitize_text( $input ) {
    return strip_tags( stripslashes( $input ) );
}

/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function alpha_lite_customizer_styles() { ?>
	<style type="text/css">
		body { background: #fff; }
		#customize-controls #customize-theme-controls .description { display: block; color: #999; margin: 2px 0 15px; font-style: italic; }
		textarea, input, select, .customize-description { font-size: 12px !important; }
		.customize-control-title { font-size: 13px !important; margin: 10px 0 3px !important; }
		.customize-control label { font-size: 12px !important; }
		#customize-control-shoppette_read_more { margin-bottom: 30px; }
		#customize-control-shoppette_store_front_count input { width: 50px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'alpha_lite_customizer_styles');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function alpha_lite_customize_preview_js() {
	wp_enqueue_script( 'alpha_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'alpha_lite_customize_preview_js' );
