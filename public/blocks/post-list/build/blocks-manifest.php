<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'boldpost/post-list',
		'version' => '0.1.0',
		'title' => 'Post List',
		'category' => 'boldpost',
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
		'textdomain' => 'boldpost',
		'editorScript' => 'file:./index.js',
		'viewScript' => 'file:./view.js',
		'render' => 'file:./render.php',
		'attributes' => array(
			'blockId' => array(
				'type' => 'string',
				'default' => ''
			),
			'ignoreStikcyPosts' => array(
				'type' => 'boolean',
				'default' => true
			),
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
				'default' => 'medium'
			),
			'thumbnailHeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbnailHeightTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbnailHeightMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbnailWidth' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbnailWidthTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'thumbnailWidthMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'perPage' => array(
				'type' => 'string',
				'default' => '6'
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
				'default' => ''
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
			'itemBorderRadius' => array(
				'type' => 'object'
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
			'itemTitlePadding' => array(
				'type' => 'object'
			),
			'itemTitleMargin' => array(
				'type' => 'object'
			),
			'itemExcerptPadding' => array(
				'type' => 'object'
			),
			'itemExcerptMargin' => array(
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
			'metaTypography' => array(
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
			'readMoreBorder' => array(
				'type' => 'object',
				'default' => array(
					'width' => 0,
					'color' => '',
					'style' => 'solid'
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
			'itemGap' => array(
				'type' => 'string',
				'default' => '4'
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
					'date'
				)
			),
			'authorPrefix' => array(
				'type' => 'string',
				'default' => 'by'
			),
			'metaPosition' => array(
				'type' => 'string',
				'default' => 'below_title'
			),
			'metaColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaIconColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaIconColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'metaMargin' => array(
				'type' => 'object'
			),
			'metaStyle' => array(
				'type' => 'string',
				'default' => 'default'
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
				'default' => ''
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
				'type' => 'object'
			),
			'pagination' => array(
				'type' => 'boolean',
				'default' => true
			),
			'paginationColor' => array(
				'type' => 'string',
				'default' => 'var(--boldpo-preset-color-contrast-2)'
			),
			'paginationColorHover' => array(
				'type' => 'string',
				'default' => 'var(--boldpo-preset-color-white)'
			),
			'paginationBackgroundColor' => array(
				'type' => 'string',
				'default' => 'var(--boldpo-preset-color-tertiary)'
			),
			'paginationBackgroundColorHover' => array(
				'type' => 'string',
				'default' => 'var(--boldpo-preset-color-primary)'
			),
			'paginationBtnWidth' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBtnWidthTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBtnWidthMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBtnHeight' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBtnHeightTablet' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBtnHeightMobile' => array(
				'type' => 'string',
				'default' => ''
			),
			'paginationBoxShadow' => array(
				'type' => 'object',
				'default' => array(
					'x' => 0,
					'y' => 5,
					'b' => 10,
					's' => 0,
					'c' => 'rgba(14, 13, 13, 0.1)'
				)
			),
			'paginationBtnBorder' => array(
				'type' => 'object',
				'default' => array(
					'width' => 0,
					'color' => '',
					'style' => 'solid'
				)
			),
			'paginationBtnBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					
				)
			),
			'paginationBtnPadding' => array(
				'type' => 'object'
			),
			'paginationBtnPaddingTablet' => array(
				'type' => 'object'
			),
			'paginationBtnPaddingMobile' => array(
				'type' => 'object'
			),
			'paginationWrapMargin' => array(
				'type' => 'object'
			),
			'paginationWrapMarginTablet' => array(
				'type' => 'object'
			),
			'paginationWrapMarginMobile' => array(
				'type' => 'object'
			),
			'columnsTablet' => array(
				'type' => 'string',
				'default' => '1'
			),
			'columnsMobile' => array(
				'type' => 'string',
				'default' => '1'
			),
			'itemRowGap' => array(
				'type' => 'string',
				'default' => '4'
			),
			'itemRowGapTablet' => array(
				'type' => 'string',
				'default' => '3'
			),
			'itemRowGapMobile' => array(
				'type' => 'string',
				'default' => '3'
			),
			'itemPaddingTablet' => array(
				'type' => 'object'
			),
			'itemPaddingMobile' => array(
				'type' => 'object'
			),
			'itemTitlePaddingTablet' => array(
				'type' => 'object'
			),
			'itemTitlePaddingMobile' => array(
				'type' => 'object'
			),
			'itemTitleMarginTablet' => array(
				'type' => 'object'
			),
			'itemTitleMarginMobile' => array(
				'type' => 'object'
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
				'type' => 'object'
			),
			'itemExcerptPaddingMobile' => array(
				'type' => 'object'
			),
			'itemExcerptMarginTablet' => array(
				'type' => 'object'
			),
			'itemExcerptMarginMobile' => array(
				'type' => 'object'
			),
			'contentPaddingTablet' => array(
				'type' => 'object'
			),
			'contentPaddingMobile' => array(
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
			),
			'itemSerialColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemSerialTypography' => array(
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
			'itemSerialTypographyTablet' => array(
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
			'itemSerialTypographyMobile' => array(
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
			'thumbnailBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => ''
				)
			),
			'categoryColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'categoryColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'categoryBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'categoryBackgroundColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'categoryPadding' => array(
				'type' => 'object'
			),
			'categoryMargin' => array(
				'type' => 'object'
			)
		)
	)
);
