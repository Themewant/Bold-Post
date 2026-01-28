<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bold-post/post-slider',
		'version' => '0.1.0',
		'title' => 'Post Slider',
		'category' => 'bold-post',
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
		'textdomain' => 'bold-post',
		'editorScript' => 'file:./index.js',
		'script' => 'file:./view.js',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php',
		'attributes' => array(
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
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemPaddingTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemPaddingMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitlePadding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitlePaddingTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitlePaddingMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitleMargin' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitleMarginTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemTitleMarginMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptPadding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptPaddingTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptPaddingMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptMargin' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptMarginTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'itemExcerptMarginMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
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
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
			),
			'readMoreMargin' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
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
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '0px'
				)
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
			'nextBtnBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '20px',
					'right' => '0px',
					'bottom' => '0px',
					'left' => '20px'
				)
			),
			'prevBtnBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '20px',
					'bottom' => '20px',
					'left' => '0px'
				)
			),
			'navBtnBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'navBtnBgColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'navBtnColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'navBtnColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'dotsBgColor' => array(
				'type' => 'string',
				'default' => ''
			)
		)
	)
);
