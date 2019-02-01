<?php

$deploylink = NETLIFY_DEPLOY_WEBHOOK;

add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'site-deploy',
        'title' => 'Deploy',
        'href'  => '/wp-admin/admin.php?page=deploy',
        'meta'  => array(
            'title' => __('Deploy'),            
        ),
    ));
    
}






// ========== CREATE DEPLOY ADMIN PAGE ==========

/* Deploy Settings Page */
class deploy_Settings_Page {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
	}
	public function wph_create_settings() {
		$page_title = 'Deploy';
		$menu_title = 'Deploy';
		$capability = 'manage_options';
		$slug = 'deploy';
		$callback = array($this, 'wph_settings_content');
		$icon = 'dashicons-megaphone';
		$position = 80;
		add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
	}
	public function wph_settings_content() { 
		$output = '';
		$output .= '<div class="wrap">
			<h1>DEPLOY</h1>
			<hr>
			<h3>Before deploying the website, make sure you have completed all site adjustments.</h3>
			<p style="font-size:1.15em;">During deployment, the source files from the Git repository will be downloaded and the static site will be built and then served through the CDN.</p>
			<p style="font-size:1.15em; color:#dc3545;"><strong>This process can take up to a few minutes depending on the size of the build files.</strong></p>
			<hr>
			<form method="POST" action="'.NETLIFY_DEPLOY_WEBHOOK.'" target="ignore">
				<button class="button button-primary button-large" onclick="var e=this;setTimeout(function(){e.disabled=true;},0);return true;">
					Deploy Site
				</button>
			</form>
			<span id="formMessage" style="display:none;">The website is being built.</span>
			<iframe name="ignore" src="" style="display:none;"></iframe>
			<script type="text/javascript">
				jQuery(document).ready(function( $ ) {
					$(function() {
					    $(".button").click(function(){  
					        $("#formMessage").toggle("slow"); 
					    });
					});
				});
			</script>

		</div>';
		print $output;
	}
	public function wph_setup_sections() {
		add_settings_section( 'deploy_section', 'Before deploying the website, make sure you have completed all site adjustments.', array(), 'deploy' );
	}
	public function wph_setup_fields() {
		$fields = array(
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'deploy', $field['section'], $field );
			register_setting( 'deploy', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		switch ( $field['type'] ) {
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$field['placeholder'],
					$value
				);
		}
		if( $desc = $field['desc'] ) {
			printf( '<p class="description">%s </p>', $desc );
		}
	}
}
new deploy_Settings_Page();











?>