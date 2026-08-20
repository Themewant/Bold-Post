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
$offset = isset($attributes['offset']) ? $attributes['offset'] : '';
$columns = isset($attributes['columns']) ? $attributes['columns'] : 3;
$style = isset($attributes['gridStyle']) ? $attributes['gridStyle'] : 'default';
$thumbnail_size = isset($attributes['thumbnailSize']) ? $attributes['thumbnailSize'] : 'large';
$is_featured = !empty($attributes['isFeatured']) ? true : false;
$pagination = !empty($attributes['pagination']) ? true : false;
$pagination_type = isset($attributes['paginationType']) ? $attributes['paginationType'] : 'numeric';
$ignore_stikcy_posts = !empty($attributes['ignoreStikcyPosts']) ? 1 : 0;
$unique_id    = !empty($attributes['blockId']) ? $attributes['blockId'] : 'boldpo-' . substr(md5(serialize($attributes)), 0, 6);
$page_key = 'paged_' . $unique_id;

if ( ! isset( $paged ) ) {
    if ( is_archive() ) {
        $paged = max( 1, get_query_var('paged') );
    } else {
        $paged = isset( $_GET[ $page_key ] ) ? max( 1, (int) $_GET[ $page_key ] ) : 1; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Public pagination param; cast to int sanitizes the value.
    }
}

$paged = max( 1, (int) $paged );

// Styles attributes
$show_meta = !empty($attributes['showMeta']) ? true : false;
$allowed_metas = isset($attributes['allowedMetas']) ? $attributes['allowedMetas'] : [];
$meta_position = isset($attributes['metaPosition']) && !empty($attributes['metaPosition']) ? $attributes['metaPosition'] : 'below_title';
$author_prefix = isset($attributes['authorPrefix']) ? $attributes['authorPrefix'] : 'by';
$title_left_tag = isset($attributes['titleLeftTag']) ? $attributes['titleLeftTag'] : 'h3';
$title_right_tag = isset($attributes['titleRightTag']) ? $attributes['titleRightTag'] : 'h3';
$title_tag = $title_left_tag;
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
$show_video = !empty($attributes['showVideo']) ? true : false;
$video_autoplay = isset($attributes['videoAutoplay']) && $attributes['videoAutoplay'] ? 1 : 0;
$video_mute = isset($attributes['videoMute']) && $attributes['videoMute'] ? 1 : 0;
$video_height = isset($attributes['videoHeight']) ? $attributes['videoHeight'] : '400px';
$video_width = isset($attributes['videoWidth']) ? $attributes['videoWidth'] : '100%';
$video_controls = isset($attributes['videoControls']) && $attributes['videoControls'] ? 1 : 0;

$meta_style = isset($attributes['metaStyle']) ? $attributes['metaStyle'] : 'default';

$cat_style = '1';

// styles
$responsive_data = [
    'desktop' => [],
    'tablet'  => [],
    'mobile'  => []
];

$wrap_one_col_class = 'boldpo-col-lg-6 boldpo-col-md-6 boldpo-col-sm-12 boldpo-col-12';
$wrap_two_col_class = 'boldpo-col-lg-6 boldpo-col-md-6 boldpo-col-sm-12 boldpo-col-12';

// Columns
if($style == '2' || $style == '3') {
   $wrap_one_col_class = 'boldpo-col-lg-6 boldpo-col-md-6 boldpo-col-sm-12 boldpo-col-12';
   $wrap_two_col_class = 'boldpo-col-lg-6 boldpo-col-md-6 boldpo-col-sm-12 boldpo-col-12';
} 
$col_class = '';
if($style == 'default') {
    // Columns
    $c_desktop = isset($attributes['columns']) ? (int)$attributes['columns'] : 3;
    $c_tablet  = isset($attributes['columnsTablet']) ? (int)$attributes['columnsTablet'] : $c_desktop;
    $c_mobile  = isset($attributes['columnsMobile']) ? (int)$attributes['columnsMobile'] : 1;

    $bs_col_lg = (int)(12 / $c_desktop);
    $bs_col_md = (int)(12 / $c_tablet);
    $bs_col_xs = (int)(12 / $c_mobile);

    $col_class = " boldpo-col-lg-{$bs_col_lg} boldpo-col-md-{$bs_col_md} boldpo-col-{$bs_col_xs}";
}


// Gaps
$g_desktop = isset($attributes['itemGap']) ? $attributes['itemGap'] : '4';
$g_tablet = isset($attributes['itemGapTablet']) ? $attributes['itemGapTablet'] : $g_desktop;
$g_mobile = isset($attributes['itemGapMobile']) ? $attributes['itemGapMobile'] : 0;

$gap_class = '';
if ($g_desktop == $g_tablet && $g_tablet == $g_mobile) {
    $gap_class = 'boldpo-gx-' . $g_desktop;
} else {
    $gap_class = 'boldpo-gx-lg-' . $g_desktop . ' boldpo-gx-md-' . $g_tablet . ' boldpo-gx-sm-' . $g_mobile;
}

// Row gap
$rg_desktop = isset($attributes['itemRowGap']) ? $attributes['itemRowGap'] : '4';
$rg_tablet = isset($attributes['itemRowGapTablet']) ? $attributes['itemRowGapTablet'] : $rg_desktop;
$rg_mobile = isset($attributes['itemRowGapMobile']) ? $attributes['itemRowGapMobile'] : 0;

$row_gap_class = '';
if ($rg_desktop == $rg_tablet && $rg_tablet == $rg_mobile) {
    $row_gap_class = 'boldpo-gy-' . $rg_desktop;
} else {
    $row_gap_class = 'boldpo-gy-lg-' . $rg_desktop . ' boldpo-gy-md-' . $rg_tablet . ' boldpo-gy-sm-' . $rg_mobile;
}

// Item Styles
$item_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $item_responsive, 'itemPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $item_responsive, 'itemMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);

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

// content
$content_padding_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $content_padding_responsive, 'contentPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $content_padding_responsive, 'contentTextAlign', 'text-align', [], false);

// Title
$title_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitlePadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);
BOLDPO_Helper::add_responsive_vars($attributes, $title_responsive, 'itemTitleMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);

$title_left_typo_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $title_left_typo_responsive, 'itemTitleLeftTypography', '', [
    'fontSize'=>'font-size', 
    'fontWeight'=>'font-weight', 
    'lineHeight'=>'line-height', 
    'textTransform'=>'text-transform', 
    'letterSpacing'=>'letter-spacing'
], true);

$title_right_typo_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $title_right_typo_responsive, 'itemTitleRightTypography', '', [
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

$pag_styles = [];
if ( ! empty( $attributes['paginationColor'] ) ) $pag_styles['color'] = $attributes['paginationColor'];
if ( ! empty( $attributes['paginationBackgroundColor'] ) ) $pag_styles['background-color'] = $attributes['paginationBackgroundColor'];

$pag_hover = [];
if ( ! empty( $attributes['paginationColorHover'] ) ) $pag_hover['color'] = $attributes['paginationColorHover'];
if ( ! empty( $attributes['paginationBackgroundColorHover'] ) ) {
    $pag_hover['background-color'] = $attributes['paginationBackgroundColorHover'];
    $pag_hover['border-color'] = $attributes['paginationBackgroundColorHover'];
}

// Pagination Button Width
$pagination_btn_width_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $pagination_btn_width_responsive, 'paginationBtnWidth', 'width', [], false);

// Pagination Button Border
if ( ! empty( $attributes['paginationBtnBorder'] ) ) {
    foreach ( BOLDPO_Helper::border_to_css_props( $attributes['paginationBtnBorder'] ) as $prop => $val ) {
        $pag_styles[$prop] = $val;
    }
}

// Pagination Button Border Radius
$pagination_btn_border_radius = $attributes['paginationBtnBorderRadius'] ?? [];
if ( ! empty( $pagination_btn_border_radius['top'] ) ) $pag_styles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit( $pagination_btn_border_radius['top'] );
if ( ! empty( $pagination_btn_border_radius['right'] ) ) $pag_styles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit( $pagination_btn_border_radius['right'] );
if ( ! empty( $pagination_btn_border_radius['bottom'] ) ) $pag_styles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit( $pagination_btn_border_radius['bottom'] );
if ( ! empty( $pagination_btn_border_radius['left'] ) ) $pag_styles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit( $pagination_btn_border_radius['left'] );

// Pagination Button Padding
$pagination_btn_padding_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $pagination_btn_padding_responsive, 'paginationBtnPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);

// Pagination Wrap Margin
$pagination_wrap_margin_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $pagination_wrap_margin_responsive, 'paginationWrapMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);


$thumbnail_left_height_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $thumbnail_left_height_responsive, 'thumbnailLeftHeight', 'height', [], false);

$thumbnail_right_height_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
BOLDPO_Helper::add_responsive_vars($attributes, $thumbnail_right_height_responsive, 'thumbnailRightHeight', 'height', [], false);

// Thumbnail Border Radius
$thumbnail_border_radius_styles = [];
$t_border_radius = $attributes['thumbnailBorderRadius'] ?? [];
if ( ! empty( $t_border_radius['top'] ) ) $thumbnail_border_radius_styles['border-top-left-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['top'] );
if ( ! empty( $t_border_radius['right'] ) ) $thumbnail_border_radius_styles['border-top-right-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['right'] );
if ( ! empty( $t_border_radius['bottom'] ) ) $thumbnail_border_radius_styles['border-bottom-left-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['bottom'] );
if ( ! empty( $t_border_radius['left'] ) ) $thumbnail_border_radius_styles['border-bottom-right-radius'] = BOLDPO_Helper::ensure_unit( $t_border_radius['left'] );

$style_handle = 'boldpo-post-grid-4-style';
$unique_id    = $attributes['blockId'];
$selector     = '.boldpo-post-grid-4-block-wrap.' . $unique_id;

$full_responsive_css = ""; 
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-grid-item-inner', $item_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-title', $title_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-post-metas', $meta_responsive);
if ( $style === '1' ) {
    // Pro Style 1 renders split left/right column wraps.
    $full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-col-left-wrap .boldpo-grid-item .boldpo-blog-title', $title_left_typo_responsive);
    $full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-col-right-wrap .boldpo-grid-item .boldpo-blog-title', $title_right_typo_responsive);
} else {
    // Default uniform grid has no left/right wraps — apply title typography to every item title.
    $full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-title', $title_left_typo_responsive);
}
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-excerpt', $excerpt_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-content', $content_padding_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-col-left-wrap .boldpo-grid-item .boldpo-blog-img img', $thumbnail_left_height_responsive);   
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-col-right-wrap .boldpo-grid-item .boldpo-blog-img img', $thumbnail_right_height_responsive);   
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-read-more .boldpo-read-more-link', $button_text_align_responsive);   
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpost-load-more-btn', $pagination_btn_width_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-pagination .page-numbers', $pagination_btn_padding_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpost-load-more-btn', $pagination_btn_padding_responsive);
$full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpost-pagination-container', $pagination_wrap_margin_responsive);

if( $style == 'default') {
    $full_responsive_css .= BOLDPO_Helper::generate_responsive_css($selector . ' .boldpo-post-grid-4.style-' . $style . ' .boldpo-grid-item .boldpo-blog-img img', $thumbnail_right_height_responsive);   
}

wp_enqueue_style( $style_handle );
BOLDPO_Helper::add_custom_style( $style_handle, $selector, $full_responsive_css, [
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-grid-item-inner'    => BOLDPO_Helper::get_inline_styles($item_desktop),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-grid-item-inner:hover'    => BOLDPO_Helper::get_inline_styles($item_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-overlay-all'        => BOLDPO_Helper::get_inline_styles($overlay_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-blog-title a:hover' => BOLDPO_Helper::get_inline_styles($title_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-blog-excerpt a:hover'=> BOLDPO_Helper::get_inline_styles($excerpt_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-read-more .boldpo-read-more-link'     => BOLDPO_Helper::get_inline_styles($button_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-read-more .boldpo-read-more-link:hover'=> BOLDPO_Helper::get_inline_styles($button_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-blog-date-top'      => BOLDPO_Helper::get_inline_styles($td_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-post-metas'         => BOLDPO_Helper::get_inline_styles($metas_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-post-metas a'         => BOLDPO_Helper::get_inline_styles($meta_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-post-metas a:hover'   => BOLDPO_Helper::get_inline_styles($meta_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-post-metas i'       => BOLDPO_Helper::get_inline_styles($meta_icon_styles),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-post-metas i:hover' => BOLDPO_Helper::get_inline_styles($meta_icon_hover),
    '.boldpo-pagination .page-numbers' => BOLDPO_Helper::get_inline_styles($pag_styles),
    '.boldpo-pagination .page-numbers.current' => BOLDPO_Helper::get_inline_styles($pag_hover),
    '.boldpo-pagination a:hover' => BOLDPO_Helper::get_inline_styles($pag_hover),
    '.boldpost-load-more-btn' => BOLDPO_Helper::get_inline_styles($pag_styles),
    '.boldpost-load-more-btn:hover' => BOLDPO_Helper::get_inline_styles($pag_hover),
    '.boldpo-post-grid-4 .boldpo-grid-item .boldpo-blog-img'   => BOLDPO_Helper::get_inline_styles($thumbnail_border_radius_styles),
    '.boldpo-post-categories .bldpost-meta' => BOLDPO_Helper::get_inline_styles($cat_container_styles),
    '.boldpo-post-categories .bldpost-meta:hover' => BOLDPO_Helper::get_inline_styles($cat_container_hover),
    '.boldpo-post-categories .bldpost-meta a' => BOLDPO_Helper::get_inline_styles($cat_link_styles),
    '.boldpo-post-categories .bldpost-meta a:hover' => BOLDPO_Helper::get_inline_styles($cat_link_hover),
] );

if($style == '1'){
    $per_page = 5;
}
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => (int) $per_page,
    'post_status'    => 'publish',
    'order'          => in_array( $order, ['ASC','DESC'], true ) ? $order : 'DESC',
    'orderby'        => $orderby,
    'paged'          => $paged,
    'ignore_sticky_posts' => $ignore_stikcy_posts,
);

if ( ! empty( $offset ) ) {
    // When using offset with pagination, we need to adjust it for each page
    $args['offset'] = (int) $offset + ( ( $paged - 1 ) * $per_page );
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
$block_wrap_attr = get_block_wrapper_attributes( array( 'class' => 'boldpo-block boldpo-post-grid-4-block-wrap ' . $unique_id ) );

if ( empty( $block_wrap_attr ) ) {
    $block_wrap_attr = 'class="boldpo-block boldpo-post-grid-4-block-wrap ' . esc_attr( $unique_id ) . '"';
}

$template_pl_path = BOLDPO_PL_PATH;
if($style !== 'default' && defined('BOLDPO_PRO_PL_PATH')) {
    $template_pl_path = BOLDPO_PRO_PL_PATH;
}

if ( $query->have_posts() ) :
?>
    <div <?php echo wp_kses_post($block_wrap_attr); ?>>
        <div class="boldpo-post-grid-4 boldpo-row style-<?php echo esc_attr($style); ?> <?php echo esc_attr($gap_class); ?> <?php echo esc_attr($row_gap_class); ?>" 
             <?php if ($pagination_type !== 'numeric') {
                 $data_attr = $attributes;
                 $data_attr['blockName'] = 'boldpost/post-grid-4';
                 echo 'data-attributes="' . esc_attr(json_encode($data_attr)) . '" data-query-args="' . esc_attr(json_encode($args)) . '"'; 
             } ?>>
            <?php
            $i = 0;
            while ( $query->have_posts() ) : $query->the_post();
                $i++;
                $item_class = '';
                if(is_sticky()) {
                    $item_class .= ' boldpo-sticky-post';
                }

                if(!empty($anim_style)) {
                    $item_class .= ' ' . $anim_style;
                }

                $trimmed_title = wp_trim_words( get_the_title(), $title_trim, '...' );
                $trimmed_excerpt = wp_trim_words( get_the_excerpt(), $excerpt_trim, '...' );
                $video_url = $show_video ? get_post_meta( get_the_ID(), '_video_url', true ) : '';
                $embed_video = BOLDPO_Helper::boldpost_get_video_embed($video_url, $video_autoplay, $video_mute, $video_controls, $video_height, $video_width);
                if(!empty($embed_video)) {
                    $item_class .= ' boldpo-has-video';
                }

                
                $style_file = $template_pl_path . 'public/template-parts/post-grid-4/style-' . $style . '.php';
                
            
                if ( ($style == '1') && file_exists( $style_file ) ) {

                    if ($i == 1) {
                        $col_class = ' boldpo-col-12';
                        // LEFT BIG POST
                        $title_tag = $title_left_tag;
                        $item_class = $item_class . $col_class;

                        echo '<div class="boldpo-grid-col-left-wrap ' . esc_attr($wrap_one_col_class) . '">';
                        include $style_file;
                        echo '</div>';

                        // RIGHT SMALL POSTS
                        if ($query->post_count > 1) {
                            $title_tag = $title_right_tag;

                            echo '<div class="boldpo-grid-col-right-wrap ' . esc_attr($wrap_two_col_class) . '">';
                            echo '<div class="boldpo-grid-row boldpo-row ' . esc_attr($row_gap_class) . '">';
                        }

                    } else {
                        $col_class = 'boldpo-col-lg-6 boldpo-col-md-6 boldpo-col-sm-12 boldpo-col-12';
                        $item_class = $item_class . $col_class;
                        include $style_file;
                    }

                } 
                
                else {
                    $item_class = $item_class . $col_class;
                    include $style_file;

                }


            endwhile;
          
                // Close inner boldpo-row then the right-wrap
                echo '</div>';
            
            ?>
            <?php include BOLDPO_PL_PATH . 'public/template-parts/pagination/pagination.php'; ?>
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
?>