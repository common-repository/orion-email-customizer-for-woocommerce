<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
$settings = ecwo_get_settings();
$footer_text = ecwo_get_proper_value($settings, 'footer_text', '');
?>

									</div>

								</div>

							</td>

						</tr>

					</table>

					<table cellspacing="0" cellpadding="0" class="ecwo-wrap ecwo-wrap-footer">

						<tr>

							<td class="ecwo-content-padding">

								<div class="ecwo-footer-inner">

									<div class="ecwo-block-text">

										<div class="ecwo-footer-content">

											<div class="ecwo-footer-item ecwo-footer-social-media">

												<?php return_social_media();?>

											</div>

											<div class="ecwo-footer-item ecwo-footer-unsubscribe"><?php echo esc_html($footer_text);?></div>

										</div>

									</div>

								</div>

							</td>

						</tr>

						</table>

					</td>

				</tr>

			</table>

		</td>

    </tr>

</table>
		
</body>
</html>
