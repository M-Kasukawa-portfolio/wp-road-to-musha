<?php
/**
 * <title>タグを出力する
 */
add_theme_support('title-tag');

/**
 * タイトルの区切り文字を変更する
 */
add_filter('document_title_separator', "my_document_title_separator");
function my_document_title_separator($separator)
{
	$separator = '|';
	return $separator;
}

/**
 * アイキャッチ画像を使用する
 */
add_theme_support('post-thumbnails');

/**
 * カスタムメニューを使用する
 */
add_theme_support('menus');

/**
 * 管理画面におすすめ記事のチェックボックスを作る
 */
add_filter('manage_posts_columns', 'add_recommend_column');
function add_recommend_column($columns) {
    $columns['recommend'] = 'おすすめ記事';
    return $columns;
}

add_action('manage_posts_custom_column', 'show_recommend_column', 10, 2);
function show_recommend_column($column, $post_id) {
    if ($column == 'recommend') {
        $is_recommend = get_field('recommend_post', $post_id);
        if ($is_recommend == '1') {
            // チェックありの場合
            echo '<input type="checkbox" id="recommend-' . $post_id . '" checked>';
        } else {
            // チェックなしの場合
						echo '<input type="checkbox" id="recommend-' . $post_id . '">';
        }
    }
}

//おすすめ記事のチェックボックスを更新する
add_action('wp_ajax_update_recommend', 'update_recommend_ajax');
function update_recommend_ajax() {
    $post_id = $_POST['post_id'];
    $checked = $_POST['checked'];
    
    // ACFのフィールドを更新
    update_field('recommend_post', $checked, $post_id);
    
    wp_die(); // Ajax処理の終了
}

// 投稿編集画面でおすすめ記事フィールドグループ全体を非表示
function hide_recommend_field_in_edit() {
    global $pagenow;
    if ($pagenow == 'post.php' || $pagenow == 'post-new.php') {
        ?>
        <style>
        .acf-postbox[data-id*="recommend"] {
            display: none !important;
        }
        /* または、より確実に */
        .postbox .acf-field[data-name="recommend_post"] {
            display: none !important;
        }
        .postbox:has(.acf-field[data-name="recommend_post"]) {
            display: none !important;
        }
        </style>
        <?php
    }
}
add_action('admin_head', 'hide_recommend_field_in_edit');

// 管理画面にJavaScriptを読み込む
add_action('admin_footer', 'recommend_checkbox_script');
function recommend_checkbox_script() {
    global $pagenow;
    if ($pagenow == 'edit.php') { // 投稿一覧ページのみ
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('input[id^="recommend-"]').change(function() {
                var post_id = this.id.replace('recommend-', '');
                var checked = this.checked ? '1' : '0';
                
                $.post(ajaxurl, {
                    action: 'update_recommend',
                    post_id: post_id,
                    checked: checked
                });
            });
        });
        </script>
        <?php
    }
}

/**
 * カテゴリー編集フォームにカラーフィールドを追加
 */
//管理画面にカラーピッカーを追加

add_action('category_edit_form_fields', 'add_category_color_field');
function add_category_color_field($term) {
    $color = get_term_meta($term->term_id, 'category_color', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="category_color">カテゴリーカラー</label></th>
        <td>
            <input type="color" name="category_color" id="category_color" value="<?php echo esc_attr($color); ?>" />
            <p class="description">このカテゴリの表示色を選択してください。</p>
        </td>
    </tr>
    <?php
}

// カテゴリー更新時に色を保存
add_action('edited_category', 'save_category_color');
function save_category_color($term_id) {
    if (isset($_POST['category_color'])) {
        update_term_meta($term_id, 'category_color', sanitize_hex_color($_POST['category_color']));
    }
}

// 動的カテゴリーCSS
function add_dynamic_category_css() {
	$categories = get_categories();
	echo '<style>';
	foreach ($categories as $category) {
			$color = get_term_meta($category->term_id, 'category_color', true);
			if ($color) {
					echo ".c-label--{$category->slug} { background-color: {$color} !important; }";
			}
	}
	echo '</style>';
}
add_action('wp_head', 'add_dynamic_category_css');


/**
 * 検索フォームでの検索結果表示から固定ページを除外 (検索キーワードが空欄の時に固定ページが表示されるのを防ぐ)
 */
function exclude_pages_from_search($query) {
	if ($query->is_search() && $query->is_main_query() && !is_admin()) {
			$query->set('post_type', 'post');
	}
}
add_action('pre_get_posts', 'exclude_pages_from_search');

/**
 * ページタイトル（title要素）のカスタマイズ
 */
function custom_document_title($title_parts) {
    if (is_search()) {
        $search_query = get_search_query();
        $title_parts['title'] = '『' . $search_query . '』の検索結果';
        
    } elseif (is_category()) {
        $category_name = single_cat_title('', false);
        $title_parts['title'] = '『' . $category_name . '』の記事一覧';
    }
    
    return $title_parts;
}
add_filter('document_title_parts', 'custom_document_title');


/**
 * コンタクトフォームの自動整形を無効化
 */
// Contact Form 7の自動整形を無効化
add_filter('wpcf7_autop_or_not', '__return_false');


/**
 * wp_nav_menu用のカスタムクラス機能
 */
function add_menu_list_item_class( $classes, $item, $args ) {
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'add_menu_list_item_class', 10, 3 );


/**
 *著者アーカイブが表示されないようにトップにリダイレクト
 */
function author_redirect() {
    // 現在のURL取得
    $current_url = $_SERVER['REQUEST_URI'];
    
    // 著者ページかどうかチェック
    if (is_author() || isset($_GET['author']) || strpos($current_url, '/author/') !== false) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'author_redirect');

/**
 *WPで構築されていることを隠す
 */
remove_action('wp_head', 'wp_generator');// WordPressのバージョン
remove_action('wp_head', 'wp_shortlink_wp_head');// 短縮URLのlink
remove_action('wp_head', 'wlwmanifest_link');// ブログエディターのマニフェストファイル
remove_action('wp_head', 'rsd_link');// 外部から編集するためのAPI
remove_action('wp_head', 'feed_links_extra', 3);// フィードへのリンク
remove_action('wp_head', 'print_emoji_detection_script', 7);// 絵文字に関するJavaScript
remove_action('wp_head', 'rel_canonical');// カノニカル
remove_action('wp_print_styles', 'print_emoji_styles');// 絵文字に関するCSS
remove_action('admin_print_scripts', 'print_emoji_detection_script');// 絵文字に関するJavaScript
remove_action('admin_print_styles', 'print_emoji_styles');// 絵文字に関するCSS
