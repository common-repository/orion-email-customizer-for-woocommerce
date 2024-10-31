<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */


/**
 * Description of class-editor-template
 *
 * @author Herval NOUMONVI
 */
class EditorTemplate {

    public $template, $text_color, $primary_color, $font_family, $logo_url, $facebook_link, $twitter_link, $instagram_link, $footer_text;

    public function __construct($template, $text_color, $primary_color, $font_family, $logo_url, $facebook_link, $twitter_link, $instagram_link, $footer_text) {
        $this->template = $template;
        $this->text_color = $text_color;
        $this->primary_color = $primary_color;
        $this->font_family = $font_family;
        $this->logo_url = $logo_url;
        $this->facebook_link = $facebook_link;
        $this->twitter_link = $twitter_link;
        $this->instagram_link = $instagram_link;
        $this->footer_text = $footer_text;
    }

    /**
     * 
     * Cette fonction permet d'afficher tout le configurateur d'email
     */
    public function display_configurator_email() {
?>
                <div class="ecwo-wrapper">

                                    <div class="ecwo-inner">

                                        <!--====== First Section Begin ======-->

                                        <div class="ecwo-column-section ecwo-column-settings">

                                            <div class="ecwo-column-section-inner">

                                                <div class="ecwo-main-actions">

                                                    <li class="ecwo-main-action-item ecwo-active" data-action="templates"><?php echo esc_html__('TEMPLATES', 'ecwo'); ?></li>

                                                    <li class="ecwo-main-action-item" data-action="edit-template"><?php echo esc_html__('EDIT TEMPLATE', 'ecwo'); ?></li>

                                                </div>

                                                <div class="ecwo-switch-contents">

                                                    <div class="ecwo-switch-contents-wrap">

                                                        <div class="ecwo-switch-contents-inner">
                                                            <?php $this->display_all_template() ?>
                                                            <?php $this->get_edit_template_page() ?>                                                
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="ecwo-btns-container ecwo-mt-30">

                                                    <button type="submit" id="ecwo-btn-save-template-options" class="ecwo-btn ecwo-btn-primary ecwo-btn-save-template"><i class="uil uil-save ecwo-btn-icon"></i> <?php echo esc_html__('SAVE Template', 'ecwo'); ?></button>

                                                    <button type="submit" class="ecwo-btn ecwo-btn-primary-outline ecwo-btn-reset"><i class="uil uil-redo ecwo-btn-icon"></i><?php echo esc_html__('RESET Templates', 'ecwo'); ?></button>

                                                </div>
                                                
                                                <div id="ecwo-debug"></div>
                                                
                                            </div>

                                        </div>
                                        <div class="ecwo-column-section ecwo-builder-inner" id="ecwo-builder-inner-preview">
                                            <?php echo $this->get_preview_page() ?>
                                        </div>
                                    </div>
                                <!--====== ECWO loader Begin ======-->

                                    <div class="ecwo-loader">

                                        <div class="ecwo-loader-ring"></div>

                                    </div>

                                <!--====== ECWO loader end ======-->
                                </div>
        <?php
    }

    /**
     * 
     * @return type
     * Permet d'afficher le preview
     */
    public function get_preview_page() {
        ob_start();
        $allowed_tags = atd_allowed_tags();
    ?>
            <!--====== Second Section Begin ======-->

             <!--====== Second Section End ======-->
                   

                           <div class="ecwo-column-preview" style="<?php echo esc_attr('--ecwo-color-primary:' . $this->primary_color . ';--ecwo-color-text:' . $this->text_color . ';--ecwo-font-family:' . $this->font_family) ?>">
        <?php include( ECWO_DIR . '/includes/templates/' . $this->template . '/header.php' ); ?>

        <?php include( ECWO_DIR . '/includes/templates/' . $this->template . '/content.php' ); ?>

        <?php include( ECWO_DIR . '/includes/templates/' . $this->template . '/footer.php' ); ?>

                           </div>    

               
        <?php
        $output = ob_get_clean();
        return $output;
    }
    
    /**
     * Affiche les differents emails
     */
    public function display_all_template() {
        ?>
                        <div class="ecwo-switch-content ecwo-switch-content-templates" data-action="templates">

                                    <h3 class="ecwo-action-title">Select an Email template</h3>

                                    <div class="ecwo-templates-container">
        <?php
        for ($i = 1; $i <= 5; $i++) {
        ?>
                                            <li class="ecwo-template-item" data-template="<?php echo esc_attr('template-' . $i) ?>">

                                                <div class="ecwo-template-item-img-inner">

                                                    <div class="ecwo-template-img-bg" style="background-image: url('<?php echo esc_attr(plugin_dir_url(__DIR__) . 'admin/images/template-' . $i . '.png') ?>')"></div>

                                                </div>

                                                <div class="ecwo-template-name">

                                                    <p class="ecwo-template-label" title="<?php echo esc_attr('template' . $i) ?>">Template <?php echo esc_html($i) ?></p>

                                                </div>

                                            </li>
            <?php
        }
            ?>
                                    </div>
                                </div>
        <?php
    }

    
    public function return_social_media() {
        ?>
            <a href="" class="ecwo-social-media-inner" id="facebook-icon"><img src=" <?php echo ECWO_URL . 'admin/images/facebook-img.png' ?>" class="ecwo-social-media-icon" alt="facebook image"></a>
            <a href="" class="ecwo-social-media-inner" id="twiter-icon"><img src="<?php echo ECWO_URL . 'admin/images/twitter-img.png' ?>" class="ecwo-social-media-icon" alt="twitter image"></a>
            <a href="" class="ecwo-social-media-inner" id="instagram-icon"><img src="<?php echo ECWO_URL . 'admin/images/linkedin-img.png' ?>" class="ecwo-social-media-icon" alt="linkedin image"></a>
        <?php
    }
    
    /**
     * Affiche la page d'edition des templates
     */
    public function get_edit_template_page() {            
            wp_enqueue_media();
                        ?>
                <div class="ecwo-switch-content" data-action="edit-template">

                            <h3 class="ecwo-action-title"><?php echo esc_html__('Edit your template', 'ecwo'); ?></h3>

                            <form id='ecwo-settings-form' action="">

                                <div class="ecwo-edit-row">

                                    <div class="ecwo-upload-area">

                                        <div class="ecwo-cancel-upload"><i class="uil uil-times"></i></div>

                                        <div class="ecwo-file-name"><?php echo esc_html($this->logo_url) ?></div>

                                        <div class="ecwo-icon-upload">
                                            <?php
                                            if(!empty($this->logo_url)){
                                                echo ("<img src='" . esc_attr($this->logo_url) . "' style='height: 70px;' alt='Uploaded logo Image'>");
                                            }
                                            ?>
                                        </div>

                                        <div class="ecwo-head"><?php echo esc_html__('Upload Logo', 'ecwo'); ?></div>

                                        <span class="ecwo-btn ecwo-btn-gray ecwo-logo"><?php echo esc_html__('Select Logo', 'ecwo'); ?></span>

                                        <input type="hidden" id="ecwo-logo">

                                    </div>

                                </div>

                                <div class="ecwo-edit-row">

                                    <div class="ecwo-label"><?php echo esc_html__('Font family', 'ecwo'); ?></div>

                                    <select name="ecwo-font-family" id="ecwo-font-family" class="ecwo-field">

                                        <?php
                                        $fonts = get_all_google_fonts();
                                        if(!$fonts){
                                            $fonts = get_default_fonts();
                                        }
                                        if ($fonts) :
                                            foreach ($fonts as $font_arr) :
                                                $font = $font_arr[0];
                                                ?>

                                                <option 
                                                <?php
                                                if ($font == $this->font_family) {
                                                    echo 'selected';
                                                }
                                                ?>
                                                    value="<?php echo esc_html($font); ?>"><?php echo esc_html($font); ?></option>
                                                    <?php
                                                endforeach;
                                            else :
                                                ?>
                                            <option value=""><?php echo esc_html__('Nothing', 'ecwo'); ?></option>
                                        <?php
                                        endif;
                                        ?>
                                    </select>

                                </div>

                                <div class="ecwo-edit-row">

                                    <div class="ecwo-edit-row-text">

                                        <div class="ecwo-label-title"><?php echo esc_html__('Text color', 'ecwo'); ?></div>

                                        <div class="ecwo-color-picker">

                                            <input id="ecwo-text-color-email"/>

                                        </div>

                                    </div>

                                </div>

                                <div class="ecwo-edit-row">

                                    <div class="ecwo-edit-row-text">

                                        <div class="ecwo-label-title"><?php echo esc_html__('Links color', 'ecwo'); ?></div>

                                        <div class="ecwo-color-picker">

                                            <input id="ecwo-links-color-email"/>

                                        </div>

                                    </div>

                                </div>
                                
                                <div class="ecwo-edit-row">

                                    <div class="ecwo-edit-row-text">

                                        <div class="ecwo-label-title"><?php echo esc_html__('Facebook Link', 'ecwo'); ?></div>

                                        <div class="ecwo-color-picker">

                                            <input type="text" id="facebook-link" value = '<?php if(!empty($this->facebook_link)) echo esc_attr($this->facebook_link)?>'/>
                                                
                                        </div>

                                    </div>

                                </div>
                                <div class="ecwo-edit-row">

                                    <div class="ecwo-edit-row-text">

                                        <div class="ecwo-label-title"><?php echo esc_html__('Twitter Link', 'ecwo'); ?></div>

                                        <div class="ecwo-color-picker">

                                            <input type="text" id="twitter-link"  value = '<?php if(!empty($this->twitter_link)) echo esc_attr($this->twitter_link)?>'/>
                                                
                                        </div>

                                    </div>

                                </div>
                                <div class="ecwo-edit-row">

                                    <div class="ecwo-edit-row-text">

                                        <div class="ecwo-label-title"><?php echo esc_html__('LinkedIn Link', 'ecwo'); ?></div>

                                        <div class="ecwo-color-picker">

                                            <input type="text" id="instagram-link" value = '<?php if(!empty($this->instagram_link)) echo esc_attr($this->instagram_link)?>'/>
                                                
                                        </div>

                                    </div>

                                </div>
                                
                                
                                <div class="ecwo-edit-row">

                                    <div class="ecwo-label"><?php echo esc_html__('Footer Text', 'ecwo'); ?></div>

                                    <textarea id="footer-text" class="ecwo-field ecwo-field-custom-textarea"></textarea>

                                </div>

                            </form>

                        </div>
            <?php
        }

}
