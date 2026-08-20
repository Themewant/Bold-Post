<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Attributes are available as $attributes array
// Map camelCase attributes to match the logic (or use direct access)

$per_page = isset($attributes['perPage']) ? $attributes['perPage'] : 6;
$spaceBetween = $attributes['spaceBetween'] ?? 10;
$autoplay = $attributes['autoplay'] ? 'true' : 'false';
$pauseOnHover = $attributes['pauseOnHover'] ? 'true' : 'false';
$pauseOnInter = $attributes['pauseOnInter'] ? 'true' : 'false';
$speed = $attributes['speed'] ?? 2000;
$effect = $attributes['effect'] ?? 'slide';
$loop = $attributes['loop'] ? 'true' : 'false';
$order = isset($attributes['order']) ? $attributes['order'] : 'ASC';
$orderby = isset($attributes['orderby']) ? $attributes['orderby'] : 'date';
$offset = isset($attributes['offset']) ? $attributes['offset'] : 0;
$style = isset($attributes['sliderStyle']) ? $attributes['sliderStyle'] : 'default';
$thumbnail_size = isset($attributes['thumbnailSize']) ? $attributes['thumbnailSize'] : 'large';
$is_featured = !empty($attributes['isFeatured']) ? true : false;
$ignore_stikcy_posts = !empty($attributes['ignoreStikcyPosts']) ? 1 : 0;
$show_dots = !empty($attributes['showDots']) ? true : false;
$show_nav = !empty($attributes['showNav']) ? true : false;

// Styles attributes
$show_meta = !empty($attributes['showMeta']) ? true : false;
$allowed_metas = isset($attributes['allowedMetas']) ? $attributes['allowedMetas'] : [];
$meta_position = isset($attributes['metaPosition']) ? $attributes['metaPosition'] : 'below_title';
$author_prefix = isset($attributes['authorPrefix']) ? $attributes['authorPrefix'] : 'by';
$title_left_tag = isset($attributes['titleLeftTag']) ? $attributes['titleLeftTag'] : 'h3';
$title_right_tag = isset($attributes['titleRightTag']) ? $attributes['titleRightTag'] : 'h3';
$show_excerpt = !empty($attributes['showExcerpt']) ? 'yes' : 'no';
$show_read_more = !empty($attributes['showReadMore']) ? 'yes' : 'no';
$read_more_text = isset($attributes['readMoreText']) ? $attributes['readMoreText'] : 'Read More';
$read_more_icon = isset($attributes['readMoreIcon']) ? $attributes['readMoreIcon'] : 'none';
$read_more_icon_pos = isset($attributes['readMoreIconPosition']) ? $attributes['readMoreIconPosition'] : 'after';
$show_date_on_top = !empty($attributes['showDateOnTop']) ? 'yes' : 'no';
$title_trim = isset($attributes['titleTrim']) ? $attributes['titleTrim'] : 100;
$excerpt_trim = isset($attributes['excerptTrim']) ? $attributes['excerptTrim'] : 20;
$anim_style = isset($attributes['animStyle']) ? $attributes['animStyle'] : '';
$thumb_anim = isset($attributes['thumbAnim']) ? 'boldpo-animate' : '';
$video_autoplay = isset($attributes['videoAutoplay']) && $attributes['videoAutoplay'] ? 1 : 0;
$video_mute = isset($attributes['videoMute']) && $attributes['videoMute'] ? 1 : 0;
$video_height = isset($attributes['videoHeight']) ? $attributes['videoHeight'] : '400px';
$video_width = isset($attributes['videoWidth']) ? $attributes['videoWidth'] : '100%';
$video_controls = isset($attributes['videoControls']) && $attributes['videoControls'] ? 1 : 0;
$show_video = isset($attributes['showVideo']) ? $attributes['showVideo'] : false;

$meta_style = isset($attributes['metaStyle']) ? $attributes['metaStyle'] : 'default';
$slides_per_view = isset($attributes['slidesPerView']) ? $attributes['slidesPerView'] : 4;


$cat_style = 'default';


if($style == '2'){
	$slides_per_view = isset($attributes['slideperview_style2']) ? $attributes['slideperview_style2'] : 3;
    $cat_style = '1';
}

// styles
$responsive_data = [
    'desktop' => [],
    'tablet'  => [],
    'mobile'  => []
];

$col_class = '';

// Gaps (Slider usually handles this in JS, but let's see if SCSS uses them)
BOLDPO_Helper::add_responsive_vars($attributes, $responsive_data, 'itemColGap', 'column-gap');
BOLDPO_Helper::add_responsive_vars($attributes, $responsive_data, 'itemRowGap', 'row-gap');

// Item Styles
$item_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $item_responsive, 'itemPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);

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
if ( ! empty( $i_border_radius['top'] ) ) $item_desktop['border-top-left-radius'] = BOLDPO_Helper::ensure_unit( $i_border_radius['top'] );
if ( ! empty( $i_border_radius['right'] ) ) $item_desktop['border-top-right-radius'] = BOLDPO_Helper::ensure_unit( $i_border_radius['right'] );
if ( ! empty( $i_border_radius['bottom'] ) ) $item_desktop['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit( $i_border_radius['bottom'] );
if ( ! empty( $i_border_radius['left'] ) ) $item_desktop['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit( $i_border_radius['left'] );

$item_responsive['desktop'] = array_merge($item_responsive['desktop'], $item_desktop);

if ( ! empty( $attributes['itemBoxShadow'] ) ) {
    $item_desktop['box-shadow'] = BOLDPO_Helper::box_shadow_to_css($attributes['itemBoxShadow']);
}

if ( ! empty( $attributes['itemBorder'] ) ) {
    foreach ( BOLDPO_Helper::border_to_css_props( $attributes['itemBorder'] ) as $prop => $val ) {
        $item_desktop[$prop] = $val;
    }
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

// Content
$content_style_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $content_style_responsive, 'contentPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $content_style_responsive, 'contentTextAlign', 'text-align', [], false);
BOLDPO_Helper::add_responsive_vars($attributes, $content_style_responsive, 'contentTextAlign', 'justify-content', [], false);

// Title
$title_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitlePadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitleMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);


$title_typo_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $title_typo_responsive, 'itemTitleTypography', '', [
    'fontSize'=>'font-size',
    'fontWeight'=>'font-weight',
    'lineHeight'=>'line-height',
    'textTransform'=>'text-transform',
    'letterSpacing'=>'letter-spacing'
], true);

if ( ! empty( $attributes['itemTitleColor'] ) ) {
    $title_responsive['desktop']['color'] = $attributes['itemTitleColor'];
}

BOLDPO_Helper::add_responsive_vars($attributes, $title_responsive, 'titleTextAlign', 'text-align', [], false);

$title_hover = [];
if(!empty($attributes['itemTitleColorHover'])) {
    $title_hover['color'] = $attributes['itemTitleColorHover'];
}

// Excerpt
$excerpt_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'itemExcerptTypography', '', [
    'fontSize'=>'font-size', 
    'fontWeight'=>'font-weight', 
    'lineHeight'=>'line-height', 
    'textTransform'=>'text-transform', 
    'letterSpacing'=>'letter-spacing'
], true);

if ( ! empty( $attributes['itemExcerptColor'] ) ) {
    $excerpt_responsive['desktop']['color'] = $attributes['itemExcerptColor'];
}

BOLDPO_Helper::add_responsive_vars($attributes, $excerpt_responsive, 'excerptTextAlign', 'text-align', [], false);

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
if ( ! empty( $ib_padding['top'] ) ) $button_styles['padding-top'] = BOLDPO_Helper::ensure_unit( $ib_padding['top'] );
if ( ! empty( $ib_padding['right'] ) ) $button_styles['padding-right'] = BOLDPO_Helper::ensure_unit( $ib_padding['right'] );
if ( ! empty( $ib_padding['bottom'] ) ) $button_styles['padding-bottom'] = BOLDPO_Helper::ensure_unit( $ib_padding['bottom'] );
if ( ! empty( $ib_padding['left'] ) ) $button_styles['padding-left'] = BOLDPO_Helper::ensure_unit( $ib_padding['left'] );

$ib_margin = $attributes['readMoreMargin'] ?? [];
if ( ! empty( $ib_margin['top'] ) ) $button_styles['margin-top'] = BOLDPO_Helper::ensure_unit( $ib_margin['top'] );
if ( ! empty( $ib_margin['right'] ) ) $button_styles['margin-right'] = BOLDPO_Helper::ensure_unit( $ib_margin['right'] );
if ( ! empty( $ib_margin['bottom'] ) ) $button_styles['margin-bottom'] = BOLDPO_Helper::ensure_unit( $ib_margin['bottom'] );
if ( ! empty( $ib_margin['left'] ) ) $button_styles['margin-left'] = BOLDPO_Helper::ensure_unit( $ib_margin['left'] );

$ib_typo = $attributes['readMoreTypography'] ?? [];
if ( ! empty( $ib_typo['fontSize'] ) ) $button_styles['font-size'] = $ib_typo['fontSize'];
if ( ! empty( $ib_typo['fontWeight'] ) ) $button_styles['font-weight'] = $ib_typo['fontWeight'];
if ( ! empty( $ib_typo['lineHeight'] ) ) $button_styles['line-height'] = $ib_typo['lineHeight'];
if ( ! empty( $ib_typo['textTransform'] ) ) $button_styles['text-transform'] = $ib_typo['textTransform'];
if ( ! empty( $ib_typo['letterSpacing'] ) ) $button_styles['letter-spacing'] = $ib_typo['letterSpacing'];

$button_text_align_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $button_text_align_responsive, 'buttonTextAlign', 'text-align', [], false);

$ib_border_radius = $attributes['readMoreBorderRadius'] ?? [];
if ( ! empty( $ib_border_radius['top'] ) ) $button_styles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit( $ib_border_radius['top'] );
if ( ! empty( $ib_border_radius['right'] ) ) $button_styles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit( $ib_border_radius['right'] );
if ( ! empty( $ib_border_radius['bottom'] ) ) $button_styles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit( $ib_border_radius['bottom'] );
if ( ! empty( $ib_border_radius['left'] ) ) $button_styles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit( $ib_border_radius['left'] );
if ( ! empty( $attributes['readMoreBorder'] ) ) {
    foreach ( BOLDPO_Helper::border_to_css_props( $attributes['readMoreBorder'] ) as $prop => $val ) {
        $button_styles[$prop] = $val;
    }
}

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

$metas_styles = [];
$meta_margin = $attributes['metaMargin'] ?? [];
if(!empty($meta_margin['top'])) $metas_styles['margin-top'] = BOLDPO_Helper::ensure_unit($meta_margin['top']);
if(!empty($meta_margin['right'])) $metas_styles['margin-right'] = BOLDPO_Helper::ensure_unit($meta_margin['right']);
if(!empty($meta_margin['bottom'])) $metas_styles['margin-bottom'] = BOLDPO_Helper::ensure_unit($meta_margin['bottom']);
if(!empty($meta_margin['left'])) $metas_styles['margin-left'] = BOLDPO_Helper::ensure_unit($meta_margin['left']);

$meta_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $meta_responsive, 'contentTextAlign', 'text-align', [], false);
BOLDPO_Helper::add_responsive_vars($attributes, $meta_responsive, 'contentTextAlign', 'justify-content', [], false);

BOLDPO_Helper::add_responsive_vars($attributes, $meta_responsive, 'metaTypography', '', [
    'fontSize'=>'font-size',
    'fontWeight'=>'font-weight',
    'lineHeight'=>'line-height',
    'textTransform'=>'text-transform',
    'letterSpacing'=>'letter-spacing'
], true);

$meta_hover = [];
if(!empty($attributes['metaColorHover'])) $meta_hover['color'] = $attributes['metaColorHover'];

$meta_icon_styles = [];
if(!empty($attributes['metaIconColor'])) $meta_icon_styles['color'] = $attributes['metaIconColor'];

$meta_icon_hover = [];
if(!empty($attributes['metaIconColorHover'])) $meta_icon_hover['color'] = $attributes['metaIconColorHover'];

// Category Badge Styles
$cat_container_styles = [];
if(!empty($attributes['categoryBackgroundColor'])) $cat_container_styles['background-color'] = $attributes['categoryBackgroundColor'];
$cat_padding = $attributes['categoryPadding'] ?? [];
if(!empty($cat_padding['top'])) $cat_container_styles['padding-top'] = BOLDPO_Helper::ensure_unit($cat_padding['top']);
if(!empty($cat_padding['right'])) $cat_container_styles['padding-right'] = BOLDPO_Helper::ensure_unit($cat_padding['right']);
if(!empty($cat_padding['bottom'])) $cat_container_styles['padding-bottom'] = BOLDPO_Helper::ensure_unit($cat_padding['bottom']);
if(!empty($cat_padding['left'])) $cat_container_styles['padding-left'] = BOLDPO_Helper::ensure_unit($cat_padding['left']);
$cat_margin = $attributes['categoryMargin'] ?? [];
if(!empty($cat_margin['top'])) $cat_container_styles['margin-top'] = BOLDPO_Helper::ensure_unit($cat_margin['top']);
if(!empty($cat_margin['right'])) $cat_container_styles['margin-right'] = BOLDPO_Helper::ensure_unit($cat_margin['right']);
if(!empty($cat_margin['bottom'])) $cat_container_styles['margin-bottom'] = BOLDPO_Helper::ensure_unit($cat_margin['bottom']);
if(!empty($cat_margin['left'])) $cat_container_styles['margin-left'] = BOLDPO_Helper::ensure_unit($cat_margin['left']);
$cat_link_styles = [];
if(!empty($attributes['categoryColor'])) $cat_link_styles['color'] = $attributes['categoryColor'];
$cat_container_hover = [];
if(!empty($attributes['categoryBackgroundColorHover'])) $cat_container_hover['background-color'] = $attributes['categoryBackgroundColorHover'];
$cat_link_hover = [];
if(!empty($attributes['categoryColorHover'])) $cat_link_hover['color'] = $attributes['categoryColorHover'];

$thumbnail_height_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $thumbnail_height_responsive, 'thumbnailHeight', 'height', [], false);

$thumbnail_width_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $thumbnail_width_responsive, 'thumbnailWidth', 'width', [], false);

$content_width_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
foreach ( $thumbnail_width_responsive as $device => $styles ) {
    if ( ! empty( $styles['width'] ) ) {
        $content_width_responsive[ $device ]['width'] = 'calc(100% - ' . $styles['width'] . ')';
    }
}

$navButtonStyles = [];
if(!empty($attributes['navBgColor'])) $navButtonStyles['background-color'] = $attributes['navBgColor'];
if(!empty($attributes['navColor'])) $navButtonStyles['color'] = $attributes['navColor'];
if(!empty($attributes['navSize'])) $navButtonStyles['--swiper-navigation-size'] = $attributes['navSize'];

$navPadding = $attributes['navPadding'] ?? [];
if(!empty($navPadding['top'])) $navButtonStyles['padding-top'] = BOLDPO_Helper::ensure_unit($navPadding['top']);
if(!empty($navPadding['right'])) $navButtonStyles['padding-right'] = BOLDPO_Helper::ensure_unit($navPadding['right']);
if(!empty($navPadding['bottom'])) $navButtonStyles['padding-bottom'] = BOLDPO_Helper::ensure_unit($navPadding['bottom']);
if(!empty($navPadding['left'])) $navButtonStyles['padding-left'] = BOLDPO_Helper::ensure_unit($navPadding['left']);

$navBorder = $attributes['navBorder'] ?? [];
if (!empty($navBorder['width']) || !empty($navBorder['color']) || !empty($navBorder['style'])) {
	$navButtonStyles = array_merge($navButtonStyles, BOLDPO_Helper::border_to_css_props($navBorder));
}

$navButtonBorderRadius = $attributes['navBorderRadius'] ?? [];
if(!empty($navButtonBorderRadius['top'])) $navButtonStyles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit($navButtonBorderRadius['top']);
if(!empty($navButtonBorderRadius['right'])) $navButtonStyles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit($navButtonBorderRadius['right']);
if(!empty($navButtonBorderRadius['bottom'])) $navButtonStyles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit($navButtonBorderRadius['bottom']);
if(!empty($navButtonBorderRadius['left'])) $navButtonStyles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit($navButtonBorderRadius['left']);


$navButtonHoverStyles = [];
if(!empty($attributes['navBgColorHover'])) $navButtonHoverStyles['background-color'] = $attributes['navBgColorHover'];
if(!empty($attributes['navColorHover'])) $navButtonHoverStyles['color'] = $attributes['navColorHover'];

$navBtnIconStyles = [];
if(!empty($attributes['navIconSize'])) $navBtnIconStyles['height'] = BOLDPO_Helper::ensure_unit($attributes['navIconSize']);
if(!empty($attributes['navIconSize'])) $navBtnIconStyles['width'] = BOLDPO_Helper::ensure_unit($attributes['navIconSize']);


$dotStyles = [];
if(!empty($attributes['dotsColor'])) $dotStyles['color'] = $attributes['dotsColor'];
if(!empty($attributes['dotsBgColor'])) $dotStyles['background-color'] = $attributes['dotsBgColor'];
if(!empty($attributes['dotsSize'])) $dotStyles['height'] = $attributes['dotsSize'];
if(!empty($attributes['dotsSize'])) $dotStyles['width'] = $attributes['dotsSize'];

$dotBorderRadius = $attributes['dotsBorderRadius'] ?? [];
if(!empty($dotBorderRadius['top'])) $dotStyles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit($dotBorderRadius['top']);
if(!empty($dotBorderRadius['right'])) $dotStyles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit($dotBorderRadius['right']);
if(!empty($dotBorderRadius['bottom'])) $dotStyles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit($dotBorderRadius['bottom']);
if(!empty($dotBorderRadius['left'])) $dotStyles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit($dotBorderRadius['left']);

$dotHoverStyles = [];
if(!empty($attributes['dotsColorHover'])) $dotHoverStyles['color'] = $attributes['dotsColorHover'];
if(!empty($attributes['dotsBgColorHover'])) $dotHoverStyles['background-color'] = $attributes['dotsBgColorHover'];


// Thumbnail Border Radius
$thumbnail_border_radius_styles = [];
$t_border_radius = $attributes['thumbnailBorderRadius'] ?? [];
if ( ! empty( $t_border_radius['top'] ) ) $thumbnail_border_radius_styles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['top'] );
if ( ! empty( $t_border_radius['right'] ) ) $thumbnail_border_radius_styles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['right'] );
if ( ! empty( $t_border_radius['bottom'] ) ) $thumbnail_border_radius_styles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['bottom'] );
if ( ! empty( $t_border_radius['left'] ) ) $thumbnail_border_radius_styles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['left'] );

$style_handle = 'boldpo-post-slider-4-style';
$unique_id    = 'boldpo-' . wp_rand( 100, 99999 );
$selector     = '.boldpo-post-slider-4-block-wrap.' . $unique_id;

$full_responsive_css = BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style, $responsive_data);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item', $item_responsive);
$slider_title_sel = $selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-title, '
                  . $selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-blog-title';
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($slider_title_sel, $title_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($slider_title_sel, $title_typo_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-post-metas', $meta_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-blog-excerpt', $excerpt_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-content', $content_style_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-blog-img img', $thumbnail_height_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-blog-img', $thumbnail_width_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-blog-content', $content_width_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-slider-4.style-' . $style . ' .boldpo-list-item .boldpo-read-more .boldpo-read-more-link', $button_text_align_responsive);

wp_enqueue_style( $style_handle );
BOLDPO_Helper::add_custom_style( $style_handle, $selector, $full_responsive_css, [
    '.boldpo-post-slider-4 .boldpo-list-item'    => BOLDPO_Helper::get_inline_styles($item_desktop),
    '.boldpo-post-slider-4 .boldpo-list-item:hover'    => BOLDPO_Helper::get_inline_styles($item_hover),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-overlay-all'        => BOLDPO_Helper::get_inline_styles($overlay_styles),
    '.boldpo-post-slider-4 .boldpo-grid-item .boldpo-blog-title a:hover, .boldpo-post-slider-4 .boldpo-list-item .boldpo-blog-title a:hover' => BOLDPO_Helper::get_inline_styles($title_hover),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-blog-excerpt a:hover'=> BOLDPO_Helper::get_inline_styles($excerpt_hover),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-read-more .boldpo-read-more-link'     => BOLDPO_Helper::get_inline_styles($button_styles),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-read-more .boldpo-read-more-link:hover'=> BOLDPO_Helper::get_inline_styles($button_hover),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-blog-date-top'      => BOLDPO_Helper::get_inline_styles($td_styles),
    '.boldpo-post-slider-4 .boldpo-post-metas'         => BOLDPO_Helper::get_inline_styles($metas_styles),
    '.boldpo-post-slider-4 .boldpo-post-metas span'         => BOLDPO_Helper::get_inline_styles($meta_styles),
    '.boldpo-post-slider-4 .boldpo-post-metas span:hover'         => BOLDPO_Helper::get_inline_styles($meta_hover),
    '.boldpo-post-slider-4 .boldpo-post-metas a'         => BOLDPO_Helper::get_inline_styles($meta_styles),
    '.boldpo-post-slider-4 .boldpo-post-metas a:hover'         => BOLDPO_Helper::get_inline_styles($meta_hover),
    '.boldpo-post-slider-4 .boldpo-post-metas i'         => BOLDPO_Helper::get_inline_styles($meta_icon_styles),
    '.boldpo-post-slider-4 .boldpo-post-metas i:hover'         => BOLDPO_Helper::get_inline_styles($meta_icon_hover),
    '.boldpo-post-slider-4 .nav-btn'         => BOLDPO_Helper::get_inline_styles($navButtonStyles),
    '.boldpo-post-slider-4 .nav-btn:hover'   => BOLDPO_Helper::get_inline_styles($navButtonHoverStyles),
    '.boldpo-post-slider-4 .nav-btn .swiper-navigation-icon'   => BOLDPO_Helper::get_inline_styles($navBtnIconStyles),
    '.boldpo-post-slider-4 .swiper-pagination-bullet'         => BOLDPO_Helper::get_inline_styles($dotStyles),
    '.boldpo-post-slider-4 .swiper-pagination-bullet.swiper-pagination-bullet-active'   => BOLDPO_Helper::get_inline_styles($dotHoverStyles),
    '.boldpo-post-slider-4 .boldpo-list-item .boldpo-blog-img'   => BOLDPO_Helper::get_inline_styles($thumbnail_border_radius_styles),
    '.boldpo-post-categories .bldpost-meta' => BOLDPO_Helper::get_inline_styles($cat_container_styles),
    '.boldpo-post-categories .bldpost-meta:hover' => BOLDPO_Helper::get_inline_styles($cat_container_hover),
    '.boldpo-post-categories .bldpost-meta a' => BOLDPO_Helper::get_inline_styles($cat_link_styles),
    '.boldpo-post-categories .bldpost-meta a:hover' => BOLDPO_Helper::get_inline_styles($cat_link_hover),
] );

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => (int) $per_page,
    'post_status'    => 'publish',
    'order'          => in_array( $order, ['ASC','DESC'], true ) ? $order : 'DESC',
    'orderby'        => $orderby,
    'ignore_sticky_posts' => $ignore_stikcy_posts,
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
$query = new WP_Query( $args );

$template_pl_path = BOLDPO_PL_PATH;
if($style !== 'default' && defined('BOLDPO_PRO_PL_PATH')) {
    $template_pl_path = BOLDPO_PRO_PL_PATH;
}

if ( $query->have_posts() ) :
?>
    <div <?php echo wp_kses_post(get_block_wrapper_attributes( array( 
        'class' => 'boldpo-block boldpo-post-slider-4-block-wrap ' . $unique_id,
        'data-unique' => esc_attr($unique),  
        'data-space-between' => esc_attr($spaceBetween),
        'data-gallery-nav' => esc_attr($show_nav ),
        'data-gallery-dots' => esc_attr($show_dots),
        'data-loop' => esc_attr($loop),
        'data-effect' => esc_attr($effect),
        'data-speed' => esc_attr($speed),
        'data-autoplay' => esc_attr($autoplay),
        'data-slides-per-view' => esc_attr($slides_per_view),
            ) )); ?>>
       
        <div class="boldpo-post-slider-4 boldpo-post-slider-4-<?php echo esc_attr($unique); ?> style-<?php echo esc_attr($style); ?>">
            <div class="slider">
                <div class="slider__flex">
                    <div class="slider__images">
                        <div class="swiper-container swiper">
                            <?php
                                if($style == '2'){
                                    $modified_date = true;
                                    ?>
                                        <div class="boldpo-post-slider-btn-wrapper boldpo-post-slider-btn-wrapper-<?php echo esc_attr($unique); ?>">
                                            <?php 
                                           
                                            ?>
                                            <!-- If we need navigation buttons -->
                                            <?php if($show_nav) { ?>
                                                <div class="swiper-button-prev nav-btn"></div>
                                                <div class="swiper-button-next nav-btn"></div>
                                            <?php } ?>
                                            <!-- If we need scrollbar -->
                                            <div class="swiper-scrollbar"></div>
                                        </div>
                                    <?php
                                } 
                                
                            ?>
                            <div class="swiper-wrapper">
                                <?php
                                while ($query->have_posts()) : $query->the_post();

                                        $item_class = '';
                                        if(is_sticky()) {
                                            $item_class .= 'boldpo-sticky-post';
                                        }

                                        if(!empty($anim_style)) {
                                            $item_class .= ' ' . $anim_style;
                                        }
                                        $trimmed_title = wp_trim_words( get_the_title(), $title_trim, '...' );
                                        $trimmed_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_trim, '...' );
                                        $title_tag = $title_left_tag;

                                        $video_url = $show_video ? get_post_meta( get_the_ID(), '_video_url', true ) : '';
                                        $embed_video = $show_video ? BOLDPO_Helper::boldpost_get_video_embed($video_url, $video_autoplay, $video_mute, $video_controls, $video_height, $video_width) : '';
                                        if(!empty($embed_video)) {
                                            $item_class .= ' boldpo-has-video';
                                        }
                                    
                                        $style_file = $template_pl_path . 'public/template-parts/post-slider-4/grid/style-' . $style . '.php';
                                        ?>

                                        <div class="swiper-slide">
                                            <div class="slider__image">
                                                <?php include $style_file; ?>
                                            </div>                                                        
                                        </div>

                                        <?php
                                    endwhile;
                                wp_reset_postdata();
                                ?>              
                            </div>
                            
                            <?php 
                            if($show_dots){ ?>
                                <div class="swiper-pagination rt-gallery-slider-pagination"></div>                 
                            <?php } ?>   
                        </div>
                    </div>   
                    <div class="slider__col">
                        <?php
                            if($show_nav && $style !== '2'){
                                ?>
                                <div class="swiper-button-prev nav-btn"> <?php echo esc_html__( 'Previous', 'boldpost' ); ?> </div>
                                <?php 
                            }
                        ?>
                        <div class="slider__thumbs">
                            <div class="swiper-container swiper">
                                <div class="swiper-wrapper">                        
                                        <?php
                                        $modified_date = false;
                                        $style_file = $template_pl_path . 'public/template-parts/post-slider-4/list/style-' . $style . '.php';
                                        while ($query->have_posts()) : $query->the_post();
                                        $title_tag = $title_right_tag;
                                        if($style !== '2') {
                                            $show_meta = false;
                                        }
                                        
                                        $item_class = '';
                                        if(is_sticky()) {
                                            $item_class .= 'boldpo-sticky-post';
                                        }
                                        if(!empty($anim_style)) {
                                            $item_class .= ' ' . $anim_style;
                                        }
                                        $trimmed_title = wp_trim_words( get_the_title(), $title_trim, '...' );
                                        $trimmed_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_trim, '...' );
                                        $thumbnail_size = 'thumbnail';

                                        $video_url = get_post_meta( get_the_ID(), '_video_url', true );
                                        $embed_video = BOLDPO_Helper::boldpost_get_video_embed($video_url, $video_autoplay, $video_mute, $video_controls, $video_height, $video_width);
                                        if(!empty($embed_video)) {
                                            $item_class .= ' boldpo-has-video';
                                        }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="slider__image">                            
                                                    <?php include $style_file; ?>                          
                                                </div>                                    
                                            </div>
                                        <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>                          
                                </div>
                            </div>
                        </div>
                        <?php
                            if($show_nav && $style !== '2'){
                                ?>
                                <div class="swiper-button-next nav-btn"><?php echo esc_html__( 'Next', 'boldpost' ); ?></div>
                                <?php
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        


        
    </div>
<?php
    wp_reset_postdata();
else:
    ?>
    <div <?php echo esc_attr(get_block_wrapper_attributes()); ?>>
        <p><?php esc_html_e('No posts found.', 'boldpost'); ?></p>
    </div>
    <?php
endif;