<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
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
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$settings = ecwo_get_settings();
$logo_url = ecwo_get_proper_value($settings, 'logo_url', '');
$footer_text = ecwo_get_proper_value($settings, 'footer_text', '');
$google_font_family = ecwo_get_proper_value($settings, 'fontFamily', 'Poppins');
$allowed_tags = atd_allowed_tags();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php echo get_bloginfo('name', 'display'); ?></title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href='https://fonts.googleapis.com/css?family=<?php echo esc_attr($google_font_family)?>' rel='stylesheet' type='text/css'>
        <?php ecwo_add_font_to_mail(); ?>
    </head>
    <body style="padding: 0;">

        <table id="ecwo-template-wrapper" cellspacing="0" cellpadding="0">

            <tr>
                <td class="ecwo-template-inner">

                    <table id="ecwo-main-builder" width="600" cellspacing="0" cellpadding="0" class="ecwo-preview-email-wrapper">

                        <tr>

                            <td class="ecwo-preview-email-container">

                                <table cellspacing="0" cellpadding="0" class="ecwo-wrap ecwo-wrap-header">

                                    <tr>

                                        <td class="ecwo-navbar ecwo-content-padding">

                                            <div class="ecwo-navbar-inner ecwo-block-text">

                                                <div class="ecwo-navbar-logo">

                                                    <a href="#" class="ecwo-navbar-logo-title">
                                                        <?php
                                                       if (!empty($logo_url)) {
                                                            echo "<img src='". esc_attr($this->logo_url)."' style = 'max-height:60px'>";
                                                        } else {
                                                            echo esc_html("YOUR LOGO");
                                                        }
                                                        ?> 
                                                    </a>

                                                </div>
                                                <div class="ecwo-navbar-welcome">Your order 13950 is arriving today!</div>

                                            </div>

                                        </td>

                                    </tr>

                                </table>

                                <table cellspacing="0" cellpadding="0" class="ecwo-wrap ecwo-wrap-body">

                                    <tr>

                                        <td class="ecwo-content-padding">

                                            <div class="ecwo-block-text">

                                                <div id="ecwo-body-content" class="ecwo-preview-email-content-inner">
