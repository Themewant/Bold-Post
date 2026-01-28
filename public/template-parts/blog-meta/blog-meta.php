<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$bldpst_allowed_metas = isset($attributes['allowedMetas']) ? $attributes['allowedMetas'] : [];
$bldpst_meta_html = '';
if ( in_array( 'date', $bldpst_allowed_metas ) && empty($attributes['showDateOnTop'])) {
    $bldpst_meta_html .= '<span class="bldpost-meta"><i class="bldpst-meta-icon bldpst-icon-calendar-two"></i>' . esc_html( get_the_date() ) . '</span>';
}
if ( in_array( 'author', $bldpst_allowed_metas ) ) {
    $bldpst_meta_html .= '<span class="bldpost-meta"><i class="bldpst-meta-icon bldpst-icon-user-avatar"></i>' . esc_html( get_the_author() ) . '</span>';
}
if ( in_array( 'category', $bldpst_allowed_metas ) ) {
    $bldpst_categories = get_the_category();
    $bldpst_first_category = !empty($bldpst_categories) ? $bldpst_categories[0] : ''; 
    if($bldpst_first_category) {
        $bldpst_meta_html .= '<span class="bldpost-meta"><a href="' . esc_url(get_category_link($bldpst_first_category->term_id)) . '"><i class="bldpst-meta-icon bldpst-icon-notification-status"></i>' . esc_html( $bldpst_first_category->name ) . '</a></span>';
    }
    
}
if ( in_array( 'tag', $bldpst_allowed_metas ) ) {
    $bldpst_tags = get_the_tags();
    $bldpst_first_tag = !empty($bldpst_tags) ? $bldpst_tags[0] : '';  
    if($bldpst_first_tag) {
        $bldpst_meta_html .= '<a href="' . esc_url(get_tag_link($bldpst_first_tag->term_id)) . '"><i class="bldpst-meta-icon bldpst-icon-tags"></i>' . esc_html( $bldpst_first_tag->name ) . '</a>';
    }
}
?>
<div class="bldpst-blog-metas">
    <?php 
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- HTML is escaped during generation
    echo wp_kses_post( $bldpst_meta_html ); 
    ?>
</div>