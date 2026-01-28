<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Attributes are available as $attributes array
$per_page = isset($attributes['perPage']) ? $attributes['perPage'] : 9;
$order = isset($attributes['order']) ? $attributes['order'] : 'ASC';
$orderby = isset($attributes['orderby']) ? $attributes['orderby'] : 'name';
$columns = isset($attributes['columns']) ? $attributes['columns'] : 3;
$style = isset($attributes['listStyle']) ? $attributes['listStyle'] : '1';
$hide_empty = !empty($attributes['hideEmpty']) ? true : false;
$show_count = !empty($attributes['showCount']) ? true : false;
$show_empty_count = !empty($attributes['showEmptyCount']) ? true : false;
$show_description = !empty($attributes['showDescription']) ? true : false;
$title_tag = isset($attributes['titleTag']) ? $attributes['titleTag'] : 'h3';

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
Bold_Post_Helper::add_responsive_vars($attributes, $responsive_data, 'itemGap', 'gap');

// Item Styles
$item_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $item_responsive, 'itemPadding', '', ['top'=>'padding-top','right'=>'padding-right','bottom'=>'padding-bottom','left'=>'padding-left'], true);

$item_desktop = [];
if ( ! empty( $attributes['itemBackgroundColor'] ) ) {
    $item_desktop['background-color'] = $attributes['itemBackgroundColor'];
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

// Title
$title_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
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

// Description
$description_responsive = ['desktop' => [], 'tablet' => [], 'mobile' => []];
Bold_Post_Helper::add_responsive_vars($attributes, $description_responsive, 'itemDescriptionMargin', '', ['top'=>'margin-top','right'=>'margin-right','bottom'=>'margin-bottom','left'=>'margin-left'], true);
Bold_Post_Helper::add_responsive_vars($attributes, $description_responsive, 'itemDescriptionTypography', '', [
    'fontSize'=>'font-size', 
    'fontWeight'=>'font-weight', 
    'lineHeight'=>'line-height', 
    'textTransform'=>'text-transform', 
    'letterSpacing'=>'letter-spacing'
], true);

if ( ! empty( $attributes['itemDescriptionColor'] ) ) {
    $description_responsive['desktop']['color'] = $attributes['itemDescriptionColor'];
}

// Count Badge Styles
$count_styles = [];
if ( ! empty( $attributes['countColor'] ) ) {
    $count_styles['color'] = $attributes['countColor'];
}
if ( ! empty( $attributes['countBackgroundColor'] ) ) {
    $count_styles['background-color'] = $attributes['countBackgroundColor'];
}
$c_padding = $attributes['countPadding'] ?? [];
if ( ! empty( $c_padding['top'] ) ) $count_styles['padding-top'] = Bold_Post_Helper::ensure_unit( $c_padding['top'] );
if ( ! empty( $c_padding['right'] ) ) $count_styles['padding-right'] = Bold_Post_Helper::ensure_unit( $c_padding['right'] );
if ( ! empty( $c_padding['bottom'] ) ) $count_styles['padding-bottom'] = Bold_Post_Helper::ensure_unit( $c_padding['bottom'] );
if ( ! empty( $c_padding['left'] ) ) $count_styles['padding-left'] = Bold_Post_Helper::ensure_unit( $c_padding['left'] );

$c_border_radius = $attributes['countBorderRadius'] ?? [];
if ( ! empty( $c_border_radius['top'] ) ) $count_styles['border-top-left-radius'] = Bold_Post_Helper::ensure_unit( $c_border_radius['top'] );
if ( ! empty( $c_border_radius['right'] ) ) $count_styles['border-top-right-radius'] = Bold_Post_Helper::ensure_unit( $c_border_radius['right'] );
if ( ! empty( $c_border_radius['bottom'] ) ) $count_styles['border-bottom-left-radius'] = Bold_Post_Helper::ensure_unit( $c_border_radius['bottom'] );
if ( ! empty( $c_border_radius['left'] ) ) $count_styles['border-bottom-right-radius'] = Bold_Post_Helper::ensure_unit( $c_border_radius['left'] );

$c_typo = $attributes['countTypography'] ?? [];
if ( ! empty( $c_typo['fontSize'] ) ) $count_styles['font-size'] = $c_typo['fontSize'];
if ( ! empty( $c_typo['fontWeight'] ) ) $count_styles['font-weight'] = $c_typo['fontWeight'];
if ( ! empty( $c_typo['lineHeight'] ) ) $count_styles['line-height'] = $c_typo['lineHeight'];
if ( ! empty( $c_typo['textTransform'] ) ) $count_styles['text-transform'] = $c_typo['textTransform'];
if ( ! empty( $c_typo['letterSpacing'] ) ) $count_styles['letter-spacing'] = $c_typo['letterSpacing'];

$style_handle = 'bldpst-category-list-style';
$unique_id    = 'bldpst-' . wp_rand( 100, 99999 );
$selector     = '.' . $unique_id;

$full_responsive_css = Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-category-list', $responsive_data);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-category-list.style-' . $style . ' .bldpst-category-item', $item_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-category-list.style-' . $style . ' .bldpst-category-item .bldpst-category-title', $title_responsive);
$full_responsive_css .= Bold_Post_Helper::generate_responsive_css($selector . ' .bldpst-category-list.style-' . $style . ' .bldpst-category-item .bldpst-category-description', $description_responsive);

wp_enqueue_style( $style_handle );
Bold_Post_Helper::add_custom_style( $style_handle, $selector, $full_responsive_css, [
    '.bldpst-category-list .bldpst-category-item .bldpst-category-item:hover'  => Bold_Post_Helper::get_inline_styles($item_hover),
    '.bldpst-category-list .bldpst-category-item .bldpst-category-count'       => Bold_Post_Helper::get_inline_styles($count_styles),
] );

// Build query arguments
$args = array(
    'taxonomy'   => 'category',
    'number'     => (int) $per_page,
    'hide_empty' => $hide_empty,
    'order'      => in_array( $order, ['ASC','DESC'], true ) ? $order : 'ASC',
    'orderby'    => $orderby,
);

if ( ! empty( $attributes['includes'] ) && ! in_array( 'all', $attributes['includes'] ) ) {
    $args['include'] = array_map( 'intval', $attributes['includes'] );
}

if ( ! empty( $attributes['excludes'] ) && ! in_array( 'no-excludes', $attributes['excludes'] ) ) {
    // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude -- User-controlled exclusion is intentional
    $args['exclude'] = array_map( 'intval', $attributes['excludes'] );
}

$categories = get_terms( $args );
$block_wrap_attr = get_block_wrapper_attributes( array( 'class' => 'bldpst-category-list-block-wrap ' . $unique_id ) );

if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
?>
    <div <?php echo wp_kses_post($block_wrap_attr); ?>>
        <div class="bldpst-category-list style-<?php echo esc_attr($style); ?>">
            <?php
            foreach ( $categories as $category ) :
                $category_link = get_term_link( $category );
                if ( is_wp_error( $category_link ) ) {
                    continue;
                }
            ?>
                <div class="bldpst-category-item">
                    <a href="<?php echo esc_url( $category_link ); ?>" class="bldpst-category-link">
                        <div class="bldpst-category-content">
                            <div class="bldpst-category-content-text">
                                <<?php echo esc_attr($title_tag); ?> class="bldpst-category-title">
                                    <?php echo esc_html( $category->name ); ?>
                                </<?php echo esc_attr($title_tag); ?>>
                                <?php if ( $show_description && ! empty( $category->description ) ) : ?>
                                    <div class="bldpst-category-description">
                                        <?php echo esc_html( $category->description ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ( $show_count && ( $category->count > 0 || $show_empty_count ) ) : ?>
                                <span class="bldpst-category-count">
                                    <?php echo esc_html( $category->count ); ?>
                                </span>
                            <?php endif; ?>
                            
                            
                        </div>
                    </a>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
<?php
else:
    ?>
    <div <?php echo wp_kses_post(get_block_wrapper_attributes()); ?>>
        <p><?php esc_html_e('No categories found.', 'bold-post'); ?></p>
    </div>
    <?php
endif;
?>
