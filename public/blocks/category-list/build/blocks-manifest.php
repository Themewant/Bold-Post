<?php
// This file is generated. Do not modify it manually.
return array(
	'build' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'boldpost/category-list',
		'version' => '0.1.0',
		'title' => 'Category List',
		'category' => 'boldpost',
		'icon' => 'category',
		'description' => 'Display a list of categories with customizable styles',
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
			'listStyle' => array(
				'type' => 'string',
				'default' => '1'
			),
			'columns' => array(
				'type' => 'string',
				'default' => '1'
			),
			'columnsTablet' => array(
				'type' => 'string',
				'default' => '1'
			),
			'columnsMobile' => array(
				'type' => 'string',
				'default' => '1'
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
				'default' => 'name'
			),
			'hideEmpty' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showCount' => array(
				'type' => 'boolean',
				'default' => true
			),
			'showEmptyCount' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showDescription' => array(
				'type' => 'boolean',
				'default' => false
			),
			'excludes' => array(
				'type' => 'array',
				'default' => array(
					'no-excludes'
				)
			),
			'includes' => array(
				'type' => 'array',
				'default' => array(
					'all'
				)
			),
			'itemPadding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '10px',
					'right' => '10px',
					'bottom' => '10px',
					'left' => '10px'
				)
			),
			'itemPaddingTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '10px',
					'right' => '10px',
					'bottom' => '10px',
					'left' => '10px'
				)
			),
			'itemPaddingMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '10px',
					'right' => '10px',
					'bottom' => '10px',
					'left' => '10px'
				)
			),
			'itemBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => ''
				)
			),
			'itemGap' => array(
				'type' => 'string',
				'default' => '10px'
			),
			'itemGapTablet' => array(
				'type' => 'string',
				'default' => '20px'
			),
			'itemGapMobile' => array(
				'type' => 'string',
				'default' => '20px'
			),
			'itemTitleMargin' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '10px',
					'left' => '0px'
				)
			),
			'itemTitleMarginTablet' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '10px',
					'left' => '0px'
				)
			),
			'itemTitleMarginMobile' => array(
				'type' => 'object',
				'default' => array(
					'top' => '0px',
					'right' => '0px',
					'bottom' => '10px',
					'left' => '0px'
				)
			),
			'itemDescriptionMargin' => array(
				'type' => 'object'
			),
			'itemDescriptionMarginTablet' => array(
				'type' => 'object'
			),
			'itemDescriptionMarginMobile' => array(
				'type' => 'object'
			),
			'itemTitleTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '18px',
					'fontWeight' => '600',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '1.4',
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
			'itemDescriptionTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '14px',
					'fontWeight' => '',
					'fontStyle' => '',
					'textTransform' => '',
					'lineHeight' => '1.6',
					'letterSpacing' => ''
				)
			),
			'itemDescriptionTypographyTablet' => array(
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
			'itemDescriptionTypographyMobile' => array(
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
			'countTypography' => array(
				'type' => 'object',
				'default' => array(
					'fontFamily' => '',
					'fontSize' => '14px',
					'fontWeight' => '500',
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
			'itemTitleColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemTitleColorHover' => array(
				'type' => 'string',
				'default' => ''
			),
			'itemDescriptionColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'countColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'countBackgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'countPadding' => array(
				'type' => 'object',
				'default' => array(
					'top' => '',
					'right' => '',
					'bottom' => '',
					'left' => ''
				)
			),
			'countBorderRadius' => array(
				'type' => 'object',
				'default' => array(
					'top' => '12px',
					'right' => '12px',
					'bottom' => '12px',
					'left' => '12px'
				)
			),
			'titleTag' => array(
				'type' => 'string',
				'default' => 'h3'
			)
		)
	)
);
