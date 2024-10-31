<?php

/**
 * Function to get array labels
 *
 * @param array $datas Datas list.
 * @return array
 */
function ecwo_get_font_labels( $datas ) {
	$labels_values = array();
	foreach ( $datas as $data_value ) {
		$labels_values[] = $data_value[0];
	}
	return $labels_values;
}

/**
 * Function to get font style.
 *
 * @param array $font Fonts list.
 */
function ecwo_get_font_style( $font ) {
	$font_label  = $font[0];
	$font_files  = $font[2];
	foreach ( $font_files as $font_file ) {
		$font_styles     = $font_file['styles'];
		$font_file_url   = wp_get_attachment_url( $font_file['file_id'] );
		if ( ! $font_file_url ) {
			continue;
		}
		foreach ( $font_styles as $font_style ) {
			if ( '' === $font_style ) {
				$font_style_css = '';
			} elseif ( 'I' === $font_style ) {
				$font_style_css = 'font-style:italic;';
			} elseif ( 'B' === $font_style ) {
				$font_style_css = 'font-weight:bold;';
			}
			if ( is_ssl() ) {
				$font_file_url = str_replace( 'http://', 'https://', $font_file_url );
			}
			?>
		<style>
			@font-face {
			font-family: "<?php echo esc_html( $font_label ); ?>";
			src: url('<?php echo esc_html( $font_file_url ); ?>') format('truetype');
			<?php echo esc_html( $font_style_css ); ?>
			}
		</style>
			<?php
		}
	}
}
        /**
	 * Function to get default fonts
	 *
	 * @return array Default fonts list.
	 */
	function get_default_fonts() {
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

        function ecwo_get_settings(){
            global $ecwo_settings;
            $ecwo_template_settings = $ecwo_settings['ecwo-templates-settings'];
            return $ecwo_template_settings;
        }
        
    function get_all_google_fonts() {
        $url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwjhzcfEEHD0cL0S90wDyvoKHLGJdwWvY';
        $test_url = fopen($url, 'r');

        if ($test_url) {
            $url = wp_remote_retrieve_body(wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBwjhzcfEEHD0cL0S90wDyvoKHLGJdwWvY'));
            $url_decode = json_decode($url, true);
            fclose($test_url);
        } else {
            $url = plugin_dir_path( __FILE__ ) . 'googlefont.json';
            $fonts_json_file = fopen( $url, 'r' );
            $font_content    = fread( $fonts_json_file, filesize( $url ) );
            fclose( $fonts_json_file );
            $url_decode = json_decode( $font_content, true );
        }
        
        foreach ( $url_decode['items'] as $font ) {
            if ( isset( $font['family'] ) && isset( $font['files'] ) && isset( $font['files']['regular'] ) ) {
                $font_url = 'http://fonts.googleapis.com/css?family=' . rawurlencode( $font['family'] );
                $font_label = $font['family'];
                $fonts [] = array($font_label, $font_url, $font['files']);
            }
	}        
        return $fonts;
    }
    
    /**
     * 
     * @global type $ecwo_settings
     * 
     * Add google font style to email
     */
    function ecwo_add_font_to_mail() {
        global $ecwo_settings;
        $ecwo_template_settings = $ecwo_settings['ecwo-templates-settings'];
        $font_family = ecwo_get_proper_value($ecwo_template_settings, 'fontFamily', 'Poppins');
        return $font_family;
    }
    
    /**
     * 
     * @param type $facebook_link
     * @param type $twitter_link
     * @param type $instagram_link
     */
    function return_social_media(){
            global $ecwo_settings;
            $allowed_tags = atd_allowed_tags();
            $ecwo_template_settings = $ecwo_settings['ecwo-templates-settings'];
            $facebook_link = ecwo_get_proper_value($ecwo_template_settings, 'facebook_link', '');
            $twitter_link = ecwo_get_proper_value($ecwo_template_settings, 'twitter_link', '');
            $instagram_link = ecwo_get_proper_value($ecwo_template_settings, 'instagram_link', '');
            
            if (!empty($facebook_link)) {
                echo wp_kses('<a href="' . $facebook_link . '" class="ecwo-social-media-inner"><img src="'.ECWO_URL.'admin/images/facebook-img.png" class="ecwo-social-media-icon" alt="facebook image"></a>', $allowed_tags);
            }
            if (!empty($twitter_link)) {
                 echo wp_kses( '<a href="' . $twitter_link . '" class="ecwo-social-media-inner"><img src="'.ECWO_URL.'admin/images/twitter-img.png" class="ecwo-social-media-icon" alt="twitter image"></a>', $allowed_tags);
            }
            if (!empty($instagram_link)) {
                 echo wp_kses( '<a href="' . $instagram_link . '" class="ecwo-social-media-inner"><img src="'.ECWO_URL.'admin/images/linkedin-img.png" class="ecwo-social-media-icon" alt="linkedin image"></a>', $allowed_tags);
            }
    }
    
    function atd_allowed_tags( $attributes = '' ) {

	$default_attribs = array(
		'id'             => array(),
		'class'          => array(),
		'title'          => array(),
		'style'          => array(),
		'data'           => array(),
		'data-mce-id'    => array(),
		'data-mce-style' => array(),
		'data-mce-bogus' => array(),
                'data-item' => array(),
                'data-toggle' => array(),
                'data-target' => array(),
                'tabindex' => array(),
                'role' => array(),
                'aria-labelledby' => array(),
                'aria-hidden' => array(),
                'type' => array(),
                'data-dismiss' => array(),
                'download' => array(),
	);

	if ( is_array( $attributes ) && ! empty( $attributes ) ) {
		foreach ( $attributes as $value ) {
			$default_attribs[ $value ] = array();
		}
	}
	$allowed_tags = array(
        'div' => $default_attribs,
        'img' => array_merge(
                $default_attribs,
                array(
                    'src' => array(),
                    'alt' => array(),
                    'title' => array(),
                    'height' => array(),
                )
        ),
        'span' => $default_attribs,
        'canvas' => $default_attribs,
        'textarea' => $default_attribs,
        'script' => array(
            'type' => array(),
            'src' => array(),
        ),
        'p' => $default_attribs,
        'a' => array_merge(
                $default_attribs,
                array(
                    'href' => array(),
                    'target' => array('_blank', '_top'),
                )
        ),
        'input' => array_merge(
                $default_attribs,
                array(
                    'type' => array(),
                    'id' => array(),
                    'step' => array(),
                    'min' => array(),
                    'max' => array(),
                    'name' => array(),
                    'value' => array(),
                    'checked' => array(),
                    'placeholder' => array(),
                    'multiple' => array(),
                    'accept' => array(),
                )
        ),
        'style' => array_merge(
                $default_attribs,
                array(
                    'type' => array('text/css'),
                )
        ),
        'select' => array_merge(
                $default_attribs,
                array(
                    'value' => array(),
                    'checked' => array(),
                )
        ),
        'option' => array_merge(
                $default_attribs,
                array(
                    'value' => array(),
                    'checked' => array(),
                )
        ),
        'optgroup' => array_merge(
                $default_attribs,
                array(
                    'value' => array(),
                    'checked' => array(),
                )
        ),
        'textarea' => array_merge(
                $default_attribs,
                array(
                    'name' => array(),
                    'placeholder' => array(),
                )
        ),
        'table' => array_merge(
                $default_attribs,
                array(
                    'cellspacing' => array(),
                    'cellpadding' => array(),
                )
        ),
        'u' => $default_attribs,
        'i' => $default_attribs,
        'q' => $default_attribs,
        'b' => $default_attribs,
        'ul' => $default_attribs,
        'ol' => $default_attribs,
        'li' => $default_attribs,
        'br' => $default_attribs,
        'hr' => $default_attribs,
        'strong' => $default_attribs,
        'blockquote' => $default_attribs,
        'del' => $default_attribs,
        'strike' => $default_attribs,
        'em' => $default_attribs,
        'code' => $default_attribs,
        'button' => $default_attribs,
        'tr' => $default_attribs,
        'td' => $default_attribs,
        'h4' => $default_attribs,
    );
    return $allowed_tags;
}
