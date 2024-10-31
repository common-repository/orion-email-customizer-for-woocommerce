            <table cellspacing="0" cellpadding="0" class="ecwo-wrap ecwo-wrap-footer">

                <tr>

                    <td class="ecwo-content-padding">

                        <div class="ecwo-footer-inner">

                            <div class="ecwo-block-text">

                                <div class="ecwo-footer-content">

                                    <div class="ecwo-footer-item ecwo-footer-social-media">

                                        <?php
                                            $this->return_social_media();
                                        ?>

                                    </div>

                                    <a class="ecwo-navbar-logo-title ecwo-footer-item ecwo-footer-logo">
                                        <?php
                                        if (!empty($this->logo_url)) {
                                            echo "<img src='". esc_attr($this->logo_url)."' style = 'max-height:60px'>";
                                        } else {
                                            echo esc_html("YOUR LOGO");
                                        }
                                        ?> 
                                    </a>

                                    <div class="ecwo-footer-item ecwo-footer-unsubscribe"><?php echo esc_html($this->footer_text);?></div>

                                </div>

                            </div>

                        </div>

                    </td>

                </tr>

            </table>

        </td>

    </tr>

</table>