<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wp_version, $wpdb, $bdp_errors, $bdp_success, $bdp_settings;

$active_tab = (isset($_GET['tab']) && $_GET['tab'] != '') ? $_GET['tab'] : 'help_file';
$bdp_wp_auto_update = new bdp_wp_auto_update();
$plugin_version = get_option('bdp_version');

if (isset($bdp_errors)) {
    if (is_wp_error($bdp_errors)) {
        ?>
        <div class="error notice">
            <p><?php echo $bdp_errors->get_error_message(); ?></p>
        </div>
        <?php
    }
}
if (isset($bdp_success)) {
    ?>
    <div class="updated notice">
        <p><?php echo $bdp_success; ?></p>
    </div>
    <?php
}
if (isset($_GET['page']) && $_GET['page'] == 'bdp_getting_started') {
    $allsettings = get_option('bdp_single_file_template');
    if ($allsettings && is_serialized($allsettings)) {
        $bdp_settings = unserialize($allsettings);
    }
    $msg = '&msg=updated';
}

bdp_admin_singlefile_actions();
?>
<div class="wrap getting-started-wrap">
    <h2 style="display: none;"></h2>
    <div class="intro">
        <div class="intro-content">
            <h3> <?php esc_html_e('Getting Started', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </h3>
            <h4> <?php echo esc_html__('You will find everything you need to get started here. You are now equipped with arguably the most powerful WordPress', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __('Blog Layouts Builder', BLOGDESIGNERPRO_TEXTDOMAIN) .'</b>. '.__('To enjoy the full experience, we strongly recommend to read the help file first and register your product with codecanyon license key.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </h4>
        </div>
        <div class="intro-logo">
            <div class="intro-logo-cover">
                <img src="<?php echo BLOGDESIGNERPRO_URL . '/admin/images/bdp-logo.png'; ?>" alt="<?php _e('Blog Designer PRO', BLOGDESIGNERPRO_TEXTDOMAIN)?>" />
                <span class="bdp-version"><?php echo __('Version', BLOGDESIGNERPRO_TEXTDOMAIN) .' '. $plugin_version; ?></span>
            </div>
        </div>
    </div>

    <div class="blog-designer-panel">
        <ul class="blog-designer-panel-list">
            <li class="panel-item <?php echo ($active_tab == 'help_file') ? 'active' : ''; ?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=help_file'); ?>"><?php _e('Read This First', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="panel-item <?php echo ($active_tab == 'register_product') ? 'active' : ''; ?> <?php echo ($bdp_wp_auto_update->getRemote_license() == 'correct') ? 'bdp-reg' : 'bdp-not-reg'?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=register_product'); ?>"><?php _e('Register Product', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="panel-item <?php echo ($active_tab == 'support') ? 'active' : ''; ?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=support'); ?>"><?php _e('Support', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="panel-item <?php echo ($active_tab == 'tools') ? 'active' : ''; ?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=tools'); ?>"><?php _e('Tools', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="panel-item <?php echo ($active_tab == 'recomended_plugins') ? 'active' : ''; ?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=recomended_plugins'); ?>"><?php _e('Recommended Plugins', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
            <li class="panel-item <?php echo ($active_tab == 'system_status') ? 'active' : ''; ?>">
                <a href="<?php echo admin_url('admin.php?page=bdp_getting_started&&tab=system_status'); ?>"><?php _e('System Status', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
            </li>
        </ul>

        <div class="blog-designer-panel-wrap">
            <?php if ($active_tab == 'help_file') : ?>
            <div id="bdp-help-file" class="bdp-help-file">
                <div class="bdp-panel-left">
                    <div class="bdp-notification">
                        <h2>
                            <?php echo __('Success, The Blog Designer PRO is now activated!', BLOGDESIGNERPRO_TEXTDOMAIN) . ' &#x1F60A'; ?>
                        </h2>
                        <h4 class="do-create-test-page">
                            <?php
                            $blog_designer_setting = get_option("wp_blog_designer_settings");
                            $create_layout_from_blog_designer_notice = get_option('bdp_admin_notice_create_layout_from_blog_designer_dismiss', false);
                            $sample_layout_notice = get_option('bdp_admin_notice_pro_layouts_dismiss', false);
                            if ($blog_designer_setting != '' && $create_layout_from_blog_designer_notice == false) {
                                _e('Would you like to create one sample blog page using Blog Designer (free plugin) Data?', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <br/><br/>
                                <a class="bdp-create-layout-using-blog-designer" href="<?php echo esc_url(add_query_arg('create-layout-using-blog-designer', 'new', admin_url('admin.php?page=layouts'))) ;?>"><?php _e('Yes, Please do it', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a> | <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#quick_guide'); ?>" target="_blank"> <?php _e('No, I will configure my self (Give me steps)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </a> <?php
                            } elseif ($sample_layout_notice == false) {
                                _e('Would you like to create one sample blog page to check usage of Blog Designer PRO plugin?', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <br/><br/>
                                <a class="bdp-create-layout" href="<?php echo esc_url(add_query_arg('sample-blog-layout', 'new', admin_url('admin.php?page=layouts'))); ?>"><?php _e('Yes, Please do it', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a> | <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#quick_guide'); ?>" target="_blank"> <?php _e('No, I will configure my self (Give me steps)', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </a> 
                                <?php
                            }
                            ?>

                        </h4>
                        <p><?php echo __('To customize your blog layouts,', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <a href="admin.php?page=layouts" target="_blank">' . __('Go to Layouts', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>. ' . __('In case of doubt,', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <a href="https://solwininfotech.com/documents/wordpress/blog-designer-pro/" target="_blank"> '. __('Read Documentation', BLOGDESIGNERPRO_TEXTDOMAIN) .' </a> ' . __('or create a support ticket on our', BLOGDESIGNERPRO_TEXTDOMAIN) .' <a href="http://support.solwininfotech.com/" target="_blank">'. __('support portal', BLOGDESIGNERPRO_TEXTDOMAIN) .'</a>.'?> </p>
                    </div>

                    <h3>
                        <?php _e('Getting Started', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> <span>(<?php _e('Must Read', BLOGDESIGNERPRO_TEXTDOMAIN); ?>)</span>
                    </h3>
                    <p><?php _e('Once you’ve activated your plugin, you’ll be redirected to a Getting Started page (Blog Designer > Getting Started). Here, you can view the required and helpful steps to use plugin.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>

                    <hr id="#bdp-important-things">
                    <h3>
                        <?php _e('Important things', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> <span>(<?php _e('Required', BLOGDESIGNERPRO_TEXTDOMAIN); ?>)</span> <a href="#bdp-important-things">#</a>
                        <a class="back-to-top" href="#bdp-help-file"><?php _e('Back to Top', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                    </h3>
                    <p><?php _e('To use Blog Designer, follow the below steps for initial setup - Correct the Reading Settings.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                    <ul>
                        <li><?php echo __('To check the reading settings, click', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b><a href="options-reading.php" target="_blank">' . __('Settings > Reading', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a></b> ' . __('in the WordPress admin menu.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('If your ', BLOGDESIGNERPRO_TEXTDOMAIN). '<b>' .__('Posts page', BLOGDESIGNERPRO_TEXTDOMAIN) .' </b> '. __(' selection selected with the same exact', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'.__('Blog Page', BLOGDESIGNERPRO_TEXTDOMAIN).'</b> '.  __('selection that same page you seleced under Blog Designer settings then change that selection to default one',BLOGDESIGNERPRO_TEXTDOMAIN) .' ( <b>" — '.__('Select', BLOGDESIGNERPRO_TEXTDOMAIN).' — "</b> '.  __(') from the dropdown.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                    </ul>

                    <hr id="bdp-shortcode-usage">
                    <h3>
                        <?php _e('How to use Blog Designer Shortcode?', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> <span>(<?php _e('Optional', BLOGDESIGNERPRO_TEXTDOMAIN); ?>)</span> <a href="#bdp-shortcode-usage">#</a>
                        <a class="back-to-top" href="#bdp-help-file"><?php _e('Back to Top', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                    </h3>
                    <p><?php _e('Blog Designer is flexible to be used with any page builders like Visual Composer, Elementor, Beaver Builder, SiteOrigin, Tailor, etc.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                    <ul>
                        <li><?php echo __('Use shortcode', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>[wp_blog_designer id="xx"]</b> ' . __('in any WordPress post or page.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('Use', BLOGDESIGNERPRO_TEXTDOMAIN) . '<b> &lt;&quest;php echo do_shortcode("[wp_blog_designer id="xx"]"); &nbsp;&quest;&gt; </b>' . __('into a template file within your theme files.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                    </ul>

                    <hr id="bdp-dummy-posts">
                    <h3>
                        <?php _e('Import Dummy Post', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> <span>(<?php _e('Optional', BLOGDESIGNERPRO_TEXTDOMAIN); ?>)</span> <a href="#bdp-dummy-posts">#</a>
                        <a class="back-to-top" href="#bdp-help-file"><?php _e('Back to Top', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                    </h3>
                    <p><?php _e('We have craeted a dummy set of posts for you to get started with Blog Designer PRO.', BLOGDESIGNERPRO_TEXTDOMAIN) ;?></p>
                    <p><?php _e('To import the dummy posts, follow the below process:', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                    <ul>
                        <li><?php echo __('Go to', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>' . __('Tools > Import', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> '. __('in WordPress Admin panel.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('Run ', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>' . __('WordPress Importer ', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> '. __(' at the end of the presentated list.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('You will be redirected on ', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>' . __('Import WordPress ', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> '. __(' where we need to select actual sample posts XML file.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('Select',BLOGDESIGNERPRO_TEXTDOMAIN) .' <b> import-sample_posts.xml </b> '. __('from',BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __('blog-designer-pro > admin > dummy-data', BLOGDESIGNERPRO_TEXTDOMAIN) .'</b> '.  __('folder.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php echo __('Click on', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>' . __('Upload file and import', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('and with next step please select',BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __('Download and import file attachments', BLOGDESIGNERPRO_TEXTDOMAIN) .'</b> '.  __('checkbox. Enjoy your cuppa joe with WordPress imports.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                        <li><?php _e('All done! Your website is ready with sample blog posts.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></li>
                    </ul>
                </div>
                <div class="bd-panel-right">
                    <h3><?php _e('Other Premium Plugins', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                    <div class="panel-aside">
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/'); ?>" target="_blank">
                            <img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2015/10/avartan-responsive-slider.png" alt="<?php _e('Avartan Slider', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        </a>
                        <div class="panel-club-inside">
                            <p><?php echo '<b>' . __('Avartan Slider', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('is a responsive WordPress plugin to create stunning image slider and video slider for your WordPress website. It has unique features like drag and drop visual slider builder, multi-media content, etc.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/avartan-slider/'); ?>" target="_blank"><?php _e('Read More', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                        </div>
                    </div>
                    <div class="panel-aside">
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/portfolio-designer/'); ?>" target="_blank">
                            <img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2017/02/Portfolio-Designer-WordPress-Plugin.png" alt="<?php _e('Portfolio Designer', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        </a>
                        <div class="panel-club-inside">
                            <p><?php echo '<b>' . __('Portfolio Designer', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('is a WordPress plugin used to build portfolio in any desired layout. This plugin is user friendly, So no matter if you are a beginner, WordPress user, Designer or a Developer, no additional coding knowledge is required in creating portfolio layouts.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-plugins/portfolio-designer/'); ?>" target="_blank"><?php _e('Read More', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                        </div>
                    </div>

                    <h3><?php _e('Other Premium Themes', BLOGDESIGNERPRO_TEXTDOMAIN); ?></h3>
                    <div class="panel-aside">
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/kosmic/'); ?>" target="_blank">
                            <img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2016/07/Kosmic-Multipurpose-Responsive-WordPress-Theme.png" alt="<?php _e('Kosmic', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        </a>
                        <div class="panel-club-inside">
                            <p><?php echo '<b>' . __('Kosmic', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('is a multipurpose WordPress theme which is suitable for almost all types of websites. This eCommerce theme is very simple, clean and professional. It comes with an extensive theme options panel to customize your site easily as per your requirements.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/kosmic/'); ?>" target="_blank"><?php _e('Read More', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                        </div>
                    </div>
                    <div class="panel-aside">
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/foodfork/'); ?>" target="_blank">
                            <img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2016/06/FoodFork-Restaturant-WordPress-Theme.jpg" alt="<?php _e('FoodFork', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        </a>
                        <div class="panel-club-inside">
                            <p><?php echo '<b>' . __('FoodFork', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('is a premium WordPress theme for Restaurants and food business websites. You can use this theme for your business websites like restaurant, cafe, coffee shop, fast food or pizza store.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/foodfork/'); ?>" target="_blank"><?php _e('Read More', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                        </div>
                    </div>
                    <div class="panel-aside">
                        <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/jewelux/'); ?>" target="_blank">
                            <img src="https://solwincdn-79e1.kxcdn.com/wp-content/uploads/2016/02/JewelUX-WordPress-Premium-Theme.jpg" alt="<?php _e('JewelUX', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                        </a>
                        <div class="panel-club-inside">
                            <p><?php echo '<b>' . __('JewelUX', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('is a clean and modern jewelry WordPress theme designed for any online jewelry website. It’s a WooCommerce theme with responsive layout, fully widgetized and animated home page.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                            <a href="<?php echo esc_url('https://www.solwininfotech.com/product/wordpress-themes/jewelux/'); ?>" target="_blank"><?php _e('Read More', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php
            if ($active_tab == 'register_product') :
                global $wp_version, $wpdb, $bdp_errors, $bdp_success, $bdp_settings;
                $return = '';
                if (isset($_POST['bdp_sbt_purchasecode'])) {
                    $sol_username = $_POST['sol_username'];
                    $purchase_code = $_POST['sol_purchase_code'];
                    $return = $bdp_wp_auto_update->update_license(trim($sol_username), trim($purchase_code));
                }
                if (isset($_POST['bdp_deregister_purchasecode'])) {
                    $sol_username = $_POST['sol_username'];
                    $purchase_code = $_POST['sol_purchase_code'];
                    $return = $bdp_wp_auto_update->deregister_site(trim($sol_username), trim($purchase_code));
                }
                $sol_username = get_option('bdp_username');
                $purchase_code = get_option('bdp_purchase_code');
                $page = '';
                if (isset($_GET['page']) && $_GET['page'] != '') {
                    $page = $_GET['page'];
                }

                $bdp_information = $bdp_wp_auto_update->getRemote_information();

                ?>
                <div id="bdp-register-product" class="bdp-register-product" >
                    <?php if ($return == 'correct') { ?>
                        <div class="bdp-updated bdp-notice">
                            <p><?php _e('License updated successfully.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                    <?php } else if ($return == 'used') {
                        ?>
                        <div class="bdp-error bdp-notice">
                            <p><?php _e('License Key already used.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <?php
                    } else if ($return == 'incorrect') {
                        ?>
                        <div class="bdp-error bdp-notice">
                            <p><?php _e('Wrong license key.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <?php
                    } else if ($return == 'unsuccess') {
                        ?>
                        <div class="bdp-error bdp-notice">
                            <p><?php _e('Site is not registered with this license key.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <?php
                    } else if ($return == 'success') {
                        ?>
                        <div class="bdp-updated bdp-notice">
                            <p><?php _e('Site has been De-Registered successfully.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <?php
                    }
                    ?>
                    <h3>
                        <?php _e('Register your plugin copy', BLOGDESIGNERPRO_TEXTDOMAIN) ;?>
                    </h3>
                    <p><?php _e('Verify your codecanyon item purchase key to get automatic updates, notifications on your WordPress dashboard.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>

                    <form method="post" name="bdp_frm_purchasecode" id="bdp_frm_purchasecode">
                        <p>
                            <span class="bdp-lable"> <b><?php _e('Username', BLOGDESIGNERPRO_TEXTDOMAIN); ?> : </b> </span>
                            <input value="<?php echo $sol_username; ?>" required="" type="text" name="sol_username" id="sol_username" />
                            <i><small><?php _e('Username will be your registered username with ', BLOGDESIGNERPRO_TEXTDOMAIN); ?><a target="blank" href="https://codecanyon.net/"><?php _e('codecanyon', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a></small></i>
                        </p>
                        <p>
                            <span class="bdp-lable"> <b><?php _e('License Key', BLOGDESIGNERPRO_TEXTDOMAIN); ?> : </b> </span>
                            <input value="<?php echo $purchase_code; ?>" required="" type="password" name="sol_purchase_code" id="sol_purchase_code" />
                            <i><small><a target="blank" href="<?php echo esc_url('https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code'); ?>"> <?php _e('Click here', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </a> <?php _e('to know how to get item purchase code.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></small></i>
                        </p>
                        <p>
                            <input class="bdp-btn-success" type="submit" value="<?php echo ($sol_username != '') ? __('Update License', BLOGDESIGNERPRO_TEXTDOMAIN) : __('Verify License', BLOGDESIGNERPRO_TEXTDOMAIN) ;?>" name="bdp_sbt_purchasecode" />
                            <?php if ($sol_username != '') { ?>
                            <input class="bdp-btn-error" type="submit" value="<?php echo __('De-Register Site', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" name="bdp_deregister_purchasecode" />
                        <?php } ?>
                        </p>
                    </form>
                </div>

                <?php
            endif;
            ?>

            <?php if ($active_tab == 'support') : ?>
                <div id="bdp-support" class="bdp-support">
                    <div class="bdp-line-cover">
                        <div class="bdp-line-content">
                            <h3>
                                <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/');?>" target="_blank"><?php _e('Documentation', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> </a>
                            </h3>
                            <p><?php _e('Read helpful resources regarding how to use The Blog Designer Plugin more efficiently.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <div class="bdp-line-button">
                            <p> <a class="button button-primary bdp-button" href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/');?>" target="_blank"><?php _e('Read Documentation', BLOGDESIGNERPRO_TEXTDOMAIN);?></a> </p>
                        </div>
                    </div>
                    <hr/>
                    <div class="bdp-line-cover">
                        <div class="bdp-line-content">
                            <h3>
                                <a href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#faq');?>" target="_blank"><?php _e('FAQ', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> </a>
                            </h3>
                            <p><?php _e('The most frequently asked questions are answered here.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <div class="bdp-line-button">
                            <p> <a class="button button-primary bdp-button" href="<?php echo esc_url('https://www.solwininfotech.com/documents/wordpress/blog-designer-pro/#faq');?>" target="_blank"><?php _e('Read FAQ', BLOGDESIGNERPRO_TEXTDOMAIN);?></a> </p>
                        </div>
                    </div>

                    <hr/>
                    <div class="bdp-line-cover">
                        <div class="bdp-line-content">
                            <h3>
                                <a href="<?php echo esc_url('http://support.solwininfotech.com/');?>" target="_blank"><?php _e('Ask our experts', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> </a>
                            </h3>
                            <p><?php _e('Any question that is not addressed on documentations? Ask it from Solwin Infotech experts. Note that you need to share your codecanyon license key to be able to get premium support.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <div class="bdp-line-button">
                            <p> <a class="button button-primary bdp-button" href="<?php echo esc_url('http://support.solwininfotech.com/');?>" target="_blank" ><?php _e('Submit a Ticket', BLOGDESIGNERPRO_TEXTDOMAIN);?></a> </p>
                        </div>
                    </div>
                    <hr/>
                    <div class="bdp-line-cover">
                        <div class="bdp-line-content">
                            <h3>
                                <a href="<?php echo esc_url('https://www.solwininfotech.com/contact-us/');?>" target="_blank"><?php _e('Customize The Plugin', BLOGDESIGNERPRO_TEXTDOMAIN) ;?> </a>
                            </h3>
                            <p><?php _e('Have some more customization beyond what The Blog Designer PRO offers? Solwin Infotech experts are here to help.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                        </div>
                        <div class="bdp-line-button">
                            <p> <a class="button button-primary bdp-button" href="<?php echo esc_url('https://www.solwininfotech.com/contact-us/');?>" target="_blank"><?php _e('Hire Us', BLOGDESIGNERPRO_TEXTDOMAIN);?></a> </p>
                        </div>
                    </div>
                    <hr/>
                </div>
            <?php endif; ?>

            <?php if ($active_tab == 'tools') : ?>
                <div id="bdp-tools" class="bdp-tools">
                    <div  class="bdp-tools-cover">
                        <?php
                        $blog_designer_setting = get_option("wp_blog_designer_settings");
                        if ($blog_designer_setting != '') {
                            ?>
                            <div class="bdp-line-cover">
                                <div class="bdp-line-content">
                                    <h3>
                                        <?php echo __('Create Blog Layout using Blog Designer (free plugin) Data', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                    </h3>
                                    <p> <?php echo __('Create your first Blog layout after switching from free to PRO version plugin. This action will use your Blog Designer (free version) Plugin data and create PRO version layout. This is a', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __('recommended', BLOGDESIGNERPRO_TEXTDOMAIN) .'</b> '. __('action if you have upgraded your plugin from lite to PRO.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                                </div>
                                <div class="bdp-line-button">
                                    <p> <a class="bdp-create-layout-using-blog-designer button button-secondary bdp-button" href="<?php echo esc_url(add_query_arg('create-layout-using-blog-designer', 'new', admin_url('admin.php?page=layouts'))) ;?>"> <?php echo __('Create Layout', BLOGDESIGNERPRO_TEXTDOMAIN) ;?></a> </p>
                                </div>
                            </div>
                            <hr/>
                            <?php
                        }
                        ?>


                        <div class="bdp-line-cover">
                            <div class="bdp-line-content">
                                <h3>
                                    <?php echo __('Create New Sample Blog layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </h3>
                                <p> <?php echo __('If you are newbie with Blog Designer PRO plugin and do not know from where to start and create your first blog layout with the site then this automatic stuff will help you to create your first blog layout via with', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'.__('One Click', BLOGDESIGNERPRO_TEXTDOMAIN).'</b> '. __('action.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                            </div>
                            <div class="bdp-line-button">
                                <p> <a class="bdp-create-layout button button-secondary bdp-button" href="<?php echo esc_url(add_query_arg('sample-blog-layout', 'new', admin_url('admin.php?page=layouts'))); ?>"> <?php echo __('Create Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </a> </p>
                            </div>
                        </div>
                        <hr/>

                        <div class="bdp-line-cover">
                            <div class="bdp-line-content">
                                <h3>
                                    <?php _e('Text Domain Change', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </h3>
                                <p> <?php echo __('Since Blog Designer PRO plugin version 2.0, we changed text-domain to "', BLOGDESIGNERPRO_TEXTDOMAIN) . '<i><u>' . __('blog-designer-pro', BLOGDESIGNERPRO_TEXTDOMAIN) . '</u></i>' . __('". If you are using translated .po/.mo file with Blog Designer PRO plugin for localization then kindly rename that file name to', BLOGDESIGNERPRO_TEXTDOMAIN) . ' <b>' . __('blog-designer-pro.po', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> & <b>' . __('blog-designer-pro.mo', BLOGDESIGNERPRO_TEXTDOMAIN) . '</b> ' . __('and update your .po file with latest .pot file that already available with plugin files.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                            </div>
                            <div class="bdp-line-button">
                                <p> <a class="button button-secondary bdp-button" href="<?php echo esc_url('http://support.solwininfotech.com/'); ?>" target="_blank"><?php _e('Contact Us', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a> </p>
                            </div>
                        </div>
                        <hr/>

                        <div class="bdp-line-cover">
                            <div class="bdp-line-content">
                                <h3>
                                    <?php _e('Template Name Update', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </h3>
                                <p> <?php echo __('Since Blog Designer PRO plugin version 1.5, we changed template name with', BLOGDESIGNERPRO_TEXTDOMAIN) .' <b>'. __("Classical to 'Nicy', Lightbreeze to 'Sharpen' and Spektrum to 'Hub'", BLOGDESIGNERPRO_TEXTDOMAIN) .'</b>. '. __('We need to update your layouts data according to the latest version.', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </p>
                            </div>
                            <div class="bdp-line-button">
                                <p>
                                    <?php
                                    $bdp_template_name_changed = get_option('bdp_template_name_changed', 1);
                                    if ($bdp_template_name_changed == 1) {
                                        ?>
                                        <a href="<?php echo esc_url(add_query_arg('do_update_bdp_template_name_changed', 'do', $_SERVER['REQUEST_URI'])); ?>" class="bdp-template-chnage-now button button-primary">
                                            <?php _e('Run the updater', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </a>
                                        <?php
                                    } else {
                                        ?><a class="button button-secondary bdp-button" href="<?php echo esc_url('http://support.solwininfotech.com/'); ?>" target="_blank"><?php _e('Contact Us', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a><?php
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        <hr/>

                        <div class="bdp-line-cover single_file_override">
                            <?php

                            $template_name = BLOGDESIGNERPRO_DIR . 'bdp_templates/single/single.php';
                            $template = 'single/single.php';
                            $template_file = apply_filters('bdp_locate_core_template', $template_name, $template);
                            $local_file = bdp_get_theme_template_file($template);
                            $template_dir = apply_filters('bdp_template_directory', 'bdp_templates', $template);

                            ?>
                            <div class="bdp-line-content">
                                <h3>
                                    <?php _e('Single file Override ', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </h3>
                                <p>
                                    <?php
                                    if (file_exists($local_file)) {
                                        _e('This template has been overridden by your theme and can be found in', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo ': <code>'.trailingslashit(basename(get_stylesheet_directory())) . $template_dir . '/' . $template.'</code>.';
                                    } elseif (file_exists($template_name)) {
                                        _e('To override or edit single template file according to your active theme requirements then please copy this file', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo ' "<code>' . plugin_basename($template_name) . '</code>" ';
                                        _e('and paste into your active theme folder with this location', BLOGDESIGNERPRO_TEXTDOMAIN);
                                        echo ' <code>' . trailingslashit(basename(get_stylesheet_directory())) . $template_dir . '/' . $template . '</code>.';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="bdp-line-button">
                                <p>
                                    <a class="button single_toggle_editor bdp-button" href="#"><?php _e('Hide template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                                </p>
                                <?php
                                if (file_exists($local_file)) {
                                    if (is_writable($local_file)) {
                                        ?>
                                        <p>
                                            <a href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('move_template', 'saved'), add_query_arg('delete_template', $template)), 'bdp_single_template_nonce', '_bdp_single_nonce')); ?>" class="delete_template button bdp-button"><?php _e('Delete template file', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                                        </p>
                                        <?php
                                    }
                                }  elseif (file_exists($template_name)) {
                                    if (( is_dir(get_stylesheet_directory() . '/' . $template_dir . '/') && is_writable(get_stylesheet_directory() . '/' . $template_dir . '/') ) || is_writable(get_stylesheet_directory())) {
                                        ?>
                                        <p>
                                            <a href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('delete_template', 'saved'), add_query_arg('move_template', $template)), 'bdp_single_template_nonce', '_bdp_single_nonce')); ?>" class="button bdp-button"><?php _e('Copy file to theme', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                                        </p>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                            <div class="single_file_editor">
                                <form Id="" method="post">
                                <?php wp_nonce_field('bdp-singlefile-form-submit', 'bdp-singlefile-submit-nonce'); ?>
                                <?php
                                if (file_exists($local_file)) {
                                    ?>
                                    <p>
                                        <textarea class="code" cols="25" rows="20" <?php if (!is_writable($local_file)) : ?>readonly="readonly" disabled="disabled"<?php else : ?> name="singlefile_html"<?php endif; ?>><?php echo file_get_contents($local_file); ?></textarea>
                                    </p>
                                    <p>
                                        <input type="submit" style="" class="button-primary single_file_savebtn" name="savedata" value="<?php esc_attr_e('Save Changes', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" />
                                    </p>
                                        <?php
                                } else {
                                    ?>
                                    <p>
                                        <textarea class="code" readonly="readonly" disabled="disabled" cols="25" rows="20"><?php echo file_get_contents($template_name); ?></textarea>
                                    </p>
                                    <?php
                                }
                                ?>
                                </form>
                            </div>
                        </div>

                        <?php

                        bdp_enqueue_js("
                            var view = '" . esc_js(__('View template', BLOGDESIGNERPRO_TEXTDOMAIN)) . "';
                            var hide = '" . esc_js(__('Hide template', BLOGDESIGNERPRO_TEXTDOMAIN)) . "';

                            jQuery( 'a.single_toggle_editor' ).text( view ).toggle( function() {
                                    jQuery( this ).text( hide ).closest( '.bdp-line-cover' ).find( '.single_file_editor' ).slideToggle( 'slow' );
                                    return false;
                            }, function() {
                                    jQuery( this ).text( view ).closest( '.bdp-line-cover' ).find( '.single_file_editor' ).slideToggle( 'slow' );
                                    return false;
                            } );

                            jQuery( 'a.delete_template' ).click( function() {
                                    if ( window.confirm('" . esc_js(__('Are you sure you want to delete this template file?', BLOGDESIGNERPRO_TEXTDOMAIN)) . "') ) {
                                            return true;
                                    }

                                    return false;
                            });

                        ");


                        $bdp_single_override_template_dir = get_stylesheet_directory() . '/bdp_templates/single/';
                        $bdp_archive_override_template_dir = get_stylesheet_directory() . '/bdp_templates/archive/';
                        $bdp_blog_override_template_dir = get_stylesheet_directory() . '/bdp_templates/blog/';
                        if(is_dir($bdp_blog_override_template_dir) || is_dir($bdp_archive_override_template_dir) || is_dir($bdp_single_override_template_dir)) {
                            $bdp_single_override_templates_layouts = (is_dir($bdp_single_override_template_dir)) ? scandir($bdp_single_override_template_dir) : 1;
                            $bdp_archive_override_templates_layouts = (is_dir($bdp_archive_override_template_dir)) ? scandir($bdp_archive_override_template_dir) : 1;
                            $bdp_blog_override_templates_layouts = (is_dir($bdp_blog_override_template_dir)) ? scandir($bdp_blog_override_template_dir) : 1;
                            if(count($bdp_single_override_templates_layouts) > 2 || count($bdp_archive_override_templates_layouts) > 2 || count($bdp_blog_override_templates_layouts) > 2) {
                                ?>
                                <hr/>
                                <div class="bdp-line-cover">
                                    <div class="bdp-line-content">
                                        <h3>
                                            <?php _e('Your Theme is not compatible or contains outdated copies of some Blog Designer template files.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                        </h3>
                                        <p><?php echo __('These files may require to design your "Post Layouts" with the current version of Blog Designer PRO plugin. You can see which files are required or outdated from the theme.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></p>
                                    </div>
                                    <div class="bdp-line-button">
                                        <p> <a class="button button-secondary bdp-button" href="<?php echo esc_url(admin_url('admin.php?page=bdp_getting_started&tab=system_status#bdp_templates_status')); ?>" ><?php _e('Check Here', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a> </p>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($active_tab == 'recomended_plugins') : ?>
                <div id="bdp-recomended-plugins" class="bdp-recomended-plugins">
                    <?php
                    include_once('class-plugin-installer.php');
                    if(class_exists('Blog_Designer_PRO_Plugin_Installer')) {
                        $free_plugins = array(
                                array(
                                        'slug' => 'regenerate-thumbnails',
                                ),
                                array(
                                        'slug' => 'wordpress-seo',
                                ),
                        );
                        echo '<div class="bdp-plugin-status-cover">';
                        Blog_Designer_PRO_Plugin_Installer::init( $free_plugins );
                        echo '</div>';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($active_tab == 'system_status') : global $wpdb;?>
            <div  class="bdp-system-status-cover bdp-admin">
                <div id="bdp_wp_status_report">
                    <span class="bdp-get-system-status">
                        <span class="bdp-system-report-msg"><?php _e('Click the button to produce a report, then copy and paste into your support ticket.', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                        <a href="#" class="button-primary bdp-debug-status-report bdp-button"><?php _e('Get System Report', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                    </span>
                    <div id="bdp-debug-report">
                        <textarea id="bdp-copy-text" readonly="readonly"></textarea>
                        <p class="submit">
                            <button id="bdp-copy-for-support" class="button button-primary bdp-button" data-clipboard-target="#bdp-copy-text" href="#" data-tip="<?php _e('Copied!', BLOGDESIGNERPRO_TEXTDOMAIN); ?>"><?php _e('Copy for Support', BLOGDESIGNERPRO_TEXTDOMAIN); ?></button>
                        </p>
                    </div>
                </div>
                <br/> <hr/> <br/>

                <div class="bdp-status-cover" id="bdp_wp_status">
                    <div class="bdp-status-head" data-export-label="WordPress Environment">
                        <?php _e('WordPress Environment', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </div>
                    <div class="bdp-status-contents">
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Home URL">
                                <?php _e('Home URL:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value">
                                <?php form_option('home'); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Site URL">
                                <?php _e('Site URL:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value">
                                <?php form_option('siteurl'); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="WP Version">
                                <?php _e('WP Version:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value">
                                <?php bloginfo('version'); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="WP Memory Limit">
                                <?php _e('WP Memory Limit:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value">
                                <?php
                                $memory = bdp_let_to_num(WP_MEMORY_LIMIT);

                                if (function_exists('memory_get_usage')) {
                                    $system_memory = bdp_let_to_num(@ini_get('memory_limit'));
                                    $memory = max($memory, $system_memory);
                                }
                                echo '<mark class="yes">' . size_format($memory) . '</mark>';
                                ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="WP Multisite">
                                <?php _e('WP Multisite:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" data-export-label="<?php echo (is_multisite()) ? 'YES' : 'NO'; ?>">
                                <?php echo (is_multisite()) ? '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>' : '<mark class="error"> <span class="dashicons dashicons-no-alt"></span></mark>'; ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Language">
                                <?php _e('Language', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_html(get_locale()); ?>
                            </span>
                        </p>
                    </div>
                </div>

                <div class="bdp-status-cover" id="bdp_server_status">
                    <div class="bdp-status-head" data-export-label="Server Environment">
                        <?php _e('Server Environment', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </div>
                    <div class="bdp-status-contents">
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Server info">
                                <?php _e('Server info:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="PHP Version">
                                <?php _e('PHP Version:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php
                                if (function_exists('phpversion')) {
                                    $php_version = phpversion();
                                    if (version_compare($php_version, '5.6', '<')) {
                                        echo '<mark class="error"> <span class="dashicons dashicons-warning"></span>' . esc_html($php_version) . '</mark>' . __('We recommend a minimum PHP version of 5.6.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    } else {
                                        echo '<mark class="yes">' . esc_html($php_version) . '</mark>';
                                    }
                                } else {
                                    _e("Couldn't determine PHP version because", BLOGDESIGNERPRO_TEXTDOMAIN); echo " phpversion() "; _e("doesn't exist.", BLOGDESIGNERPRO_TEXTDOMAIN);
                                }
                                ?>
                            </span>
                        </p>
                        <?php
                        if ($wpdb->use_mysqli) {
                            $wpdb_ver = mysqli_get_server_info($wpdb->dbh);
                        } else {
                            $wpdb_ver = mysql_get_server_info();
                        }
                        if (!empty($wpdb->is_mysql) && !stristr($wpdb_ver, 'MariaDB')) :
                            ?>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="MySQL Version">
                                    <?php _e('MySQL Version:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php
                                    $mysql_version = $wpdb->db_version();
                                    if (version_compare($mysql_version, '5.5', '<')) {
                                        echo '<mark class="error"> <span class="dashicons dashicons-warning"></span>' . esc_html($mysql_version) . '</mark>' . __('We recommend a minimum MySQL version of 5.5.', BLOGDESIGNERPRO_TEXTDOMAIN);
                                    } else {
                                        echo '<mark class="yes">' . esc_html($mysql_version) . '</mark>';
                                    }
                                    ?>
                                </span>
                            </p>
                            <?php
                        endif;

                        if (function_exists('ini_get')) :
                            ?>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="PHP Post Max Size">
                                    <?php _e('PHP Post Max Size:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo size_format(bdp_let_to_num(ini_get('post_max_size'))); ?>
                                </span>
                            </p>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="PHP Time Limit">
                                    <?php _e('PHP Time Limit:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo esc_html(ini_get('max_execution_time')); ?>
                                </span>
                            </p>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="PHP Max Input Vars">
                                    <?php _e('PHP Max Input Vars:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo esc_html(ini_get('max_input_vars')); ?>
                                </span>
                            </p>
                            <?php
                        endif;
                        ?>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Max Upload Size">
                                <?php _e('Max Upload Size:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_html(size_format(wp_max_upload_size())); ?>
                            </span>
                        </p>
                    </div>
                </div>

                <?php $active_plugins_data = bdp_get_active_plugins(); ?>
                <div class="bdp-status-cover" id="bdp_plugins_status">
                    <div class="bdp-status-head" data-export-label="Active Plugins">
                        <?php echo __('Active Plugins', BLOGDESIGNERPRO_TEXTDOMAIN) . ' (' . count($active_plugins_data) . ')'; ?>
                    </div>
                    <div class="bdp-status-contents">
                        <?php
                        foreach ($active_plugins_data as $active_plugin) {
                            if (!empty($active_plugin['name'])) {
                                $plugin_name = esc_html($active_plugin['name']);
                                if (!empty($active_plugin['url'])) {
                                    $plugin_name = '<a href="' . esc_url($active_plugin['url']) . '" aria-label="' . esc_attr__('Visit plugin homepage', BLOGDESIGNERPRO_TEXTDOMAIN) . '" target="_blank">' . $plugin_name . '</a>';
                                }
                                $author_name = $active_plugin['author_name'];
                                if (!empty($active_plugin['author_url'])) {
                                    $author_name = '<a href="' . esc_url($active_plugin['author_url']) . '" aria-label="' . esc_attr__('Visit plugin Author Page', BLOGDESIGNERPRO_TEXTDOMAIN) . '" target="_blank">' . $author_name . '</a>';
                                }
                                ?>
                                <p>
                                    <span class="bdp-staus-lable" data-export-label="<?php echo $active_plugin['name']; ?>">
                                        <?php echo $plugin_name; ?>
                                    </span>
                                    <span class="bdp-status-value" >
                                        <?php echo __('by', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $author_name . ' - ' . $active_plugin['version']; ?>
                                    </span>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php $bdp_theme = bdp_get_theme_info(); ?>
                <div class="bdp-status-cover" id="bdp_theme_status">
                    <div class="bdp-status-head" data-export-label="Theme Info">
                        <?php _e('Theme Info', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </div>
                    <div class="bdp-status-contents">
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Name">
                                <?php _e('Name:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_html($bdp_theme['name']); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Version">
                                <?php _e('Version:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_html($bdp_theme['version']); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Author URL">
                                <?php _e('Author URL:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php echo esc_url($bdp_theme['author_url']); ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Child theme">
                                <?php _e('Child theme:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" data-export-label="<?php echo ($bdp_theme['is_child_theme']) ? 'YES' : 'NO'; ?>">
                                <?php
                                if ($bdp_theme['is_child_theme']) {
                                    echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
                                } else {
                                    echo '<mark class="error"> <span class="dashicons dashicons-no-alt"></span></mark> - ';
                                    echo __('If you are modifying Blog Designer PRO on a parent theme that you did not build personally we recommend using a child theme.', BLOGDESIGNERPRO_TEXTDOMAIN) . '<br/>';
                                    echo __('See:', BLOGDESIGNERPRO_TEXTDOMAIN) . '<a href="' . esc_url('https://codex.wordpress.org/Child_Themes/') . '" target="_blank"> ' . __('How to create a child theme', BLOGDESIGNERPRO_TEXTDOMAIN) . '</a>';
                                }
                                ?>
                            </span>
                        </p>
                        <?php if ($bdp_theme['is_child_theme']) : ?>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="Parent Theme Name">
                                    <?php _e('Parent Theme Name:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo esc_html($bdp_theme['parent_name']); ?>
                                </span>
                            </p>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="Parent Theme Version">
                                    <?php _e('Parent Theme Version:', BLOGDESIGNERPRO_TEXTDOMAIN);?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo esc_html($bdp_theme['parent_version']); ?>
                                </span>
                            </p>
                            <p>
                                <span class="bdp-staus-lable" data-export-label="Parent Theme Author URL">
                                    <?php _e('Parent Theme Author URL:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                </span>
                                <span class="bdp-status-value" >
                                    <?php echo esc_url($bdp_theme['parent_author_url']); ?>
                                </span>
                            </p>
                        <?php endif ?>
                    </div>
                </div>

                <div class="bdp-status-cover" id="bdp_templates_status">
                    <div class="bdp-status-head" data-export-label="Templates Status">
                        <?php _e('Templates Status', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                    </div>
                    <div class="bdp-status-contents">
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Blog Template">
                                <?php _e('Blog Template:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php
                                $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/blog/';
                                $bdp_override_template_dir = get_stylesheet_directory() . '/bdp_templates/blog/';
                                if (is_dir($bdp_override_template_dir)) {
                                    $bdp_override_templates_layouts = scandir($bdp_override_template_dir);
                                    if(count($bdp_override_templates_layouts) > 2) {
                                        foreach ($bdp_override_templates_layouts as $key => $value) {
                                            if ($value != '.' && $value != '..') {
                                                $bdp_core_template = $bdp_core_template_dir . $value;
                                                if (!file_exists($bdp_core_template)) {
                                                    $bdp_outdated = false;
                                                    continue;
                                                }
                                                $core_version = bdp_check_file_version($bdp_core_template_dir . $value);
                                                $bdp_override_template = $bdp_override_template_dir . $value;
                                                $templates_path = str_replace(WP_CONTENT_DIR . '/themes/', '', $bdp_override_template);
                                                $template_version = bdp_check_file_version($bdp_override_template);
                                                if ($core_version > $template_version) {
                                                    $template_version = '<mark class="error">' . bdp_check_file_version($bdp_override_template) . '</mark>';
                                                    echo '~ <mark class="outdated">' . $templates_path . '</mark> ' . __('version', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $template_version . ' ' . __('is out of date. The core version is', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $core_version . ' <br/>';
                                                } else {
                                                    echo '~ bdp_templates/' . $value . '<br/>';
                                                }
                                            }
                                        }
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Archive Template">
                                <?php _e('Archive Template:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php
                                $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/archive/';
                                $bdp_override_template_dir = get_stylesheet_directory() . '/bdp_templates/archive/';
                                if (is_dir($bdp_override_template_dir)) {
                                    $bdp_override_templates_layouts = scandir($bdp_override_template_dir);
                                    if(count($bdp_override_templates_layouts) > 2) {
                                        foreach ($bdp_override_templates_layouts as $key => $value) {
                                            if ($value != '.' && $value != '..') {
                                                $bdp_core_template = $bdp_core_template_dir . $value;
                                                if (!file_exists($bdp_core_template)) {
                                                    $bdp_outdated = false;
                                                    continue;
                                                }
                                                $core_version = bdp_check_file_version($bdp_core_template_dir . $value);
                                                $bdp_override_template = $bdp_override_template_dir . $value;
                                                $template_version = bdp_check_file_version($bdp_override_template);
                                                $templates_path = str_replace(WP_CONTENT_DIR . '/themes/', '', $bdp_override_template);
                                                if ($core_version > $template_version) {
                                                    $template_version = '<mark class="error">' . bdp_check_file_version($bdp_override_template) . '</mark>';
                                                    echo '~ <mark class="outdated">' . $templates_path . '</mark> ' . __('version', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $template_version . ' ' . __('is out of date. The core version is', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $core_version . ' <br/>';
                                                } else {
                                                    echo '~ ' . $templates_path . '<br/>';
                                                }
                                            }
                                        }
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                        </p>
                        <p>
                            <span class="bdp-staus-lable" data-export-label="Single Template">
                                <?php _e('Single Template:', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                            </span>
                            <span class="bdp-status-value" >
                                <?php
                                $bdp_core_template_dir = BLOGDESIGNERPRO_DIR . 'bdp_templates/single/';
                                $bdp_override_template_dir = get_stylesheet_directory() . '/bdp_templates/single/';
                                if (is_dir($bdp_override_template_dir)) {
                                    $bdp_override_templates_layouts = scandir($bdp_override_template_dir);
                                    if(count($bdp_override_templates_layouts) > 2) {
                                        foreach ($bdp_override_templates_layouts as $key => $value) {
                                            if ($value != '.' && $value != '..') {
                                                $bdp_core_template = $bdp_core_template_dir . $value;
                                                if (!file_exists($bdp_core_template)) {
                                                    $bdp_outdated = false;
                                                    continue;
                                                }
                                                $core_version = bdp_check_file_version($bdp_core_template_dir . $value);
                                                $bdp_override_template = $bdp_override_template_dir . $value;
                                                $template_version = bdp_check_file_version($bdp_override_template);
                                                $templates_path = str_replace(WP_CONTENT_DIR . '/themes/', '', $bdp_override_template);
                                                if ($core_version > $template_version) {
                                                    $template_version = '<mark class="error">' . bdp_check_file_version($bdp_override_template) . '</mark>';
                                                    echo '~ <mark class="outdated">' . $templates_path . '</mark> ' . __('version', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $template_version . ' ' . __('is out of date. The core version is', BLOGDESIGNERPRO_TEXTDOMAIN) . ' ' . $core_version . ' <br/>';
                                                } else {
                                                    echo '~ ' . $templates_path . ' <br/>';
                                                }
                                            }
                                        }
                                    } else {
                                        echo '-';
                                    }
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <?php if ($active_tab == 'register_product') : ?>
        <div class="bdp-updatestory">
            <div class="bdp-info-heading bdp-panel-header">
                <h3><span class="dashicons dashicons-image-rotate"> </span> <?php _e('Update History', BLOGDESIGNERPRO_TEXTDOMAIN); ?> </h3>
            </div>
            <div class="bdp-panel-body">
                <div class="changelog-cover">
                    <?php echo $bdp_information->sections['changelog'];?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
