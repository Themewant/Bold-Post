<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'bold-post/post-list',
		'version' => '0.1.0',
		'title' => 'Post List',
		'category' => 'bold-post',
		'icon' => 'list',
		'description' => 'Post List Block',
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
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php',
		'attributes' => array(
			'isFeatured' => array(
				'type' => 'boolean',
				'default' => false
			),
			'listStyle' => array(
				'type' => 'string',
				'default' => 'default'
			),
			'columns' => array(
				'type' => 'string',
				'default' => '1'
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
			'itemTitleMargin' => array(
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
			'itemExcerptMargin' => array(
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
			'itemColGap' => array(
				'type' => 'string',
				'default' => '20px'
			),
			'itemRowGap' => array(
				'type' => 'string',
				'default' => '30px'
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
				'default' => false
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
				'default' => '30'
			),
			'excerptTrim' => array(
				'type' => 'string',
				'default' => '60'
			),
			'animStyle' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbAnim' => array(
				'type' => 'boolean',
				'default' => true
			),
			'contentAlignVertical' => array(
				'type' => 'string',
				'default' => 'center'
			),
			'itemContentPadding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '30px',
					'right' => '20px',
					'bottom' => '30px',
					'left' => '20px'
				)
			),
			'pagination' => array(
				'type' => 'boolean',
				'default' => true
			),
			'paginationColor' => array(
				'type' => 'string',
				'default' => 'var(--bldpst-preset-color-contrast-2)'
			),
			'paginationColorHover' => array(
				'type' => 'string',
				'default' => 'var(--bldpst-preset-color-white)'
			),
			'paginationBackgroundColor' => array(
				'type' => 'string',
				'default' => 'var(--bldpst-preset-color-tertiary)'
			),
			'paginationBackgroundColorHover' => array(
				'type' => 'string',
				'default' => 'var(--bldpst-preset-color-primary)'
			),
			'columnsTablet' => array(
				'type' => 'string',
				'default' => '2'
			),
			'columnsMobile' => array(
				'type' => 'string',
				'default' => '1'
			),
			'itemRowGapTablet' => array(
				'type' => 'string',
				'default' => '30px'
			),
			'itemRowGapMobile' => array(
				'type' => 'string',
				'default' => '30px'
			),
			'itemColGapTablet' => array(
				'type' => 'string',
				'default' => '20px'
			),
			'itemColGapMobile' => array(
				'type' => 'string',
				'default' => '20px'
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
			)
		)
	)
);
