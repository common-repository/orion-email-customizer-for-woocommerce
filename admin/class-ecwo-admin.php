<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://orionorigin.com
 * @since      1.0.0
 *
 * @package    ecwo
 * @subpackage ecwo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ecwo
 * @subpackage ecwo/admin
 * @author     orion <help@orionorigin.com>
 */
class Ecwo_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ecwo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ecwo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ecwo-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'admin-configurator-email', plugin_dir_url( __FILE__ ) . 'css/ecwo-admin-configurator-email.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'ecwo-color-spectrum', plugin_dir_url( __FILE__ ) . 'css/ecwo-spectrum.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'unicons.iconscout', plugin_dir_url( __FILE__ ) . 'css/unicons.iconscout.min.css', array(), false, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ecwo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ecwo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//		if ( get_current_screen()->base == 'ecwo_page_ecwo-template' ) {

                    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ecwo-admin.js', array( 'jquery' ), $this->version, false );

                    wp_enqueue_script( 'admin-configurator-email', plugin_dir_url( __FILE__ ) . 'js/ecwo-admin-configurator-email.js', array( 'jquery' ), $this->version, false );

                    wp_enqueue_script( 'ecwo-color-spectrum-cdn', plugin_dir_url( __FILE__ ) . '/js/ecwo.spectrum.min.js', array(), $this->version, false );

                    wp_enqueue_script( 'ecwo-color-spectrum', plugin_dir_url( __FILE__ ) . 'js/ecwo-color-spectrum.js', array( 'jquery' ), $this->version, false );

//		}

                wp_enqueue_script( 'manage-fonts-js', plugin_dir_url( __FILE__ ) . 'js/ecwo-admin-manage-fonts-js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( 'wp-js-hooks', plugin_dir_url( __FILE__ ) . '/js/wp-js-hooks.min.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	/**
	 * Add ECWO menu
	 */
        public function add_ecwo_menu() {

            if (class_exists('WooCommerce')) {
                $parent_slug = 'ecwo-manage-dashboard';
                $capability = 'manage_product_terms';

                // Main menu.
                add_menu_page(__('Email Customiser for Woocommerce By orion', 'ecwo'), 'ECWO', $capability, $parent_slug, array($this, 'get_ecwo_template_page'), '', 11);

                // Submenu.
                add_submenu_page($parent_slug, __('Templates', 'ecwo'), __('Templates', 'ecwo'), $capability, 'ecwo-template', array($this, 'get_ecwo_template_page'));
                add_submenu_page($parent_slug, __('Settings', 'ecwo'), __('Settings', 'ecwo'), $capability, 'settings', array($this, 'get_setting_page'));
            }
        }

	/**
	 * Function to get default fonts
	 *
	 * @return array Default fonts list.
	 */
	public function get_default_fonts() {
		$default = array(
			array( 'Shadows Into Light', 'http://fonts.googleapis.com/css?family=Shadows+Into+Light' ),
			array( 'Droid Sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700' ),
			array( 'Abril Fatface', 'http://fonts.googleapis.com/css?family=Abril+Fatface' ),
			array( 'Arvo', 'http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' ),
			array( 'Lato', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' ),
			array( 'Just Another Hand', 'http://fonts.googleapis.com/css?family=Just+Another+Hand' ),
		);

		return $default;
	}
        
        /**
         * 
         * @global type $ecwo_settings
         * 
         * Initialize global settings
         */
        public function init_globals() {
            global $ecwo_settings;
            $ecwo_settings['ecwo-save-template'] = get_option('ecwo-save-template');
            $ecwo_settings['ecwo-templates-settings'] = get_option('ecwo-templates-settings');
            $ecwo_settings['ecwo_meta'] = get_option('ecwo_meta');
        }

        /**
	 * Templates page
	 */
	public function get_ecwo_template_page() {
            global $ecwo_settings;
            
            $chooseen_template = ecwo_get_proper_value($ecwo_settings, 'ecwo-save-template','template-1');
            if(!$chooseen_template)
                $chooseen_template= 'template-1';
            
            $default_ecwo_template_settings =
			array(
				'logo_url' => '',
				'fontFamily' => 'Poppins',
				'text_color' => '#3c3c3c',
				'primary_color' => '#96588a',
                            );
            
            $ecwo_template_settings = $ecwo_settings['ecwo-templates-settings'];

            if(!$ecwo_template_settings){
                $ecwo_template_settings = $default_ecwo_template_settings;
            }               
            ?>
            <script>
                var ecwo_template = '<?php echo esc_html($chooseen_template) ; ?>';
                var ecwo_template_settings = '<?php echo wp_json_encode($ecwo_template_settings); ?>';
                var default_ecwo_template_settings = '<?php echo wp_json_encode($default_ecwo_template_settings); ?>';
            </script>
            <?php
            $this->display_configurator_email($chooseen_template, $ecwo_template_settings);

	}
        
        /**
         * 
         * @param type $chooseen_template
         * @param type $ecwo_template_settings
         */
        public function display_configurator_email($chooseen_template, $ecwo_template_settings) {
            $font_family = $ecwo_template_settings['fontFamily'];
            $text_color = $ecwo_template_settings['text_color'];
            $logo_url = $ecwo_template_settings['logo_url'];
            $primary_color = $ecwo_template_settings['primary_color'];
            $facebook_link = ecwo_get_proper_value($ecwo_template_settings, 'facebook_link', '');
            $twitter_link = ecwo_get_proper_value($ecwo_template_settings, 'twitter_link', '');
            $instagram_link = ecwo_get_proper_value($ecwo_template_settings, 'instagram_link', '');
            $footer_text = ecwo_get_proper_value($ecwo_template_settings, 'footer_text', '');
            $template = $chooseen_template;
            
            $editor_template = new EditorTemplate($template, $text_color, $primary_color, $font_family, $logo_url,$facebook_link, $twitter_link, $instagram_link, $footer_text);
            $editor_template->display_configurator_email(); 
            ?>
            <script>
		var path = <?php echo wp_json_encode( ECWO_URL ); ?>;
            </script>
            <?php
        }

        /**
	 * Redirect to ecwo menu
	 */
	public function redirect_menu_ecwo() {
		if ( class_exists( 'WooCommerce' ) ) {
			if ( get_option( 'ecwo_do_activation_redirect', false ) ) {
				delete_option( 'ecwo_do_activation_redirect' );
				wp_redirect( admin_url( 'admin.php?page=ecwo-manage-dashboard' ) );
			}
		}
	}

	/**
	 * Notify Woocommerce Prerequisites
	 */
	public function notify_woocommerce_prerequisites() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			$admin_url = admin_url();
			?>
			<div id="message" class="notice error">
				<p><b>Email Customizer for WooCommerce by Orion: </b><?php echo esc_html__( 'WooCommerce is not installed on your website. You will not be able to use the features of the plugin.', 'ecwo' ); ?> <a class="button" href="<?php echo esc_html_e( $admin_url ) . 'plugins.php'; ?>"><?php esc_html__( 'Go to plugins page', 'ecwo' ); ?></a></p>
			</div>
			<?php
			return;
		}
	}

	/**
	 * Ajax call for get ecwo template
	 */
	public function get_ecwo_template() {
            $allowed_html = atd_allowed_tags();
            $template = filter_input(INPUT_POST, 'template_name', FILTER_DEFAULT);
            $settings = filter_input(INPUT_POST, 'settings', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            $font_family = $settings['fontFamily'];
            $text_color = $settings['text_color'];
            $link_color = $settings['primary_color'];
            $logo_url = $settings['logo_url'];
            $facebook_link = $settings['facebook_link'];
            $twitter_link = $settings['twitter_link'];
            $instagram_link = $settings['instagram_link'];
            $footer_text = $settings['footer_text'];
            
            $template_editor = new EditorTemplate($template, $text_color, $link_color, $font_family, $logo_url,$facebook_link, $twitter_link, $instagram_link, $footer_text);
            echo $template_editor->get_preview_page();
            wp_die();
	}

	/**
	 * Ajax call for save ecwo template
	 */
	public function save_ecwo_template() {            
            $template_name = filter_input(INPUT_POST, 'template_name', FILTER_DEFAULT);
            
            $settings = filter_input(INPUT_POST, 'settings', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
            
            if(!is_null($template_name)){
                update_option( 'ecwo-save-template', $template_name );
            }
            
            if(!is_null($settings)){
                if(!isset($settings['logo_url'])){
                    $settings['logo_url'] = '';
                }
                update_option( 'ecwo-templates-settings', $settings );
            }
            
            $this->init_globals();
            
            echo esc_html__(  'Template saved', 'ecwo' );

            die();
        }

        /*
	 * Override The Default Woocommerce Template
	 */
	
	public function set_ecwo_template($template, $template_name, $template_path) {
            global $woocommerce;
            global $ecwo_settings;
            $chooseen_template = $ecwo_settings['ecwo-save-template'];
            $ecwo_meta = $ecwo_settings['ecwo_meta'];
            
            $enable_template = ecwo_get_proper_value($ecwo_meta, 'enable-template', 'yes');
            
            if($enable_template === 'yes'){
                if (!$chooseen_template) {
                    $chooseen_template = 'template-1';
                }
                $_template = $template;
                
                if (!$template_path)
                    $template_path = $woocommerce->template_url;
                
                $plugin_path = untrailingslashit(plugin_dir_path(__FILE__)) . '/template/woocommerce/'.$chooseen_template.'/';

                // Look within passed path within the theme - this is priority
                $template = locate_template(
                        array(
                            $template_path . $template_name,
                            $template_name
                        )
                );

                if (!$template && file_exists($plugin_path . $template_name))
                    $template = $plugin_path . $template_name;

                if (!$template)
                    $template = $_template;
            }

        return $template;
    }
    
    public function add_custom_styles_to_email($emogrifier){
        $emogrifier->disableStyleBlocksParsing();
    }
    
    public function get_setting_page(){
        if (isset($_POST['securite_nonce'])) {
            if (wp_verify_nonce(wp_unslash(sanitize_key($_POST['securite_nonce'])), 'securite-nonce')) {
               $this->save_bc_tab_options();
            }
        }
        ?>
        <form method="POST">
            <div id="ecwo-settings">
                <div class="wrap">
                    <h2><?php esc_html_e('Settinngs', 'ecwo'); ?></h2>
                </div>
                <div id="TabbedPanels1" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup ">
                        <li class="TabbedPanelsTab " tabindex="1"><span><?php esc_html_e('Template', 'ecwo'); ?></span> </li>
                    </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent">
                            <div class='bc-grid bc-grid-pad'>
                                <?php
                                echo $this->get_enable_template_form();                            
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="<?php esc_html_e('Save', 'bc'); ?>" class="button button-primary button-large mg-top-10-i">
        </form>
    <?php
    }
    
    public function get_enable_template_form(){
        $enable_ecwo_template = array(
            'title' => __('Enable ECWO template', 'ecwo'),
            'name' => 'ecwo_meta[enable-template]',
            'default' => 'yes',
            'desc' => esc_html__('Would you like to enable the ecwo template?', 'ecwo'),
            'type' => 'radio',
            'options' => array(
                'no' => esc_html__('No', 'ecwo'),
                'yes' => esc_html__('Yes', 'ecwo'),
            ),
        );
        
        $enable_ecwo_template_begin = array(
            'type' => 'sectionbegin',
            'id' => 'ecwo-settings',
            'table' => 'options'
        );

        $enable_ecwo_template_end = array(
            'type' => 'sectionend',
            'id' => 'ecwo-settings',
        );
        
        $options = array();
        array_push($options, $enable_ecwo_template_begin);
        array_push($options, $enable_ecwo_template);
        array_push($options, $enable_ecwo_template_end);
        echo ecwo_o_admin_fields($options);
        ?>
        <input type="hidden" name="securite_nonce" value="<?php echo esc_html(wp_create_nonce('securite-nonce')); ?>"/>
        <?php
    }
    
    
    public function save_bc_tab_options(){
        if (isset($_POST['securite_nonce'])) {
            if (wp_verify_nonce(wp_unslash(sanitize_key($_POST['securite_nonce'])), 'securite-nonce')) {
                $key_table = ['ecwo_meta'];
                foreach ($key_table as $key) {
                    if (isset($_POST[$key])) {
                        update_option($key, wp_unslash(filter_input(INPUT_POST, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY)));
                    }
                }
                $this->init_globals();
                ?>
                <div id="message" class="updated below-h2"><p><?php esc_html_e('Settings successfully saved.', 'bc'); ?></p></div>
                <?php
            }
        }
    }
}
