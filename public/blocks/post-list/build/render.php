<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Attributes are available as $attributes array
// Map camelCase attributes to match the logic (or use direct access)

$per_page = isset($attributes['perPage']) ? $attributes['perPage'] : 6;
$order = isset($attributes['order']) ? $attributes['order'] : 'ASC';
$orderby = isset($attributes['orderby']) ? $attributes['orderby'] : 'date';
$offset = isset($attributes['offset']) ? $attributes['offset'] : 0;
$columns = isset($attributes['columns']) ? $attributes['columns'] : 3;
$col_gap = isset($attributes['itemColGap']) ? $attributes['itemColGap'] : '20px';
$row_gap = isset($attributes['itemRowGap']) ? $attributes['itemRowGap'] : '20px';
$style = isset($attributes['listStyle']) ? $attributes['listStyle'] : 'default';
$thumbnail_size = isset($attributes['thumbnailSize']) ? $attributes['thumbnailSize'] : 'large';
$is_featured = !empty($attributes['isFeatured']) ? true : false;
$pagination = !empty($attributes['pagination']) ? true : false;

// Styles attributes
$show_meta = !empty($attributes['showMeta']) ? true : false;
$allowed_metas = isset($attributes['allowedMetas']) ? $attributes['allowedMetas'] : [];
$meta_position = isset($attributes['metaPosition']) ? $attributes['metaPosition'] : 'below_title';
$title_tag = isset($attributes['titleTag']) ? $attributes['titleTag'] : 'h3';
$show_excerpt = !empty($attributes['showExcerpt']) ? 'yes' : 'no';
$show_read_more = !empty($attributes['showReadMore']) ? 'yes' : 'no';
$read_more_text = isset($attributes['readMoreText']) ? $attributes['readMoreText'] : 'Read More';
$read_more_icon = isset($attributes['readMoreIcon']) ? $attributes['readMoreIcon'] : 'none';
$read_more_icon_pos = isset($attributes['readMoreIconPosition']) ? $attributes['readMoreIconPosition'] : 'after';
$show_date_on_top = !empty($attributes['showDateOnTop']) ? 'yes' : 'no';
$title_trim = isset($attributes['titleTrim']) ? $attributes['titleTrim'] : 100;
$excerpt_trim = isset($attributes['excerptTrim']) ? $attributes['excerptTrim'] : 20;
$anim_style = isset($attributes['animStyle']) ? $attributes['animStyle'] : '';
$thumb_anim = isset($attributes['thumbAnim']) ? 'bldpst-animate' : '';

// styles
$responsive_data = [
    'desktop' => [],
    'tablet'  => [],
    'mobile'  => []
];

// Columns
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'columns', 'grid-template-columns', [], false);
foreach(['desktop', 'tablet', 'mobile'] as $device) {
    if(!empty($responsive_data[$device]['grid-template-columns'])) {
        $responsive_data[$device]['grid-template-columns'] = 'repeat(' . $responsive_data[$device]['grid-template-columns'] . ', 1fr)';
    }
}

// Gaps
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'itemColGap', 'column-gap');
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'itemRowGap', 'row-gap');

// Item Styles
$sub_styles = [];

$item_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $item_responsive, 'itemPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);

$item_desktop = [];


$i_border_radius = $attributes['itemBorderRadius'] ?? [];
if ( ! empty( $i_border_radius['top'] ) ) $item_desktop['border-top-left-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['top'] );
if ( ! empty( $i_border_radius['right'] ) ) $item_desktop['border-top-right-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['right'] );
if ( ! empty( $i_border_radius['bottom'] ) ) $item_desktop['border-bottom-left-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['bottom'] );
if ( ! empty( $i_border_radius['left'] ) ) $item_desktop['border-bottom-right-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['left'] );

$item_responsive['desktop'] = array_merge($item_responsive['desktop'], $item_desktop);


// Item Style Global
$item_styles = [];
if ( ! empty( $attributes['itemBackgroundColor'] ) ) {
    $item_styles['background-color'] = $attributes['itemBackgroundColor'];
}
if ( ! empty( $attributes['itemBackgroundColorTwo'] ) ) {
    $item_styles['background-color'] = $attributes['itemBackgroundColorTwo'];
}
if ( ! empty( $attributes['itemBackgroundGradient'] ) ) {
    $item_styles['background'] = $attributes['itemBackgroundGradient'];
}

// Hover background
$item_hover = [];
if(!empty($attributes['itemBackgroundColorHover'])) {
    $item_hover['background-color'] = $attributes['itemBackgroundColorHover'] . ' !important';
}
if(!empty($attributes['itemBackgroundGradientHover'])) {
    $item_hover['background'] = $attributes['itemBackgroundGradientHover'] . ' !important';
}

// Overlay Styles
$overlay_styles = [];
if ( ! empty( $attributes['itemOverlayBackgroundColor'] ) ) {
    $overlay_styles['background-color'] = $attributes['itemOverlayBackgroundColor'];
}
if ( ! empty( $attributes['itemOverlayBackgroundGradient'] ) ) {
    $overlay_styles['background'] = $attributes['itemOverlayBackgroundGradient'];
}

// Title
$title_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitlePadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'bottom','left'=>'padding-left'], true);
Bold_Post_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitleMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);
Bold_Post_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitleTypography', '', [
    'fontSize'=>'font-size', 
    'fontWeight'=>'font-weight', 
    'lineHeight'=>'line-height', 
    'textTransform'=>'text-transform', 
    'letterSpacing'=>'letter-spacing'
], true);

if ( ! empty( $attributes['itemTitleColor'] ) ) {
    $title_responsive['desktop']['color'] = $attributes['itemTitleColor'];
}

$title_hover = [];
if(!empty($attributes['itemTitleColorHover'])) {
    $title_hover['color'] = $attributes['itemTitleColorHover'];
}

// Excerpt
$excerpt_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
Bold_Post_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);
Bold_Post_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptTypography', '', [
    'fontSize'=>'font-size', 
    'fontWeight'=>'font-weight', 
    'lineHeight'=>'line-height', 
    'textTransform'=>'text-transform', 
    'letterSpacing'=>'letter-spacing'
], true);

if ( ! empty( $attributes['itemExcerptColor'] ) ) {
    $excerpt_responsive['desktop']['color'] = $attributes['itemExcerptColor'];
}

$excerpt_hover = [];
if(!empty($attributes['itemExcerptColorHover'])) {
    $excerpt_hover['color'] = $attributes['itemExcerptColorHover'];
}

// Button Styles
$button_styles = [];
if ( ! empty( $attributes['readMoreBackgroundColor'] ) ) {
    $button_styles['background-color'] = $attributes['readMoreBackgroundColor'];
}
if ( ! empty( $attributes['readMoreColor'] ) ) {
    $button_styles['color'] = $attributes['readMoreColor'];
}
if ( ! empty( $attributes['readMoreBackgroundGradient'] ) ) {
    $button_styles['background'] = $attributes['readMoreBackgroundGradient'];
}

$ib_padding = $attributes['readMorePadding'] ?? [];
if ( ! empty( $ib_padding['top'] ) ) $button_styles['padding-top'] = Bold_Post_Helper::ensure_unit( $ib_padding['top'] );
if ( ! empty( $ib_padding['right'] ) ) $button_styles['padding-right'] = Bold_Post_Helper::ensure_unit( $ib_padding['right'] );
if ( ! empty( $ib_padding['bottom'] ) ) $button_styles['padding-bottom'] = Bold_Post_Helper::ensure_unit( $ib_padding['bottom'] );
if ( ! empty( $ib_padding['left'] ) ) $button_styles['padding-left'] = Bold_Post_Helper::ensure_unit( $ib_padding['left'] );

$ib_margin = $attributes['readMoreMargin'] ?? [];
if ( ! empty( $ib_margin['top'] ) ) $button_styles['margin-top'] = Bold_Post_Helper::ensure_unit( $ib_margin['top'] );
if ( ! empty( $ib_margin['right'] ) ) $button_styles['margin-right'] = Bold_Post_Helper::ensure_unit( $ib_margin['right'] );
if ( ! empty( $ib_margin['bottom'] ) ) $button_styles['margin-bottom'] = Bold_Post_Helper::ensure_unit( $ib_margin['bottom'] );
if ( ! empty( $ib_margin['left'] ) ) $button_styles['margin-left'] = Bold_Post_Helper::ensure_unit( $ib_margin['left'] );

$ib_typo = $attributes['readMoreTypography'] ?? [];
if ( ! empty( $ib_typo['fontSize'] ) ) $button_styles['font-size'] = $ib_typo['fontSize'];
if ( ! empty( $ib_typo['fontWeight'] ) ) $button_styles['font-weight'] = $ib_typo['fontWeight'];
if ( ! empty( $ib_typo['lineHeight'] ) ) $button_styles['line-height'] = $ib_typo['lineHeight'];
if ( ! empty( $ib_typo['textTransform'] ) ) $button_styles['text-transform'] = $ib_typo['textTransform'];
if ( ! empty( $ib_typo['letterSpacing'] ) ) $button_styles['letter-spacing'] = $ib_typo['letterSpacing'];

$button_hover = [];
if(!empty($attributes['readMoreBackgroundColorHover'])) {
    $button_hover['background-color'] = $attributes['readMoreBackgroundColorHover'] . ' !important';
}
if(!empty($attributes['readMoreColorHover'])) {
    $button_hover['color'] = $attributes['readMoreColorHover'] . ' !important';
}
if(!empty($attributes['readMoreBackgroundGradientHover'])) {
    $button_hover['background'] = $attributes['readMoreBackgroundGradientHover'] . ' !important';
}

$td_styles = [];
if(!empty($attributes['topDateBackgroundColor'])) $td_styles['background-color'] = $attributes['topDateBackgroundColor'];
if(!empty($attributes['topDateColor'])) $td_styles['color'] = $attributes['topDateColor'];

$meta_styles = [];
if(!empty($attributes['metaColor'])) $meta_styles['color'] = $attributes['metaColor'];
$meta_margin = $attributes['metaMargin'] ?? [];
if(!empty($meta_margin['top'])) $meta_styles['margin-top'] = Bold_Post_Helper::ensure_unit($meta_margin['top']);
if(!empty($meta_margin['right'])) $meta_styles['margin-right'] = Bold_Post_Helper::ensure_unit($meta_margin['right']);
if(!empty($meta_margin['bottom'])) $meta_styles['margin-bottom'] = Bold_Post_Helper::ensure_unit($meta_margin['bottom']);
if(!empty($meta_margin['left'])) $meta_styles['margin-left'] = Bold_Post_Helper::ensure_unit($meta_margin['left']);

$item_content_styles = [];
if ( ! empty( $attributes['itemContentPadding'] ) ) {
    if(!empty($attributes['itemContentPadding']['top'])) $item_content_styles['padding-top'] = Bold_Post_Helper::ensure_unit( $attributes['itemContentPadding']['top'] );
    if(!empty($attributes['itemContentPadding']['right'])) $item_content_styles['padding-right'] = Bold_Post_Helper::ensure_unit( $attributes['itemContentPadding']['right'] );
    if(!empty($attributes['itemContentPadding']['bottom'])) $item_content_styles['padding-bottom'] = Bold_Post_Helper::ensure_unit( $attributes['itemContentPadding']['bottom'] );
    if(!empty($attributes['itemContentPadding']['left'])) $item_content_styles['padding-left'] = Bold_Post_Helper::ensure_unit( $attributes['itemContentPadding']['left'] );
}
if( !empty($attributes['contentAlignVertical'])) {
    $item_content_styles['justify-content'] = $attributes['contentAlignVertical'];
}

$pag_styles = [];
if ( ! empty( $attributes['paginationColor'] ) ) $pag_styles['color'] = $attributes['paginationColor'];
if ( ! empty( $attributes['paginationBackgroundColor'] ) ) $pag_styles['background-color'] = $attributes['paginationBackgroundColor'];

$pag_hover = [];
if ( ! empty( $attributes['paginationColorHover'] ) ) $pag_hover['color'] = $attributes['paginationColorHover'];
if ( ! empty( $attributes['paginationBackgroundColorHover'] ) ) {
    $pag_hover['background-color'] = $attributes['paginationBackgroundColorHover'];
    $pag_hover['border-color'] = $attributes['paginationBackgroundColorHover'];
}

$style_handle = 'bldpst-post-list-style';
$unique_id    = 'bldpst-' . wp_rand( 100, 99999 );
$selector     = '.' . $unique_id;

$full_responsive_css = Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-list.style-' . $style, $responsive_data);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-list.style-' . $style . ' .bldpst-list-item', $item_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-list.style-' . $style . ' .bldpst-list-item .bldpst-blog-title', $title_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-list.style-' . $style . ' .bldpst-list-item .bldpst-blog-excerpt', $excerpt_responsive);

wp_enqueue_style( $style_handle );
Bold_Post_Helper::add_custom_style( $style_handle, $selector, $full_responsive_css, [
    '.bldpst-post-list .bldpst-list-item'    => Bold_Post_Helper::get_inline_styles($item_styles),
    '.bldpst-post-list .bldpst-list-item:hover'    => Bold_Post_Helper::get_inline_styles($item_hover),
    '.bldpst-post-list .bldpst-list-item .bldpst-overlay-all'        => Bold_Post_Helper::get_inline_styles($overlay_styles),
    '.bldpst-post-list .bldpst-list-item .bldpst-blog-title a:hover' => Bold_Post_Helper::get_inline_styles($title_hover),
    '.bldpst-post-list .bldpst-list-item .bldpst-blog-excerpt a:hover'=> Bold_Post_Helper::get_inline_styles($excerpt_hover),
    '.bldpst-post-list .bldpst-list-item .bldpst-read-more-link'     => Bold_Post_Helper::get_inline_styles($button_styles),
    '.bldpst-post-list .bldpst-list-item .bldpst-read-more-link:hover'=> Bold_Post_Helper::get_inline_styles($button_hover),
    '.bldpst-post-list .bldpst-list-item .bldpst-blog-date-top'      => Bold_Post_Helper::get_inline_styles($td_styles),
    '.bldpst-post-list .bldpst-list-item .bldpst-blog-metas'         => Bold_Post_Helper::get_inline_styles($meta_styles),
    '.bldpst-post-list .bldpst-list-item .bldpst-blog-content'       => Bold_Post_Helper::get_inline_styles($item_content_styles),
    '.bldpst-pagination a, .bldpst-pagination span' => Bold_Post_Helper::get_inline_styles($pag_styles),
    '.bldpst-pagination a:hover, .bldpst-pagination span.current' => Bold_Post_Helper::get_inline_styles($pag_hover),
] );

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => (int) $per_page,
    'post_status'    => 'publish',
    'order'          => in_array( $order, ['ASC','DESC'], true ) ? $order : 'DESC',
    'orderby'        => $orderby,
);

if ( ! empty( $offset ) ) {
    $args['offset'] = (int) $offset;
}

if ( ! empty( $attributes['posts'] ) && ! in_array( 'all', $attributes['posts'] ) ) {
    $args['post__in'] = array_map( 'intval', $attributes['posts'] );
    $args['orderby'] = 'post__in';
}

if ( ! empty( $attributes['excludes'] ) && ! in_array( 'no-excludes', $attributes['excludes'] ) ) {
    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- User-controlled exclusion is intentional
    $args['post__not_in'] = array_map( 'intval', $attributes['excludes'] );
}

if ( ! empty( $attributes['categories'] ) && ! in_array( 'all', $attributes['categories'] ) ) {
    $cat_ids = [];

    foreach ( $attributes['categories'] as $cat ) {
        if ( is_numeric( $cat ) ) {
            $cat_ids[] = (int) $cat;
        } else {
            $term = get_term_by( 'slug', $cat, 'category' );
            if ( $term ) {
                $cat_ids[] = (int) $term->term_id;
            }
        }
    }
    $args['category__in'] = array_map( 'intval', $cat_ids );
}

if($is_featured == true) {
    // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
    $args['meta_query'] = array(
        array(
            'key'     => '_is_featured',
            'value'   => 'yes',
            'compare' => '=',
        ),
    );
}

$query = new WP_Query( $args );
$block_wrap_attr = get_block_wrapper_attributes( array( 'class' => 'bldpst-post-list-block-wrap ' . $unique_id ) );


if ( $query->have_posts() ) :
?>
    <div <?php echo wp_kses_post($block_wrap_attr); ?>>
        <div class="bldpst-post-list style-<?php echo esc_attr($style); ?>">
            <?php
            while ( $query->have_posts() ) : $query->the_post();
                
                $trimmed_title = wp_trim_words( get_the_title(), $title_trim, '...' );
                $trimmed_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_trim, '...' );
               
                $style_file = BLDPST_PL_PATH . 'public/template-parts/blog-list/style-' . $style . '.php';

                if ( file_exists( $style_file ) ) {
                    include $style_file;
                }
            endwhile;
            ?>
        </div>
        <?php
        if($pagination == true && $query->max_num_pages > 1) {
        ?>
        <div class="bldpst-pagination">
            <?php
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- paginate_links output is already escaped
            echo wp_kses_post( paginate_links( array(
                'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, get_query_var('paged') ),
                'total'     => $query->max_num_pages,
                'prev_text' => '<i class="bldpst-icon-chevron-left"></i>',
                'next_text' => '<i class="bldpst-icon-chevron-right"></i>',
            ) ) );
            ?>
        </div>
        <?php
        } 
        ?>
    </div>
<?php
    wp_reset_postdata();
else:
    ?>
    <div <?php echo esc_attr(get_block_wrapper_attributes()); ?>>
        <p><?php esc_html_e('No posts found.', 'bold-post'); ?></p>
    </div>
    <?php
endif;
?>
