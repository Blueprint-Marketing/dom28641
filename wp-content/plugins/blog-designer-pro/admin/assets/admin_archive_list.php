<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $wpdb;
$paged = filter_input(INPUT_GET, 'paged') ? absint(filter_input(INPUT_GET, 'paged')) : 1;
if (!is_numeric($paged))
    $paged = 1;
$limit = 10; // number of rows in page
$user = get_current_user_id();
$screen = get_current_screen();
$screen_option = $screen->get_option('per_page', 'option');
$limit = get_user_meta($user, $screen_option, true);
if (empty($limit) || $limit < 1) {
    // get the default value if none is set
    $limit = $screen->get_option('per_page', 'default');
}
$offset = ( $paged - 1 ) * $limit;

$where = '';
$search = '';
if (isset($_REQUEST['s']) && $_REQUEST['s'] != '') {
    $search = $_REQUEST['s'];
    $where = "WHERE archive_name LIKE '%$search%'";
}

if (isset($_POST['btnSearchArchive']) || ( isset($_POST['s']) && $_POST['s'] != '' )) {
    $delete_action = '';
    if (isset($_POST['take_action']) && isset($_POST['bdp-action-top']) || isset($_POST['take_action']) && isset($_POST['bdp-archive-action'])) {
        $delete_action = 'multiple_delete';
    }
    ?>
    <script type="text/javascript">
        var paged = '<?php echo $paged; ?>';
        var s = ['<?php echo $search; ?>'];
        var action = ['<?php echo $delete_action; ?>'];
        window.location = "?page=archive_layouts&paged=1&s=" + s + "&action=" + action;
    </script>
    <?php
}
$ord = 0;
if (isset($_REQUEST['orderby']) && $_REQUEST['order'] == 0) {
    $order_by = "desc";
    $ord = 1;
    $order_field = "archive_name";
} else if (isset($_REQUEST['orderby']) && $_REQUEST['order'] == 1) {
    $order_by = "asc";
    $ord = 0;
    $order_field = "archive_name";
} else {
    $order_by = "desc";
    $order_field = "id";
}

$condition = "";
$archive_table = $wpdb->prefix . 'bdp_archives';
if (isset($_GET['list'])) {
    if (isset($_REQUEST['s']) && $_REQUEST['s'] != '') {
        $condition = " or archive_template = '" . $_GET['list'] . "_template'";
    } else {
        $condition = " WHERE archive_template = '" . $_GET['list'] . "_template'";
    }
    if ($_GET['list'] == "all") {
        $condition = "";
    }
    $qry = "SELECT COUNT('id') FROM $archive_table" . $where . $condition;
    $total = $wpdb->get_var($qry);
    $num_of_pages = ceil($total / $limit);
} else {
    $total = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives ' . $where);
    $num_of_pages = ceil($total / $limit);
}

$next_page = (int) $paged + 1;

if ($next_page > $num_of_pages)
    $next_page = $num_of_pages;

$prev_page = (int) $paged - 1;

if ($prev_page < 1)
    $prev_page = 1;

//Get the archive information
if (isset($_GET['list'])) {
    if (isset($_REQUEST['s']) && $_REQUEST['s'] != '') {
        $condition = " or archive_template = '" . $_GET['list'] . "_template'";
    } else {
        $condition = " WHERE archive_template = '" . $_GET['list'] . "_template'";
    }
    if ($_GET['list'] == 'all') {
        $archives = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives ' . $where . ' order by ' . $order_field . ' ' . $order_by . ' limit ' . $offset . ', ' . $limit);
    } else {
        $archives = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives ' . $where . $condition . ' order by ' . $order_field . ' ' . $order_by . ' limit ' . $offset . ', ' . $limit);
    }
} else {
    $archives = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'bdp_archives ' . $where . ' order by ' . $order_field . ' ' . $order_by . ' limit ' . $offset . ', ' . $limit);
}
?>
<div class="bdp-admin wrap bdp-archive-list">
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['page']) && $_GET['page'] == 'archive_layouts' && wp_verify_nonce($_GET['_wpnonce'])) {
        ?>
        <div class="updated">
            <p>
                <?php
                _e('Archive layout deleted successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                ?>
            </p>
        </div>
        <?php
    }
    if (isset($_POST['bdp-action-top']) && esc_html($_POST['bdp-action-top']) == 'delete_pr' || isset($_POST['bdp-archive-action']) && esc_html($_POST['bdp-archive-action']) == 'delete_pr') {
        if (isset($_POST['chk_remove_all']) && !empty($_POST['chk_remove_all'])) {
            ?>
            <div class="updated">
                <p>
                    <?php _e('Archive layouts are deleted successfully.', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                </p>
            </div>
            <?php
        }
    }
    if (isset($_GET['msg']) || ( isset($_GET['action'])) && $_GET['action'] == 'multiple_delete') {
        ?>
        <div class="updated">
            <p>
                <?php
                if (isset($_GET['action']) && $_GET['action'] == 'multiple_delete') {
                    _e('Archive layouts are deleted successfully.', BLOGDESIGNERPRO_TEXTDOMAIN);
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 'added') {
                    _e('Designer Settings Added.', BLOGDESIGNERPRO_TEXTDOMAIN);
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 'updated') {
                    _e('Designer Settings updated.', BLOGDESIGNERPRO_TEXTDOMAIN);
                }
                ?>
            </p>
        </div>
    <?php }
    ?>
    <!-- Create new Archive Layout button -->
    <h1>
        <?php _e('Archive Layouts', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
        <a class="page-title-action" href="?page=bdp_add_archive_layout">
            <?php _e('Create New Archive Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
        </a>
    </h1>
    <form method="post">
        <ul class="subsubsub">
            <?php
            $total = ($total > 0) ? $total : '0';
            $currClass = "";
            $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "all") || (!isset($_GET['list']))) ? "current" : "";
            ?>
            <li class="all">
                <?php $allTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives '); ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=all"><?php _e('All', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $allTotal; ?>)</span></a> |
            </li>

            <li class="category">
                <?php
                $categoryTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "category_template"');
                $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "category")) ? "current" : "";
                ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=category"><?php _e('Category', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $categoryTotal; ?>)</span></a> |
            </li>
            <li class="tag">
                <?php
                $tagTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "tag_template"');
                $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "tag")) ? "current" : "";
                ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=tag"><?php _e('Tag', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $tagTotal; ?>)</span></a> |
            </li>
            <li class="author">
                <?php
                $authorTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "author_template"');
                $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "author")) ? "current" : "";
                ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=author"><?php _e('Author', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $authorTotal; ?>)</span></a> |
            </li>
            <li class="date">
                <?php
                $dateTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "date_template"');
                $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "date")) ? "current" : "";
                ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=date"><?php _e('Date', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $dateTotal; ?>)</span></a> |
            </li>
            <li>
                <?php
                $dateTotal = $wpdb->get_var('SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'bdp_archives WHERE archive_template = "search_template"');
                $currClass = ((isset($_GET['list'])) && ($_GET['list'] == "search")) ? "current" : "";
                ?>
                <a class="<?php echo $currClass; ?>" href="?page=archive_layouts&list=search"><?php _e('Search', BLOGDESIGNERPRO_TEXTDOMAIN); ?> <span class="count">(<?php echo $dateTotal; ?>)</span></a>
            </li>
        </ul>
        <p class="search-box">
            <input id="shortcode-search-input" type="search" value="<?php echo $search; ?>" name="s">
            <input id="search-submit" class="button" type="submit" name="btnSearchArchive" value="<?php esc_attr_e('Search Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">
        </p>
        <div class="tablenav top">
            <select name="bdp-action-top">
                <option selected="selected" value="none"><?php _e('Bulk Actions', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="delete_pr"><?php _e('Delete Permanently', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="bdp_export"><?php _e('Export Layout', BLOGDESIGNERPRO_TEXTDOMAIN) ?></option>
            </select>
            <input id="take_action" name="take_action" class="button action" type="submit" value="<?php esc_attr_e('Apply', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" >
            <div class="tablenav-pages" <?php
            if ((int) $num_of_pages <= 1) {
                echo 'style="display:none;"';
            }
            ?>>
                     <?php $list = isset($_GET['list']) ? "&list=" . $_GET['list'] : ""; ?>
                <span class="displaying-num"><?php echo number_format_i18n($total) . ' ' . sprintf(_n('item', 'items', $total), number_format_i18n($total)); ?></span>
                <span class="pagination-links">
                    <?php if ($paged == '1') { ?>
                        <span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
                        <span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
                    <?php } else { ?>
                        <a class="first-page" href="<?php echo '?page=archive_layouts' . $list . '&paged=1&s=' . $search; ?>" title="<?php esc_attr_e('Go to the first page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&laquo;</a>
                        <a class="prev-page" href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $prev_page . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the previous page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&lsaquo;</a>
                    <?php } ?>
                    <span class="paging-input">
                        <span class="total-pages"><?php echo $paged; ?></span>
                        <?php _e('of', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                        <span class="total-pages"><?php echo $num_of_pages; ?></span>
                    </span>
                    <?php if ($paged == $num_of_pages) { ?>
                        <span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
                        <span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
                    <?php } else { ?>
                        <a class="next-page " href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $next_page . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the next page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&rsaquo;</a>
                        <a class="last-page " href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $num_of_pages . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the last page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&raquo;</a>
                    <?php } ?>
                </span>
            </div>
        </div>
        <table class="wp-list-table widefat fixed striped bdp-sliders-list bdp-table bdp-sliders-list bdp-table">
            <?php
            $list = isset($_GET['list']) ? "&list=" . $_GET['list'] : "";
            $paging = isset($_GET['paged']) ? "&paged=" . $_GET['paged'] : "";
            ?>
            <thead>
                <tr>
                    <td class="manage-column check-column" id="cb"><input type="checkbox" name="delete-all-layouts-1" id="delete-all-layouts-1" value="0"></td>
                    <th class="manage-column column-archive_name column-title sorted <?php echo $order_by; ?>" scope="col" id="archive_name">
                        <a href="?page=archive_layouts<?php echo $list; ?>&orderby=archive_name&order=<?php echo $ord; ?>">
                            <span><?php _e('Archive Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></span>
                            <span class="sorting-indicator"></span>
                        </a>
                    </th>
                    <th class="manage-column column-archive_template" id="archive_template"><?php _e('Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></th>
                    <th class="manage-column column-template_name" id="template_name"><?php _e('Template Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></th>
                    <td class="manage-column column-categories"><?php _e('Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                    <td class="manage-column column-tags"><?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                </tr>
            </thead>
            <tbody id="the_list">
                <?php
                if (!$archives) {
                    echo '<tr>';
                    echo '<td colspan="5" style="text-align: center;">';
                    _e('No Archive layout found.', BLOGDESIGNERPRO_TEXTDOMAIN);
                    echo '</td>';
                    echo '</tr>';
                } else {
                    $archives_cnt = 0;
                    foreach ($archives as $archive) {
                        $allsettings = $archive->settings;
                        if (is_serialized($allsettings)) {
                            $bdp_settings = unserialize($allsettings);
                        }
                        $cat = '—';
                        $tag = '—';
                        if (isset($bdp_settings['template_tags']) && !empty($bdp_settings['template_tags']) && $archive->archive_template == "tag_template") {
                            $tags = $bdp_settings['template_tags'];
                            $tag = array();
                            foreach ($tags as $t) {
                                $tag_name = get_tag($t);
                                $tag[] = isset($tag_name->name) ? $tag_name->name : '';
                            }
                            $tag = join(', ', $tag);
                        }
                        if (isset($bdp_settings['template_category']) && !empty($bdp_settings['template_category']) && $archive->archive_template == "category_template") {
                            $categories = $bdp_settings['template_category'];
                            $cat = array();
                            foreach ($categories as $t) {
                                $cat[] = get_cat_name($t);
                            }
                            $cat = join(', ', $cat);
                        }
                        $archive_name = $archive->archive_name;
                        $archives_cnt++;

                        echo '<tr>';
                        ?>
                    <th class="check-column">
                        <input type="checkbox" class="chk_remove_all" name="chk_remove_all[]" id="chk_remove_all" value="<?php echo $archive->id; ?>">
                    </th>
                    <td class="title column-title">
                        <strong><a href="<?php echo '?page=bdp_add_archive_layout&action=edit&id=' . $archive->id; ?>"><?php
                                if (!empty($archive_name)) {
                                    echo stripslashes($archive_name);
                                } else {
                                    echo '(' . __('no title', BLOGDESIGNERPRO_TEXTDOMAIN) . ')';
                                }
                                ?></a></strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php esc_attr_e('Edit this item', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" href="<?php echo '?page=bdp_add_archive_layout&action=edit&id=' . $archive->id; ?>"><?php _e('Edit', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                                |
                            </span>
                            <span class="delete">
                                <?php
                                $list = isset($_GET['list']) ? "&list=" . $_GET['list'] : "";
                                $paging = isset($_GET['paged']) ? "&paged=" . $_GET['paged'] : "";
                                ?>
                                <a title="<?php esc_attr_e('Delete this item', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" href="<?php echo wp_nonce_url('?page=archive_layouts' . $list . $paging . '&action=delete&id=' . $archive->id); ?>" onclick="return confirm('Do you want to delete this layout?');"><?php _e('Delete', BLOGDESIGNERPRO_TEXTDOMAIN); ?></a>
                            </span>
                        </div>
                    </td>
                    <td class="column-archive-template"><?php
                        if (isset($archive->archive_template)) {
                            if ($archive->archive_template == "author_template") {
                                esc_attr_e('Author Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else if ($archive->archive_template == "category_template") {
                                esc_attr_e('Category Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else if ($archive->archive_template == "tag_template") {
                                esc_attr_e('Tag Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else if ($archive->archive_template == "date_template") {
                                esc_attr_e('Date Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                            } else if ($archive->archive_template == "search_template") {
                                esc_attr_e('Search Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN);
                            }
                        }
                        ?>
                    </td>
                    <td class="template_name column-template_name"><?php echo $bdp_settings['template_name']; ?></td>
                    <td class="categories column-categories"><?php echo $cat; ?></td>
                    <td class="tags column-tags"><?php echo $tag; ?></td>
                    <?php
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="manage-column check-column"><input type="checkbox" name="delete-all-shortcodes-2" id="delete-all-shortcodes-2" value="0"></td>
                    <td class="manage-column column-archive_name"><?php _e('Archive Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                    <th class="manage-column column-archive-template"><?php _e('Archive Template', BLOGDESIGNERPRO_TEXTDOMAIN); ?></th>
                    <th class="manage-column column-template_name" id="template_name"><?php _e('Template Name', BLOGDESIGNERPRO_TEXTDOMAIN); ?></th>
                    <td class="manage-column column-categories"><?php _e('Categories', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                    <td class="manage-column column-tags"><?php _e('Tags', BLOGDESIGNERPRO_TEXTDOMAIN); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="bottom-delete-form">
            <select name="bdp-archive-action">
                <option selected="selected" value="none"><?php _e('Bulk Actions', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="delete_pr"><?php _e('Delete Permanently', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
                <option value="bdp_export"><?php _e('Export Layout', BLOGDESIGNERPRO_TEXTDOMAIN); ?></option>
            </select>
            <input id="take_action" name="take_action" class="button action" type="submit" value="<?php esc_attr_e('Apply', BLOGDESIGNERPRO_TEXTDOMAIN); ?>" >
            <?php if ($archives) { ?>
                <div class="tablenav bottom">
                    <div class="tablenav-pages" <?php
                    if ((int) $num_of_pages <= 1) {
                        echo 'style="display:none;"';
                    }
                    ?>>
                             <?php $list = isset($_GET['list']) ? "&list=" . $_GET['list'] : ""; ?>
                        <span class="displaying-num"><?php echo number_format_i18n($total) . ' ' . sprintf(_n('item', 'items', $total), number_format_i18n($total)); ?></span>
                        <span class="pagination-links">
                            <?php if ($paged == '1') { ?>
                                <span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
                                <span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
                            <?php } else { ?>
                                <a class="first-page" href="<?php echo '?page=archive_layouts' . $list . '&paged=1&s=' . $search; ?>" title="<?php esc_attr_e('Go to the first page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&laquo;</a>
                                <a class="prev-page" href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $prev_page . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the previous page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&lsaquo;</a>
                            <?php } ?>
                            <span class="paging-input">
                                <span class="total-pages"><?php echo $paged; ?></span>
                                <?php _e('of', BLOGDESIGNERPRO_TEXTDOMAIN); ?>
                                <span class="total-pages"><?php echo $num_of_pages; ?></span>
                            </span>
                            <?php if ($paged == $num_of_pages) { ?>
                                <span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
                                <span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
                            <?php } else { ?>
                                <a class="next-page " href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $next_page . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the next page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&rsaquo;</a>
                                <a class="last-page " href="<?php echo '?page=archive_layouts' . $list . '&paged=' . $num_of_pages . '&s=' . $search; ?>" title="<?php esc_attr_e('Go to the last page', BLOGDESIGNERPRO_TEXTDOMAIN); ?>">&raquo;</a>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </form>
</div>
