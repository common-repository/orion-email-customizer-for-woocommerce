<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = get_option( 'woocommerce_email_background_color' );
$body      = get_option( 'woocommerce_email_body_background_color' );
$base      = get_option( 'woocommerce_email_base_color' );
$base_text = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text      = get_option( 'woocommerce_email_text_color' );

// Pick a contrasting color for links.
$link_color = wc_hex_is_light( $base ) ? $base : $base_text;

if ( wc_hex_is_light( $body ) ) {
	$link_color = wc_hex_is_light( $base ) ? $base_text : $base;
}

//ECWO settings
global $ecwo_settings;
            
$ecwo_template_settings = $ecwo_settings['ecwo-templates-settings'];
$fontFamily = ecwo_get_proper_value($ecwo_template_settings, 'fontFamily', 'Poppins');
$text_color = ecwo_get_proper_value($ecwo_template_settings, 'text_color', '#3c3c3c');
$primary_color = ecwo_get_proper_value($ecwo_template_settings, 'primary_color', '#96588a');

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );
$text_lighter_40 = wc_hex_lighter( $text, 40 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>

body {
	padding: 0;
}

#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	margin: 0;
	padding: 70px 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;
}

#template_container {
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1) !important;
	background-color: <?php echo esc_attr( $body ); ?>;
	border: 1px solid <?php echo esc_attr( $bg_darker_10 ); ?>;
	border-radius: 3px !important;
}

#template_header {
	background-color: <?php echo esc_attr( $base ); ?>;
	border-radius: 3px 3px 0 0 !important;
	color: <?php echo esc_attr( $base_text ); ?>;
	border-bottom: 0;
	font-weight: bold;
	line-height: 100%;
	vertical-align: middle;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
}

#template_header h1,
#template_header h1 a {
	color: <?php echo esc_attr( $base_text ); ?>;
	background-color: inherit;
}

#template_header_image img {
	margin-left: 0;
	margin-right: 0;
}

#template_footer td {
	padding: 0;
	border-radius: 6px;
}

#template_footer #credit {
	border: 0;
	color: <?php echo esc_attr( $text_lighter_40 ); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 12px;
	line-height: 150%;
	text-align: center;
	padding: 24px 0;
}

#template_footer #credit p {
	margin: 0 0 16px;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
	padding: 48px 48px 32px;
}

#body_content table td td {
	padding: 12px;
}

#body_content table td th {
	padding: 12px;
}

#body_content td ul.wc-item-meta {
	font-size: small;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#body_content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 14px;
	line-height: 150%;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

.td {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
	vertical-align: middle;
}

.address {
	padding: 12px;
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
}

.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
}

.link {
	color: <?php echo esc_attr( $link_color ); ?>;
}

#header_wrapper {
	padding: 36px 48px;
	display: block;
}

h1 {
	color: <?php echo esc_attr( $base ); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 30px;
	font-weight: 300;
	line-height: 150%;
	margin: 0;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
	text-shadow: 0 1px 0 <?php echo esc_attr( $base_lighter_20 ); ?>;
}

h2 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 18px;
	font-weight: bold;
	line-height: 130%;
	margin: 0 0 18px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 16px;
	font-weight: bold;
	line-height: 130%;
	margin: 16px 0 8px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
	color: <?php echo esc_attr( $link_color ); ?>;
	font-weight: normal;
	text-decoration: underline;
}

body {
	margin: 0;
}

#ecwo-template-wrapper {
	width: 100%;
}

.ecwo-template-inner {
	background-color: #f7f7f7;
	padding: 70px 0;
}

#ecwo-main-builder .ecwo-navbar-menu-link,
#ecwo-main-builder .ecwo-footer-support-link, 
#ecwo-main-builder .ecwo-navbar-logo-title {
	text-decoration: none !important;
}

.ecwo-preview-email-wrapper li {
	list-style: none;
}

.ecwo-builder-inner {
	background-color: #f4f4f4;
	padding: 60px 0 40px;
}

.ecwo-column-preview {
	width: 650px;
	margin: 0 auto;
}

.ecwo-preview-email-wrapper {
	max-width: 600px;
	width: 600px;
	margin: auto;
}

.ecwo-preview-email-container {
	background: none;
	border: none;
}

.ecwo-wrap {
	position: relative;
	width: 100%;
	max-width: 100%;
	table-layout: fixed;
	background-color: transparent;
	border-width: 0;
	border-style: none;
	border-color: transparent;
	border-spacing: 0px;
	margin: 0 auto;
	padding: 0;
}

.ecwo-wrap-body {
	margin: 26px auto;
}

.ecwo-navbar {
	width: 100%;
}

.ecwo-content-padding {
	padding-left: 45px;
	padding-right: 45px;
}

.ecwo-wrap-header .ecwo-content-padding {
	background: #fff;
	padding: 0;
	-webkit-box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.01);
	box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.01);
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

.ecwo-wrap-body .ecwo-content-padding {
	padding-top: 20px;
	padding-bottom: 20px;
	background-color: #fff;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

.ecwo-wrap-footer .ecwo-content-padding {
	padding-top: 45px;
	padding-bottom: 45px;
	background-color: #fff;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

.ecwo-navbar .ecwo-navbar-inner {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-orient: vertical;
	-webkit-box-direction: normal;
	-ms-flex-direction: column;
	flex-direction: column;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-box-pack: justify;
	-ms-flex-pack: justify;
	justify-content: space-between;
}

.ecwo-navbar-logo {
	padding: 45px 0;
}

.ecwo-navbar-logo,
.ecwo-navbar-menu {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	justify-content: center;
	width: 100%;
}

.ecwo-block-text {
	table-layout: fixed;
	width: 100%;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: <?php echo esc_attr($text_color); ?>;
	font-size: 12px;
	line-height: 20px;
	font-weight: normal;
	font-family: <?php echo esc_attr($fontFamily); ?>;
	margin: 0 auto;
}

.ecwo-navbar-logo-title {
	color: <?php echo esc_attr($text_color); ?> !important;
	font-size: 32px;
	font-weight: 500;
}

.ecwo-navbar-menu {
	background-color: #444444;
	padding: 16px 0;
	border-radius: 0 0 8px 8px;
}

.ecwo-navbar-menu-item {
	display: inline-block;
}

.ecwo-navbar-menu-link {
	display: block;
	color: #fff !important;
	font-size: 14px;
	font-weight: 400;
	margin-left: 28px;
}

#ecwo-main-builder h2 {
	color: <?php echo esc_attr($primary_color); ?>;
	font-size: 18px;
}

#ecwo-main-builder a,
.ecwo-link {
	color: <?php echo esc_attr($primary_color); ?>;
}

.ecwo-footer-content {
	text-align: center;
}

<!-- .ecwo-footer-item {
	width: calc(100% / 2 - 20px);
} -->

#ecwo-main-builder .ecwo-footer-item-title {
	color: #000;
}

.ecwo-footer-item-desc {
	font-size: 12px;
	margin: 10px 0;
}

.ecwo-footer-support-link {
	color: <?php echo esc_attr($primary_color); ?> !important;
}

.ecwo-footer-social-media {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
	margin-top: 16px;
}

.ecwo-social-media-inner {
    height: 20px;
    width: 20px;
    margin-right: 8px;
}

#ecwo-main-builder .ecwo-social-media-inner {
	color: <?php echo esc_attr($text_color); ?> !important;
}

.ecwo-social-media-icon {
	height: 100%;
    width: 100%;
}

.ecwo-footer-unsubscribe {
	margin-top: 16px;
}

#ecwo-body-content {
	background-color: #fff;
	font-family: <?php echo esc_attr($fontFamily); ?> !important;
}

#ecwo-body-content table td {
	padding: 12px;
}

#ecwo-body-content table th {
	padding: 12px;
}

#ecwo-body-content table.td,
#ecwo-body-content table .address {
	font-size: 14px;
	line-height: 150%;
}

h1, h2, h3,
#ecwo-body-content table.td,
#ecwo-body-content table.td td,
#ecwo-body-content table .address {
	font-family: <?php echo esc_attr($fontFamily); ?> !important;
}

#ecwo-body-content td ul.wc-item-meta {
	font-size: small;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#ecwo-body-content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#ecwo-body-content td ul.wc-item-meta li p {
	margin: 0;
}

#ecwo-body-content p {
	margin: 0 0 16px;
}

.td {
	color: <?php echo esc_attr($text_color); ?>;
	border: 1px solid #e5e5e5;
	vertical-align: middle;
}

.address {
	padding: 12px;
	color: <?php echo esc_attr($text_color); ?>;
	border: 1px solid #e5e5e5;
}

<?php