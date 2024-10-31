
<!--====== Table Owner Style Begin ======-->

<!--====== Table Owner End Begin ======-->

<table id="ecwo-main-builder" width="600" cellspacing="0" cellpadding="0" class="ecwo-preview-email-wrapper">

    <tr>

        <td class="ecwo-preview-email-container">

            <table cellspacing="0" cellpadding="0" class="ecwo-wrap ecwo-wrap-header">

                <tr>

                    <td class="ecwo-navbar ecwo-content-padding">

                        <div class="ecwo-navbar-inner ecwo-block-text">

                            <div class="ecwo-navbar-logo">

                                <a href="#" class="ecwo-navbar-logo-title">
                                    <?php if(!empty($this->logo_url)){
                                         echo "<img src='". esc_attr($this->logo_url)."' style = 'max-height:60px'>";
                                    }else{
                                        echo esc_html("YOUR LOGO");
                                    }
                                    ?> 
                                </a>

                            </div>

                            <div class="ecwo-navbar-menu">

                                <li class="ecwo-navbar-menu-item"><a href="#" class="ecwo-navbar-menu-link">New</a></li>

                                <li class="ecwo-navbar-menu-item"><a href="#" class="ecwo-navbar-menu-link">Bottoms</a></li>

                                <li class="ecwo-navbar-menu-item"><a href="#" class="ecwo-navbar-menu-link">Tops</a></li>

                                <li class="ecwo-navbar-menu-item"><a href="#" class="ecwo-navbar-menu-link">Tailored</a></li>

                            </div>

                        </div>

                    </td>

                </tr>

            </table>