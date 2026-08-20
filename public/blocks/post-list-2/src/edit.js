/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { decodeEntities } from '@wordpress/html-entities';
import { applyFilters } from '@wordpress/hooks';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

import {
	PanelBody,
	__experimentalHeading as Heading,
	BoxControl,
	__experimentalDivider as Divider,
	TabPanel,
	__experimentalNumberControl as NumberControl,
	TextControl,
	SelectControl,
	ToggleControl
} from '@wordpress/components';
import BackgroundControl from '../../custom-components/BackgroundControl';
import TypographyControls from '../../custom-components/TypographyControls';
import ColorPopover from '../../custom-components/ColorPopover';
import ImageRadioControl from '../../custom-components/ImageRadioControl';
import ResponsiveWrapper from '../../custom-components/ResponsiveWrapper';
import RangeControlWithUnit from '../../custom-components/RangeControlWithUnit';
import TextAlignControl from '../../custom-components/TextAlignControl';
import BoxShadowControl from '../../custom-components/BoxShadowControls';
import BorderControl from '../../custom-components/BorderControl';
import IconPicker from '../../custom-components/IconPicker';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import layout1 from './assets/img/layout-1.png';
import layout2 from './assets/img/layout-2.png';
import layout3 from './assets/img/layout-3.png';
import layout4 from './assets/img/layout-4.png';
import layout5 from './assets/img/layout-5.png';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
import { useState, useEffect } from '@wordpress/element';
import { ServerSideRender } from '@wordpress/server-side-render';
import metadata from './block.json';

export default function Edit({ attributes, setAttributes }) {

	const FREE_PAGINATION_VALUES = ['numeric'];
	const PRO_UPGRADE_URL = 'https://themewant.com/plugins/boldpost/pricing/';
	const isLicenseActive = typeof boldpostProData !== 'undefined' && boldpostProData.is_license_active === '1';

	const paginationOptions = applyFilters(
		'boldpost.post-list-2.pagination_options',
		[
			{ label: __('Numeric', 'boldpost'), value: 'numeric' }
		],
		{ attributes, setAttributes }
	);

	useEffect(() => {
		const id = 'boldpo-' + Math.random().toString(36).substr(2, 5);
		setAttributes({ blockId: id });
	}, []);

	const getAttrKey = (base, device) => {
		if (device === 'desktop') return base;
		return `${base}${device.charAt(0).toUpperCase() + device.slice(1)}`;
	};

	const categories = useSelect(
		(select) =>
			select('core').getEntityRecords(
				'taxonomy',
				'category',
				{ per_page: -1 }
			),
		[]
	);

	let categoriesOptions = (categories || []).map((category) => ({
		label: decodeEntities(category.name),
		value: category.slug,
	}));

	categoriesOptions.unshift({ label: __('All Categories', 'boldpost'), value: 'all' });

	const imageSizeOptions = useSelect((select) => {
		const blockEditorStore = select('core/block-editor');
		const editorStore = select('core'); // Testing 'core' store as well

		const blockEditorSettings = blockEditorStore && typeof blockEditorStore.getSettings === 'function' ? blockEditorStore.getSettings() : null;
		const coreSettings = editorStore && typeof editorStore.getSettings === 'function' ? editorStore.getSettings() : null;

		const sizes = blockEditorSettings?.imageSizes || coreSettings?.imageSizes;

		let options = [];

		if (sizes && Array.isArray(sizes)) {
			options = sizes.map((size) => ({
				label: size.name,
				value: size.slug,
			}));
		} else {
			options = [
				{ label: __('Large', 'boldpost'), value: 'large' },
				{ label: __('Medium', 'boldpost'), value: 'medium' },
				{ label: __('Thumbnail', 'boldpost'), value: 'thumbnail' },
			];
		}

		return options;
	}, []);

	const posts = useSelect(
		(select) =>
			select('core').getEntityRecords(
				'postType',
				'post',
				{ per_page: -1 }
			),
		[]
	);

	let postsOptions = (posts || []).map((post) => ({
		label: decodeEntities(post.title.rendered),
		value: post.id,
	}));



	let excludesOptions = [...postsOptions];
	let includesOptions = postsOptions.filter(opt => !(Array.isArray(attributes.excludes) ? attributes.excludes : []).includes(opt.value));

	// add no excludes
	excludesOptions.unshift({ label: __('No Excludes', 'boldpost'), value: 'no-excludes' });

	// add all
	includesOptions.unshift({ label: __('All', 'boldpost'), value: 'all' });

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				{/* {query panel group} */}
				<PanelBody title={__('Query', 'boldpost')} initialOpen={false}>
					<NumberControl
						label={__('Per Page', 'boldpost')}
						value={attributes.perPage}
						onChange={(value) => setAttributes({ perPage: value })}
						help={__('Number of items to display.', 'boldpost')}
						__next40pxDefaultSize={true}
					/>
					<SelectControl
						label={__('Includes', 'boldpost')}
						value={attributes.posts}
						onChange={(value) => setAttributes({ posts: value })}
						multiple={true}
						options={includesOptions}
					/>
					<SelectControl
						label={__('Excludes', 'boldpost')}
						value={attributes.excludes}
						onChange={(value) => setAttributes({ excludes: value })}
						multiple={true}
						options={excludesOptions}
					/>
					<ToggleControl
						label={__('Ignore Sticky Posts', 'boldpost')}
						checked={attributes.ignoreStikcyPosts}
						onChange={(value) => setAttributes({ ignoreStikcyPosts: value })}
					/>
					<SelectControl
						label={__('Categories', 'boldpost')}
						value={attributes.categories}
						onChange={(value) => setAttributes({ categories: value })}
						options={categoriesOptions}
						multiple={true}
						help={__('Select post categories from here. If you do not select any category, it will display posts from all categories.', 'boldpost')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Order', 'boldpost')}
						value={attributes.order}
						onChange={(value) => setAttributes({ order: value })}
						options={[
							{ label: __('Ascending', 'boldpost'), value: 'ASC' },
							{ label: __('Descending', 'boldpost'), value: 'DESC' },
						]}
						help={__('Order of items to display.', 'boldpost')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Order By', 'boldpost')}
						value={attributes.orderby}
						onChange={(value) => setAttributes({ orderby: value })}
						options={[
							{ label: __('Date', 'boldpost'), value: 'date' },
							{ label: __('Title', 'boldpost'), value: 'title' },
							{ label: __('Name', 'boldpost'), value: 'name' },
							{ label: __('ID', 'boldpost'), value: 'id' },
							{ label: __('Random', 'boldpost'), value: 'rand' },
						]}
						help={__('Order of items to display.', 'boldpost')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<NumberControl
						label={__('Offset', 'boldpost')}
						value={attributes.offset}
						onChange={(value) => setAttributes({ offset: value })}
						help={__('Number of items to skip.', 'boldpost')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<ToggleControl
						label={__('Is Featured', 'boldpost')}
						checked={attributes.isFeatured}
						onChange={(value) => setAttributes({ isFeatured: value })}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>


				<PanelBody title={__('Layout', 'boldpost')} initialOpen={false}>
					<ImageRadioControl
						value={attributes.listStyle}
						onChange={(value) => setAttributes({ listStyle: value })}
						options={[
							{ label: __('Default', 'boldpost'), value: 'default', src: layout1 },
							...(isLicenseActive ? [
								{ label: __('Style 1', 'boldpost'), value: '1', src: layout2 },
								{ label: __('Style 2', 'boldpost'), value: '2', src: layout3 },
								{ label: __('Style 3', 'boldpost'), value: '3', src: layout4 },
								{ label: __('Style 4', 'boldpost'), value: '4', src: layout5 },
							] : []),
						]}
					/>
				</PanelBody>
				<PanelBody title={__('Thumbnail', 'boldpost')} initialOpen={false}>
					<SelectControl
						label={__('Thumbnail One Size', 'boldpost')}
						value={attributes.thumbnailOneSize}
						onChange={(value) => setAttributes({ thumbnailOneSize: value })}
						options={imageSizeOptions}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Thumbnail Two Size', 'boldpost')}
						value={attributes.thumbnailTwoSize}
						onChange={(value) => setAttributes({ thumbnailTwoSize: value })}
						options={imageSizeOptions}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<ResponsiveWrapper label={__('Thumbnail One Height', 'boldpost')}>
						{(device) => (
							<RangeControlWithUnit
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('thumbnailOneHeight', device)}
								units={['px', '%', 'em', 'rem', 'vw', 'vh']}
								min={0}
								max={1000}
								step={1}
							/>
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Thumbnail One Width', 'boldpost')}>
						{(device) => (
							<RangeControlWithUnit
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('thumbnailOneWidth', device)}
								units={['px', '%', 'em', 'rem', 'vw', 'vh']}
								min={0}
								max={1000}
								step={1}
							/>
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Thumbnail Two Height', 'boldpost')}>
						{(device) => (
							<RangeControlWithUnit
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('thumbnailTwoHeight', device)}
								units={['px', '%', 'em', 'rem', 'vw', 'vh']}
								min={0}
								max={1000}
								step={1}
							/>
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Thumbnail Two Width', 'boldpost')}>
						{(device) => (
							<RangeControlWithUnit
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('thumbnailTwoWidth', device)}
								units={['px', '%', 'em', 'rem', 'vw', 'vh']}
								min={0}
								max={1000}
								step={1}
							/>
						)}
					</ResponsiveWrapper>
					<SelectControl
						label={__('Animation', 'boldpost')}
						value={attributes.animStyle}
						onChange={(value) => setAttributes({ animStyle: value })}
						options={[
							{ label: __('None', 'boldpost'), value: 'none' },
							{ label: __('Left Right', 'boldpost'), value: 'left_right' },
							{ label: __('Top Bottom', 'boldpost'), value: 'top_bottom' }
						]}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>

				<PanelBody title={__('Title', 'boldpost')} initialOpen={false}>
					<SelectControl
						label={__('Title Tag', 'boldpost')}
						value={attributes.TitleOneTag}
						onChange={(value) => setAttributes({ TitleOneTag: value })}
						options={[
							{ label: __('H2', 'boldpost'), value: 'h2' },
							{ label: __('H3', 'boldpost'), value: 'h3' },
							{ label: __('H4', 'boldpost'), value: 'h4' },
							{ label: __('H5', 'boldpost'), value: 'h5' },
							{ label: __('H6', 'boldpost'), value: 'h6' },
						]}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Title Tag', 'boldpost')}
						value={attributes.TitleTwoTag}
						onChange={(value) => setAttributes({ TitleTwoTag: value })}
						options={[
							{ label: __('H2', 'boldpost'), value: 'h2' },
							{ label: __('H3', 'boldpost'), value: 'h3' },
							{ label: __('H4', 'boldpost'), value: 'h4' },
							{ label: __('H5', 'boldpost'), value: 'h5' },
							{ label: __('H6', 'boldpost'), value: 'h6' },
						]}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<NumberControl
						label={__('Title Trim', 'boldpost')}
						value={attributes.titleTrim}
						onChange={(value) => setAttributes({ titleTrim: value })}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>

				<PanelBody title={__('Excerpt', 'boldpost')} initialOpen={false}>
					<ToggleControl
						label={__('Show / Hide', 'boldpost')}
						checked={attributes.showExcerpt}
						onChange={(value) => setAttributes({ showExcerpt: value })}
						__nextHasNoMarginBottom={true}
					/>
					{attributes.showExcerpt && (
						<NumberControl
							label={__('Excerpt Trim', 'boldpost')}
							value={attributes.excerptTrim}
							onChange={(value) => setAttributes({ excerptTrim: value })}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
					)}
				</PanelBody>

				<PanelBody title={__('Meta', 'boldpost')} initialOpen={false}>
					<ToggleControl
						label={__('Show / Hide', 'boldpost')}
						checked={attributes.showMeta}
						onChange={(value) => setAttributes({ showMeta: value })}
						__nextHasNoMarginBottom={true}
					/>
					{attributes.showMeta && (
						<>
							<SelectControl
								label={__('Meta', 'boldpost')}
								value={attributes.allowedMetas}
								onChange={(value) => setAttributes({ allowedMetas: value })}
								multiple={true}
								options={[
									{ label: __('Author', 'boldpost'), value: 'author' },
									{ label: __('Date', 'boldpost'), value: 'date' },
									{ label: __('Category', 'boldpost'), value: 'category' },
									{ label: __('Tag', 'boldpost'), value: 'tag' },
									{ label: __('Comments Count', 'boldpost'), value: 'comments_count' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							{
								attributes.allowedMetas.includes('author') && (
									<TextControl
										label={__('Author Prefix', 'boldpost')}
										value={attributes.authorPrefix}
										onChange={(value) => setAttributes({ authorPrefix: value })}
										__next40pxDefaultSize={true}
										__nextHasNoMarginBottom={true}
									/>
								)}
							<SelectControl
								label={__('Position', 'boldpost')}
								value={attributes.metaPosition}
								onChange={(value) => setAttributes({ metaPosition: value })}
								options={[
									{ label: __('Up Title', 'boldpost'), value: 'up_title' },
									{ label: __('Below Title', 'boldpost'), value: 'below_title' },
									{ label: __('Below Content', 'boldpost'), value: 'below_content' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<SelectControl
								label={__('Style', 'boldpost')}
								value={attributes.metaStyle}
								onChange={(value) => setAttributes({ metaStyle: value })}
								options={[
									{ label: __('Default', 'boldpost'), value: 'default' },
									{ label: __('Style 1', 'boldpost'), value: '1' },
									{ label: __('Style 2', 'boldpost'), value: '2' },
									{ label: __('Style 3', 'boldpost'), value: '3' }
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<ToggleControl
									label={__('Show Date Badge', 'boldpost')}
									checked={attributes.showDateOnTop}
									onChange={(value) => setAttributes({ showDateOnTop: value })}
									__nextHasNoMarginBottom={true}
								/>
							</>
						)}
					</PanelBody>

					<PanelBody title={__('Button', 'boldpost')} initialOpen={false}>
						<ToggleControl
							label={__('Show / Hide', 'boldpost')}
							checked={attributes.showReadMore}
							onChange={(value) => setAttributes({ showReadMore: value })}
							__nextHasNoMarginBottom={true}
						/>
						{attributes.showReadMore && (
							<>
								<TextControl
									label={__('Text', 'boldpost')}
									value={attributes.readMoreText}
									onChange={(value) => setAttributes({ readMoreText: value })}
									__next40pxDefaultSize={true}
									__nextHasNoMarginBottom={true}
								/>
								<IconPicker
									label={__('Icon', 'boldpost')}
									value={attributes.readMoreIcon}
									onChange={(value) => setAttributes({ readMoreIcon: value })}
								/>
								<SelectControl
									label={__('Icon Position', 'boldpost')}
									value={attributes.readMoreIconPosition}
									onChange={(value) => setAttributes({ readMoreIconPosition: value })}
									options={[
										{ label: __('Before', 'boldpost'), value: 'before' },
										{ label: __('After', 'boldpost'), value: 'after' },
									]}
									__next40pxDefaultSize={true}
									__nextHasNoMarginBottom={true}
								/>
							</>
						)}
					</PanelBody>

					<PanelBody title={__('Pagination', 'boldpost')} initialOpen={false}>
						<ToggleControl
							label={__('Show Pagination', 'boldpost')}
							checked={attributes.pagination}
							onChange={(value) => setAttributes({ pagination: value })}
							__nextHasNoMarginBottom={true}
						/>
						<SelectControl
							label={__('Pagination Type', 'boldpost')}
							value={attributes.paginationType}
							onChange={(value) => setAttributes({ paginationType: value })}
							options={paginationOptions}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
					</PanelBody>


			</InspectorControls>
			<InspectorControls group='styles'>
				<PanelBody title={__('Item', 'boldpost')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<BackgroundControl
										label={isHover ? __('Background', 'boldpost') : __('Background', 'boldpost')}
										colorValue={isHover ? attributes.itemBackgroundColorHover : attributes.itemBackgroundColor}
										gradientValue={isHover ? attributes.itemBackgroundGradientHover : attributes.itemBackgroundGradient}
										onColorChange={(value) => {
											const hex = (value && typeof value === 'object') ? value.hex : value;
											setAttributes({ [isHover ? 'itemBackgroundColorHover' : 'itemBackgroundColor']: hex });
										}}
										onGradientChange={(value) => setAttributes({ [isHover ? 'itemBackgroundGradientHover' : 'itemBackgroundGradient']: value })}
									/>
									{!isHover && (
										<BackgroundControl
											label={__('Overlay', 'boldpost')}
											colorValue={attributes.itemOverlayBackgroundColor}
											gradientValue={attributes.itemOverlayBackgroundGradient}
											onColorChange={(value) => {
												const hex = (value && typeof value === 'object') ? value.hex : value;
												setAttributes({ itemOverlayBackgroundColorHover: hex });
											}}
											onGradientChange={(value) => setAttributes({ itemOverlayBackgroundGradientHover: value })}
										/>
									)}
								</div>
							);
						}}
					</TabPanel>
					<Divider />
					<BoxShadowControl
						label={__('Box Shadow', 'boldpost')}
						value={attributes.itemBoxShadow}
						onChange={(value) => setAttributes({ itemBoxShadow: value })}
					/>
					<Divider />
					<BorderControl
						label={__('Border', 'boldpost')}
						value={attributes.itemBorder}
						onChange={(value) => setAttributes({ itemBorder: value })}
					/>
					<Divider />
					<ResponsiveWrapper label={__('Item Gap', 'boldpost')}>
						{(device) => (
							<NumberControl
								value={attributes[getAttrKey('itemGap', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemGap', device)]: value })}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
								max={5} />
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Item Row Gap', 'boldpost')}>
						{(device) => (
							<NumberControl
								value={attributes[getAttrKey('itemRowGap', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemRowGap', device)]: value })}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
								max={5}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<BoxControl
						label={__('Border Radious', 'boldpost')}
						values={attributes.itemBorderRadius}
						onChange={(nextValues) => setAttributes({ itemBorderRadius: nextValues })}
					/>
				</PanelBody>

				<PanelBody title={__('Content', 'boldpost')} initialOpen={false}>
					<ResponsiveWrapper label={__('Text Align', 'boldpost')}>
						{(device) => (
							<TextAlignControl
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('contentTextAlign', device)}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('contentPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('contentPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('contentTwoPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('contentTwoPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
				</PanelBody>

				<PanelBody title={__('Title', 'boldpost')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={isHover ? __('Color', 'boldpost') : __('Color', 'boldpost')}
										color={isHover ?
											attributes.itemTitleColorHover
											: attributes.itemTitleColor}
										defaultColor={isHover ? '' : ''}
										onChange={(value) => {
											const hex = (value && typeof value === 'object') ? value.hex : value;
											setAttributes({ [isHover ? 'itemTitleColorHover' : 'itemTitleColor']: hex });
										}}
									/>
								</div>
							);
						}}
					</TabPanel>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemTitlePadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemTitlePadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Margin', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemTitleMargin', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemTitleMargin', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Text Align', 'boldpost')}>
						{(device) => (
							<TextAlignControl
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('titleTextAlign', device)}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Typography Left', 'boldpost')}>
						{(device) => (
							<TypographyControls
								label={__('Typography', 'boldpost')}
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('itemTitleOneTypography', device)}
							/>
						)}
					</ResponsiveWrapper>
					<ResponsiveWrapper label={__('Typography Right', 'boldpost')}>
						{(device) => (
							<TypographyControls
								label={__('Typography', 'boldpost')}
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('itemTitleTwoTypography', device)}
							/>
						)}
					</ResponsiveWrapper>
				</PanelBody>

				<PanelBody title={__('Excerpt', 'boldpost')} initialOpen={false}>
					<ColorPopover
						label={__('Color', 'boldpost')}
						color={attributes.itemExcerptColor}
						defaultColor={''}
						onChange={(value) => {
							const hex = (value && typeof value === 'object') ? value.hex : value;
							setAttributes({ itemExcerptColor: hex });
						}}
					/>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemExcerptPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemExcerptPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Margin', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemExcerptMargin', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemExcerptMargin', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Text Align', 'boldpost')}>
						{(device) => (
							<TextAlignControl
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('excerptTextAlign', device)}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Typography', 'boldpost')}>
						{(device) => (
							<TypographyControls
								label={__('Typography', 'boldpost')}
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('itemExcerptTypography', device)}
							/>
						)}
					</ResponsiveWrapper>
				</PanelBody>

				<PanelBody title={__('Date Badge', 'boldpost')} initialOpen={false}>
					<ColorPopover
						label={__('Color', 'boldpost')}
						color={attributes.topDateColor}
						defaultColor={attributes.topDateColor}
						onChange={(value) => setAttributes({ topDateColor: value })}
					/>
					<ColorPopover
						label={__('Background Color', 'boldpost')}
						color={attributes.topDateBackgroundColor}
						defaultColor={attributes.topDateBackgroundColor}
						onChange={(value) => setAttributes({ topDateBackgroundColor: value })}
					/>
				</PanelBody>
				<PanelBody title={__('Meta', 'boldpost')} initialOpen={false}>
					<Heading>{__('Text', 'boldpost')}</Heading>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={__('Color', 'boldpost')}
										color={isHover ? attributes.metaColorHover : attributes.metaColor}
										defaultColor={isHover ? attributes.metaColorHover : attributes.metaColor}
										onChange={(value) => setAttributes({ [isHover ? 'metaColorHover' : 'metaColor']: value })}
									/>
								</div>
							)
						}
						}
					</TabPanel>
					<Heading>{__('Icon', 'boldpost')}</Heading>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={__('Color', 'boldpost')}
										color={isHover ? attributes.metaIconColorHover : attributes.metaIconColor}
										defaultColor={isHover ? attributes.metaIconColorHover : attributes.metaIconColor}
										onChange={(value) => setAttributes({ [isHover ? 'metaIconColorHover' : 'metaIconColor']: value })}
									/>
								</div>
							)
						}
						}
					</TabPanel>
					<BoxControl
						label={__('Margin', 'boldpost')}
						values={attributes.metaMargin}
						onChange={(value) => setAttributes({ metaMargin: value })}
					/>
					<TypographyControls
						label={__('Typography', 'boldpost')}
						attributes={attributes}
						setAttributes={setAttributes}
						attributeKey="metaTypography"
					/>
				</PanelBody>

				<PanelBody title={__('Button', 'boldpost')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<BackgroundControl
										label={isHover ? __('Background', 'boldpost') : __('Background', 'boldpost')}
										colorValue={isHover ? attributes.readMoreBackgroundColorHover : attributes.readMoreBackgroundColor}
										gradientValue={isHover ? attributes.readMoreBackgroundGradientHover : attributes.readMoreBackgroundGradient}
										onColorChange={(value) => {
											const hex = (value && typeof value === 'object') ? value.hex : value;
											setAttributes({ [isHover ? 'readMoreBackgroundColorHover' : 'readMoreBackgroundColor']: hex });
										}}
										onGradientChange={(value) => setAttributes({ [isHover ? 'readMoreBackgroundGradientHover' : 'readMoreBackgroundGradient']: value })}
									/>
									<ColorPopover
										label={isHover ? __('Color', 'boldpost') : __('Color', 'boldpost')}
										color={isHover ?
											attributes.readMoreColorHover
											: attributes.readMoreColor}
										defaultColor={isHover ? '' : ''}
										onChange={(value) => {
											const hex = (value && typeof value === 'object') ? value.hex : value;
											setAttributes({ [isHover ? 'readMoreColorHover' : 'readMoreColor']: hex });
										}}
									/>
								</div>
							);
						}}
					</TabPanel>
					<Divider />
					<BoxControl
						label={__('Padding', 'boldpost')}
						values={attributes.readMorePadding}
						onChange={(value) => setAttributes({ readMorePadding: value })}
					/>
					<Divider />
					<BoxControl
						label={__('Margin', 'boldpost')}
						values={attributes.readMoreMargin}
						onChange={(value) => setAttributes({ readMoreMargin: value })}
					/>
					<Divider />
					<BoxControl
						label={__('Border Radius', 'boldpost')}
						values={attributes.readMoreBorderRadius}
						onChange={(value) => setAttributes({ readMoreBorderRadius: value })}
					/>
					<Divider />
					<BorderControl
						label={__('Border', 'boldpost')}
						value={attributes.readMoreBorder}
						onChange={(value) => setAttributes({ readMoreBorder: value })}
					/>
					<Divider />
					<ResponsiveWrapper label={__('Text Align', 'boldpost')}>
						{(device) => (
							<TextAlignControl
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('buttonTextAlign', device)}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<TypographyControls
						label={__('Typography', 'boldpost')}
						attributes={attributes}
						setAttributes={setAttributes}
						attributeKey="readMoreTypography"
					/>
				</PanelBody>

				<PanelBody title={__('Pagination', 'boldpost')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'boldpost'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover / Active', 'boldpost'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={__('Color', 'boldpost')}
										color={isHover ? attributes.paginationColorHover : attributes.paginationColor}
										defaultColor={isHover ? 'var(--boldpo-preset-color-white)' : 'var(--boldpo-preset-color-contrast-2)'}
										onChange={(value) => setAttributes({ [isHover ? 'paginationColorHover' : 'paginationColor']: value })}
									/>
									<ColorPopover
										label={__('Background Color', 'boldpost')}
										color={isHover ? attributes.paginationBackgroundColorHover : attributes.paginationBackgroundColor}
										defaultColor={isHover ? 'var(--boldpo-preset-color-primary)' : 'var(--boldpo-preset-color-tertiary)'}
										onChange={(value) => setAttributes({ [isHover ? 'paginationBackgroundColorHover' : 'paginationBackgroundColor']: value })}
									/>
								</div>
							);
						}}
					</TabPanel>

					{attributes.paginationType == 'load_more' && (
						<ResponsiveWrapper label={__('Button Width (%)', 'boldpost')}>
							{(device) => (
								<RangeControlWithUnit
									attributes={attributes}
									setAttributes={setAttributes}
									attributeKey={getAttrKey('paginationBtnWidth', device)}
									units={['px', '%', 'em', 'rem', 'vw', 'vh']}
									min={0}
									max={500}
									step={1}
								/>
							)}
						</ResponsiveWrapper>
					)}

					<BorderControl
						label={__('Border', 'boldpost')}
						value={attributes.paginationBtnBorder}
						onChange={(value) => setAttributes({ paginationBtnBorder: value })}
					/>
					<BoxControl
						label={__('Border Radius', 'boldpost')}
						values={attributes.paginationBtnBorderRadius}
						onChange={(value) => setAttributes({ paginationBtnBorderRadius: value })}
					/>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('paginationBtnPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('paginationBtnPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Margin', 'boldpost')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('paginationWrapMargin', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('paginationWrapMargin', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>

				</PanelBody>

				<PanelBody title={__('Thumbnail', 'boldpost')} initialOpen={false}>
					<BoxControl
						label={__('Border Radius', 'boldpost')}
						values={attributes.thumbnailBorderRadius}
						onChange={(value) => setAttributes({ thumbnailBorderRadius: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<ServerSideRender block="boldpost/post-list-2" attributes={attributes} httpMethod="POST" />
		</div>
	);
}