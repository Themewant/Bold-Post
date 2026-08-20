<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$items      = isset( $attributes['items'] ) ? $attributes['items'] : array();
$show_label = ! empty( $attributes['showLabel'] );
$alignment  = isset( $attributes['alignment'] ) ? $attributes['alignment'] : 'left';

$icon_size        = isset( $attributes['iconSize'] ) ? intval( $attributes['iconSize'] ) : 20;
$icon_size_tablet = isset( $attributes['iconSizeTablet'] ) ? intval( $attributes['iconSizeTablet'] ) : null;
$icon_size_mobile = isset( $attributes['iconSizeMobile'] ) ? intval( $attributes['iconSizeMobile'] ) : null;

$gap        = isset( $attributes['gap'] ) ? intval( $attributes['gap'] ) : 10;
$gap_tablet = isset( $attributes['gapTablet'] ) ? intval( $attributes['gapTablet'] ) : null;
$gap_mobile = isset( $attributes['gapMobile'] ) ? intval( $attributes['gapMobile'] ) : null;

$icon_padding       = isset( $attributes['iconPadding'] ) ? $attributes['iconPadding'] : array();
$icon_border_radius = isset( $attributes['iconBorderRadius'] ) ? sanitize_text_field( $attributes['iconBorderRadius'] ) : '4px';
$icon_border_width  = isset( $attributes['iconBorderWidth'] ) ? intval( $attributes['iconBorderWidth'] ) : 0;

$icon_color              = isset( $attributes['iconColor'] ) ? $attributes['iconColor'] : '';
$icon_color_hover        = isset( $attributes['iconColorHover'] ) ? $attributes['iconColorHover'] : '';
$icon_bg_color           = isset( $attributes['iconBgColor'] ) ? $attributes['iconBgColor'] : '';
$icon_bg_color_hover     = isset( $attributes['iconBgColorHover'] ) ? $attributes['iconBgColorHover'] : '';
$icon_border_color       = isset( $attributes['iconBorderColor'] ) ? $attributes['iconBorderColor'] : '';
$icon_border_color_hover = isset( $attributes['iconBorderColorHover'] ) ? $attributes['iconBorderColorHover'] : '';
$label_color             = isset( $attributes['labelColor'] ) ? $attributes['labelColor'] : '';
$label_color_hover       = isset( $attributes['labelColorHover'] ) ? $attributes['labelColorHover'] : '';
$label_typography        = isset( $attributes['labelTypography'] ) ? $attributes['labelTypography'] : array();

$style_handle = 'boldpo-social-icons-style';
$unique_id    = 'boldpo-' . wp_rand( 100, 99999 );
$selector     = '.' . $unique_id;

// --- Build responsive CSS ---
$wrap_desktop = array();
$wrap_tablet  = array();
$wrap_mobile  = array();

// Alignment
$justify_map = array(
    'left'   => 'flex-start',
    'center' => 'center',
    'right'  => 'flex-end',
);
$wrap_desktop['justify-content'] = isset( $justify_map[ $alignment ] ) ? $justify_map[ $alignment ] : 'flex-start';

// Gap
$wrap_desktop['gap'] = $gap . 'px';
if ( null !== $gap_tablet ) $wrap_tablet['gap']  = $gap_tablet . 'px';
if ( null !== $gap_mobile ) $wrap_mobile['gap']  = $gap_mobile . 'px';

// Wrap responsive CSS
$wrap_responsive = array(
    'desktop' => $wrap_desktop,
    'tablet'  => $wrap_tablet,
    'mobile'  => $wrap_mobile,
);

// Icon item CSS
$item_desktop = array();

if ( ! empty( $icon_padding ) ) {
    if ( ! empty( $icon_padding['top'] ) )    $item_desktop['padding-top']    = BOLDPO_Helper::ensure_unit( $icon_padding['top'] );
    if ( ! empty( $icon_padding['right'] ) )  $item_desktop['padding-right']  = BOLDPO_Helper::ensure_unit( $icon_padding['right'] );
    if ( ! empty( $icon_padding['bottom'] ) ) $item_desktop['padding-bottom'] = BOLDPO_Helper::ensure_unit( $icon_padding['bottom'] );
    if ( ! empty( $icon_padding['left'] ) )   $item_desktop['padding-left']   = BOLDPO_Helper::ensure_unit( $icon_padding['left'] );
}
if ( ! empty( $icon_border_radius ) ) $item_desktop['border-radius'] = $icon_border_radius;
if ( $icon_border_width > 0 )  $item_desktop['border-width']  = $icon_border_width . 'px';
if ( ! empty( $icon_bg_color ) )     $item_desktop['background-color'] = $icon_bg_color . ' !important';
if ( ! empty( $icon_border_color ) ) $item_desktop['border-color']     = $icon_border_color . ' !important';
if ( $icon_border_width > 0 )        $item_desktop['border-style']     = 'solid';

$item_responsive = array( 'desktop' => $item_desktop, 'tablet' => array(), 'mobile' => array() );

// Icon (i element) responsive
$icon_el_desktop = array();
$icon_el_tablet  = array();
$icon_el_mobile  = array();

if ( ! empty( $icon_color ) )   $icon_el_desktop['color'] = $icon_color . ' !important';
$icon_el_desktop['font-size'] = $icon_size . 'px';
if ( null !== $icon_size_tablet ) $icon_el_tablet['font-size'] = $icon_size_tablet . 'px';
if ( null !== $icon_size_mobile ) $icon_el_mobile['font-size'] = $icon_size_mobile . 'px';

$icon_el_responsive = array(
    'desktop' => $icon_el_desktop,
    'tablet'  => $icon_el_tablet,
    'mobile'  => $icon_el_mobile,
);

// Label CSS
$label_desktop = array();
if ( ! empty( $label_color ) )        $label_desktop['color'] = $label_color;
if ( ! empty( $label_typography ) ) {
    if ( ! empty( $label_typography['fontSize'] ) )      $label_desktop['font-size']      = $label_typography['fontSize'];
    if ( ! empty( $label_typography['fontWeight'] ) )    $label_desktop['font-weight']    = $label_typography['fontWeight'];
    if ( ! empty( $label_typography['fontStyle'] ) )     $label_desktop['font-style']     = $label_typography['fontStyle'];
    if ( ! empty( $label_typography['textTransform'] ) ) $label_desktop['text-transform'] = $label_typography['textTransform'];
    if ( ! empty( $label_typography['lineHeight'] ) )    $label_desktop['line-height']    = $label_typography['lineHeight'];
    if ( ! empty( $label_typography['letterSpacing'] ) ) $label_desktop['letter-spacing'] = $label_typography['letterSpacing'];
}
$label_responsive = array( 'desktop' => $label_desktop, 'tablet' => array(), 'mobile' => array() );

// Hover states (inline rules)
$hover_extra = array();
if ( ! empty( $icon_color_hover ) ) {
    $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover .boldpo-icon' ] = 'color:' . $icon_color_hover . ' !important;';
}
if ( ! empty( $icon_bg_color_hover ) ) {
    $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover' ] = ( $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover' ] ?? '' ) . 'background-color:' . $icon_bg_color_hover . ' !important;';
}
if ( ! empty( $icon_border_color_hover ) ) {
    $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover' ] = ( $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover' ] ?? '' ) . 'border-color:' . $icon_border_color_hover . ' !important;';
}
if ( ! empty( $label_color_hover ) ) {
    $hover_extra[ $selector . ' .boldpo-social-icons .boldpo-social-icon-item:hover .boldpo-social-icon-label' ] = 'color:' . $label_color_hover . ' !important;';
}

// Generate full CSS
$full_css  = BOLDPO_Helper::generate_responsive_css( $selector . ' .boldpo-social-icons', $wrap_responsive );
$full_css .= BOLDPO_Helper::generate_responsive_css( $selector . ' .boldpo-social-icons .boldpo-social-icon-item', $item_responsive );
$full_css .= BOLDPO_Helper::generate_responsive_css( $selector . ' .boldpo-social-icons .boldpo-social-icon-item .boldpo-icon', $icon_el_responsive );
$full_css .= BOLDPO_Helper::generate_responsive_css( $selector . ' .boldpo-social-icons .boldpo-social-icon-label', $label_responsive );

// Add hover rules as extra
foreach ( $hover_extra as $hover_selector => $hover_rules ) {
    $full_css .= $hover_selector . '{' . $hover_rules . '}';
}

wp_enqueue_style( $style_handle );
BOLDPO_Helper::add_custom_style( $style_handle, $selector, $full_css, array() );

$block_wrap_attr = get_block_wrapper_attributes( array( 'class' => 'boldpo-block boldpo-social-icons-block-wrap ' . $unique_id ) );
?>
<div <?php echo wp_kses_post( $block_wrap_attr ); ?>>
    <div class="boldpo-social-icons style-<?php echo esc_attr( $attributes['layoutStyle'] ); ?>">
        <?php foreach ( $items as $item ) :
            $icon        = isset( $item['icon'] ) ? $item['icon'] : '';
            $url         = isset( $item['url'] ) ? $item['url'] : '#';
            $label       = isset( $item['label'] ) ? $item['label'] : '';
            $open_new    = ! empty( $item['openNewTab'] );
            $target      = $open_new ? ' target="_blank" rel="noopener noreferrer"' : '';

            if ( empty( $icon ) || $icon === 'none' ) continue;
        ?>
            <a href="<?php echo esc_url( $url ); ?>"
               class="boldpo-social-icon-item"
               aria-label="<?php echo esc_attr( $label ? $label : $icon ); ?>"
               <?php echo $target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
                <i class="boldpo-icon <?php echo esc_attr( $icon ); ?>"></i>
                <?php if ( $show_label && ! empty( $label ) ) : ?>
                    <span class="boldpo-social-icon-label"><?php echo esc_html( $label ); ?></span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
