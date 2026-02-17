<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'boldpost/post-slider',
		'version' => '0.1.0',
		'title' => 'Post Slider',
		'category' => 'boldpost',
		'icon' => 'slider',
		'description' => 'Post Slider Block',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'padding' => true,
				'margin' => true
			),
			'color' => array(
				'background' => true,
				'text' => false,
				'gradients' => true
			)
		),
		'textdomain' => 'boldpost',
		'editorScript' => 'file:./index.js',
		'script' => 'file:./view.js',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php',
		'attributes' => array(
			'ignoreStikcyPosts' => array(
				'type' => 'boolean',
				'default' => false
			),
			'isFeatured' => array(
				'type' => 'boolean',
				'default' => false
			),
			'sliderStyle' => array(
				'type' => 'string',
				'default' => 'default'
			),
			'thumbnailSize' => array(
				'type' => 'string',
				'default' => 'eshb_thumbnail'
			),
			'thumbnailHeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'perPage' => array(
				'type' => 'string',
				'default' => '9'
			),
			'order' => array(
				'type' => 'string',
				'default' => 'ASC'
			),
			'orderby' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'offset' => array(
				'type' => 'string',
				'default' => '0'
			),
			'categories' => array(
				'type' => 'array',
				'default' => array(
					'all'
				)
			),
			'excludes' => array(
				'type' => 'array',
				'default' => array(
					'no-excludes'
				)
			),
			'posts' => array(
				'type' => 'array',
				'default' => array(
					'all'
				)
			),
			'itemPadding' => array(
				'type' => 'object'
			),
			'itemPaddingTablet' => array(
				'type' => 'object'
			),
			'itemPaddingMobile' => array(
				'type' => 'object'
			),
			'itemBorderRadius' => array(
				'type' => 'object'
			),
			'itemTitlePadding' => array(
				'type' => 'object'
			),
			'itemTitlePaddingTablet' => array(
				'type' => 'object'
			),
			'itemTitlePaddingMobile' => array(
				'type' => 'object'
			),
			'itemTitleMargin' => array(
				'type' => 'object'
			),
			'itemTitleMarginTablet' => array(
				'type' => 'object'
			),
			'itemTitleMarginMobile' => array(
				'type' => 'object'
			),
			'itemExcerptPadding' => array(
				'type' => 'object'
			),
			'itemExcerptPaddingTablet' => array(
				'type' => 'object'
			),
			'itemExcerptPaddingMobile' => array(
				'type' => 'object'
			),
			'itemExcerptMargin' => array(
				'type' => 'object'
			),
			'itemExcerptMarginTablet' => array(
				'type' => 'object'
			),
			'itemExcerptMarginMobile' => array(
				'type' => 'object'
			),
			'itemTitleTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'itemTitleTypographyTablet' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'itemTitleTypographyMobile' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'itemExcerptTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'itemExcerptTypographyTablet' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'itemExcerptTypographyMobile' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'columnsTablet' => array(
				'type' => 'string',
				'default' => '2'
			),
			'columnsMobile' => array(
				'type' => 'string',
				'default' => '1'
			),
			'readMorePadding' => array(
				'type' => 'object'
			),
			'readMoreMargin' => array(
				'type' => 'object'
			),
			'readMoreTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '',
					'letterSpacing' => ''
				)
			),
			'readMoreBorderRadius' => array(
				'type' => 'object'
			),
			'itemBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBackgroundColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBackgroundGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBackgroundGradientHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemOverlayBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemOverlayBackgroundColorHover' => array(
				'type' => 'string',
				'default' => 'var(--eshb-primary-color)'
			),
			'itemOverlayBackgroundGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemOverlayBackgroundGradientHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemOverlayBackgroundGradientTwo' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemOverlayBackgroundGradientTwoHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemBoxShadow' => array(
				'type' => 'object',
				'default' => array(
					'x' => 0,
					'y' => 0,
					'b' => 0,
					's' => 0,
					'c' => 'rgba(0, 0, 0, 0)'
				)
			),
			'itemBorder' => array(
				'type' => 'object',
				'default' => array(
					'width' => 0,
					'color' => '',
					'style' => 'solid'
				)
			),
			'itemTitleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemTitleColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemExcerptColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'contentPadding' => array(
				'type' => 'object'
			),
			'readMoreBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'readMoreBackgroundColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'readMoreBackgroundGradient' => array(
				'type' => 'string',
				'default' => ''
			),
			'readMoreBackgroundGradientHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'readMoreColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'readMoreColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'showThumbnail' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showMeta' => array(
				'type' => 'boolean',
				'default' => true
			),
			'allowedMetas' => array(
				'type' => 'array',
				'default' => array(
					'author',
					'date',
					'category',
					'tag'
				)
			),
			'metaPosition' => array(
				'type' => 'string',
				'default' => 'below_title'
			),
			'metaColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaMargin' => array(
				'type' => 'object'
			),
			'titleTag' => array(
				'type' => 'string',
				'default' => 'h3'
			),
			'showExcerpt' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showReadMore' => array(
				'type' => 'boolean',
				'default' => true
			),
			'readMoreText' => array(
				'type' => 'string',
				'default' => 'Read More'
			),
			'readMoreIcon' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'readMoreIconPosition' => array(
				'type' => 'string',
				'default' => 'after'
			),
			'onlyIconShow' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showDateOnTop' => array(
				'type' => 'boolean',
				'default' => true
			),
			'topDateBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'topDateColor' => array(
				'type' => 'string',
				'default' => '#ffffff'
			),
			'titleTrim' => array(
				'type' => 'string',
				'default' => '100'
			),
			'excerptTrim' => array(
				'type' => 'string',
				'default' => '20'
			),
			'animStyle' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbAnim' => array(
				'type' => 'boolean',
				'default' => true
			),
			'slidesPerView' => array(
				'type' => 'string',
				'default' => '3'
			),
			'slidesPerViewTablet' => array(
				'type' => 'string',
				'default' => '2'
			),
			'slidesPerViewMobile' => array(
				'type' => 'string',
				'default' => '1'
			),
			'slidesPerViewMobileSmall' => array(
				'type' => 'string',
				'default' => '1'
			),
			'slidesToScroll' => array(
				'type' => 'string',
				'default' => '1'
			),
			'spaceBetween' => array(
				'type' => 'string',
				'default' => '15'
			),
			'centeredSlides' => array(
				'type' => 'boolean',
				'default' => false
			),
			'effect' => array(
				'type' => 'string',
				'default' => 'slide'
			),
			'speed' => array(
				'type' => 'string',
				'default' => '2000'
			),
			'loop' => array(
				'type' => 'boolean',
				'default' => false
			),
			'autoplay' => array(
				'type' => 'boolean',
				'default' => false
			),
			'pauseOnHover' => array(
				'type' => 'boolean',
				'default' => false
			),
			'pauseOnInter' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showNav' => array(
				'type' => 'boolean',
				'default' => true
			),
			'navBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'navBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'navColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'navColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'navBorderRadius' => array(
				'type' => 'object'
			),
			'showDots' => array(
				'type' => 'boolean',
				'default' => false
			),
			'dotsBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'dotsBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'dotsColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'dotsColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'dotsBorderRadius' => array(
				'type' => 'object'
			),
			'contentTextAlign' => array(
				'type' => 'string',
				'default' => 'left'
			),
			'contentTextAlignTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'contentTextAlignMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextAlignTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'titleTextAlignMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'excerptTextAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'excerptTextAlignTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'excerptTextAlignMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'buttonTextAlign' => array(
				'type' => 'string',
				'default' => ''
			),
			'buttonTextAlignTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'buttonTextAlignMobile' => array(
				'type' => 'string',
				'default' => ''
			)
		)
	)
);
