<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="bldpst-list-item <?php echo esc_attr( $anim_style ); ?>">
    <div class="bldpst-list-item-inner">
        
        <div class="bldpst-blog-img <?php echo esc_attr( $thumb_anim ); ?> <?php echo esc_attr( $anim_style ); ?>">
            <?php if( $show_date_on_top === 'yes' ): ?>
                <div class="bldpst-blog-date-top">
                    <h4><?php echo esc_html( get_the_time('d') ); ?></h4>
                    <span><?php echo esc_html( get_the_time('M') ); ?></span>
                </div>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>">
            <?php
                if ( has_post_thumbnail() ) {
                    // Simple size for now
                    the_post_thumbnail( $thumbnail_size );
                } else {
                    echo '<img src="' . esc_url( plugins_url( 'public/assets/img/placeholder.png', dirname(dirname(dirname(__DIR__))) ) ) . '" alt="Placeholder">';
                }
            ?>
            <?php if ( '1' == $style ) { ?>
                <div class="bldpst-overlay-all"></div>
            <?php } ?>
            </a>
        </div>
        <div class="bldpst-blog-content">
            <?php if ( $show_meta && 'up_title' === $meta_position ) include( BLDPST_PL_PATH . 'public/template-parts/blog-meta/blog-meta.php' ); ?>
            
            <<?php echo esc_attr( $title_tag ); ?> class="bldpst-blog-title">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html( $trimmed_title ); ?></a>
            </<?php echo esc_attr( $title_tag ); ?>>

            <?php if ( $show_meta && 'below_title' === $meta_position ) include( BLDPST_PL_PATH . 'public/template-parts/blog-meta/blog-meta.php' ); ?>
            
            <?php if ( $show_excerpt === 'yes' ) : ?>
            <div class="bldpst-blog-excerpt">
                <?php echo esc_html( $trimmed_excerpt ); ?>
            </div>
            <?php endif; ?>
            
            <?php if ( $show_meta && 'below_content' === $meta_position ) include( BLDPST_PL_PATH . 'public/template-parts/blog-meta/blog-meta.php' ); ?>
            <?php if ( $show_read_more === 'yes' && ! empty( $read_more_text ) ) : ?>
            <div class="bldpst-read-more">
                <a href="<?php the_permalink(); ?>" class="bldpst-read-more-link">
                    <?php if ( $read_more_icon_pos === 'before' ) echo $read_more_icon ? '<i class="' . esc_attr( $read_more_icon ) . ' bldpst-read-more-icon before"></i>' : ''; ?>
                    <?php echo esc_html( $read_more_text ); ?>
                    <?php if ( $read_more_icon_pos === 'after' ) echo $read_more_icon ? '<i class="' . esc_attr( $read_more_icon ) . ' bldpst-read-more-icon after"></i>' : ''; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>