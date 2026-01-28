<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Attributes are available as $attributes array
// Map camelCase attributes to match the logic (or use direct access)

$per_page = isset($attributes['perPage']) ? $attributes['perPage'] : 6;
$slidesPerView = $attributes['slidesPerView'] ?? 1;
$slidesPerViewTablet = $attributes['slidesPerViewTablet'] ?? 1;
$slidesPerViewMobile = $attributes['slidesPerViewMobile'] ?? 1;
$slidesPerViewMobileSmall = $attributes['slidesPerViewMobileSmall'] ?? 1;


$slidesToScroll = $attributes['slidesToScroll'] ?? 1;
$spaceBetween = $attributes['spaceBetween'] ?? 10;
$autoplay = $attributes['autoplay'] ? 'true' : 'false';
$pauseOnHover = $attributes['pauseOnHover'] ? 'true' : 'false';
$pauseOnInter = $attributes['pauseOnInter'] ? 'true' : 'false';

$centeredSlides = $attributes['centeredSlides'] ? 'true' : 'false';
$speed = $attributes['speed'] ?? 2000;
$effect = $attributes['effect'] ?? 'slide';
$loop = $attributes['loop'] ? 'true' : 'false';
$order = isset($attributes['order']) ? $attributes['order'] : 'ASC';
$orderby = isset($attributes['orderby']) ? $attributes['orderby'] : 'date';
$offset = isset($attributes['offset']) ? $attributes['offset'] : 0;
$style = isset($attributes['sliderStyle']) ? $attributes['sliderStyle'] : 'default';
$thumbnail_size = isset($attributes['thumbnailSize']) ? $attributes['thumbnailSize'] : 'large';
$is_featured = !empty($attributes['isFeatured']) ? true : false;

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

// Gaps (Slider usually handles this in JS, but let's see if SCSS uses them)
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'itemColGap', 'column-gap');
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'itemRowGap', 'row-gap');

// Item Styles
$item_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $item_responsive, 'itemPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);

$item_desktop = [];
if ( ! empty( $attributes['itemBackgroundColor'] ) ) {
    $item_desktop['background-color'] = $attributes['itemBackgroundColor'];
}
if ( ! empty( $attributes['itemBackgroundColorTwo'] ) ) {
    $item_desktop['background-color'] = $attributes['itemBackgroundColorTwo'];
}
if ( ! empty( $attributes['itemBackgroundGradient'] ) ) {
    $item_desktop['background'] = $attributes['itemBackgroundGradient'];
}

$i_border_radius = $attributes['itemBorderRadius'] ?? [];
if ( ! empty( $i_border_radius['top'] ) ) $item_desktop['border-top-left-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['top'] );
if ( ! empty( $i_border_radius['right'] ) ) $item_desktop['border-top-right-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['right'] );
if ( ! empty( $i_border_radius['bottom'] ) ) $item_desktop['border-bottom-left-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['bottom'] );
if ( ! empty( $i_border_radius['left'] ) ) $item_desktop['border-bottom-right-radius'] = Bold_Post_Helper::ensure_unit( $i_border_radius['left'] );

$item_responsive['desktop'] = array_merge($item_responsive['desktop'], $item_desktop);

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

$style_handle = 'bldpst-post-slider-style';
$unique_id    = 'bldpst-' . wp_rand( 100, 99999 );
$selector     = '.' . $unique_id;

$full_responsive_css = Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-slider.style-' . $style, $responsive_data);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-slider.style-' . $style . ' .bldpst-grid-item', $item_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-slider.style-' . $style . ' .bldpst-grid-item .bldpst-blog-title', $title_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-post-slider.style-' . $style . ' .bldpst-grid-item .bldpst-blog-excerpt', $excerpt_responsive);

wp_enqueue_style( $style_handle );
Bold_Post_Helper::add_custom_style( $style_handle, $selector, $full_responsive_css, [
    '.bldpst-post-slider .bldpst-grid-item:hover'    => Bold_Post_Helper::get_inline_styles($item_hover),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-overlay-all'        => Bold_Post_Helper::get_inline_styles($overlay_styles),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-blog-title a:hover' => Bold_Post_Helper::get_inline_styles($title_hover),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-blog-excerpt a:hover'=> Bold_Post_Helper::get_inline_styles($excerpt_hover),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-read-more-link'     => Bold_Post_Helper::get_inline_styles($button_styles),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-read-more-link:hover'=> Bold_Post_Helper::get_inline_styles($button_hover),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-blog-date-top'      => Bold_Post_Helper::get_inline_styles($td_styles),
    '.bldpst-post-slider .bldpst-grid-item .bldpst-blog-metas'         => Bold_Post_Helper::get_inline_styles($meta_styles),
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
            'value'   => '1',
            'compare' => 'IN',
        ),
    );
}

$unique      = wp_rand(2012, 35120);
$galleryDots = true;
$galleryNav  = true;

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
?>
    <div <?php echo wp_kses_post(get_block_wrapper_attributes( array( 
        'class' => 'bldpst-post-slider-block-wrap ' . $unique_id,
        'data-unique' => esc_attr($unique),  
        'data-slides-per-view' => esc_attr($slidesPerView),
        'data-slides-per-view-tablet' => esc_attr($slidesPerViewTablet),
        'data-slides-per-view-mobile' => esc_attr($slidesPerViewMobile),
        'data-slides-per-view-mobile-small' => esc_attr($slidesPerViewMobileSmall),
        'data-slides-to-scroll' => esc_attr($slidesToScroll),
        'data-space-between' => esc_attr($spaceBetween),
        'data-centered-slides' => esc_attr($centeredSlides),
        'data-gallery-nav' => esc_attr($galleryNav),
        'data-gallery-dots' => esc_attr($galleryDots),
        'data-loop' => esc_attr($loop),
        'data-effect' => esc_attr($effect),
        'data-speed' => esc_attr($speed),
        'data-autoplay' => esc_attr($autoplay),
            ) )); ?>>
       
        <div class="bldpst-post-slider swiper bldpst-post-slider-<?php echo esc_attr($unique); ?> style-<?php echo esc_attr($style); ?>">
            <div class="swiper-wrapper swiper-wrapper-<?php echo esc_attr($unique); ?>">
                <?php
                    while ( $query->have_posts() ) : $query->the_post();
                        
                        $trimmed_title = wp_trim_words( get_the_title(), $title_trim, '...' );
                        $trimmed_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_trim, '...' );
                    
                        $style_file = BLDPST_PL_PATH . 'public/template-parts/blog-grid/style-' . $style . '.php';

                        if ( file_exists( $style_file ) ) {
                            ?>
                            <div class="swiper-slide">
                                <?php include $style_file; ?>
                            </div>
                            <?php
                        }
                    endwhile;
                ?>
            </div>
            <?php if( !empty($galleryDots == 'true' || $galleryNav == 'true') ) : ?>
                <div class="bldpst-post-slider-btn-wrapper bldpst-post-slider-btn-wrapper-<?php echo esc_attr($unique); ?>">
                    <div class="swiper-pagination"></div>
                    <!-- If we need navigation buttons -->
                    <div class="nav-btn swiper-button-prev"></div>
                    <div class="nav-btn swiper-button-next"></div>
                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            <?php endif; ?>
        </div>
        
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
