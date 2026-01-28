/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { decodeEntities } from '@wordpress/html-entities';

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
	SelectControl,
	ToggleControl,
	TextControl
} from '@wordpress/components';
import BackgroundControl from '../../custom-components/BackgroundControl';
import TypographyControls from '../../custom-components/TypographyControls';
import ColorPopover from '../../custom-components/ColorPopover';
import ImageRadioControl from '../../custom-components/ImageRadioControl';
import ResponsiveWrapper from '../../custom-components/ResponsiveWrapper';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import grid1 from './assets/img/grid-1.png';
import grid2 from './assets/img/grid-2.png';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
import { useState, useEffect } from '@wordpress/element';
import ServerSideRender from '@wordpress/server-side-render';
import metadata from './block.json';

export default function Edit({ attributes, setAttributes }) {

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

	categoriesOptions.unshift({ label: __('All Categories', 'bold-post'), value: 'all' });

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
				{ label: __('Large', 'bold-post'), value: 'large' },
				{ label: __('Medium', 'bold-post'), value: 'medium' },
				{ label: __('Thumbnail', 'bold-post'), value: 'thumbnail' },
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
	let includesOptions = [...postsOptions];

	// add no excludes
	excludesOptions.unshift({ label: __('No Excludes', 'bold-post'), value: 'no-excludes' });

	// add all
	includesOptions.unshift({ label: __('All', 'bold-post'), value: 'all' });

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				{/* {query panel group} */}
				<PanelBody title={__('Query', 'bold-post')} initialOpen={false}>
					<NumberControl
						label={__('Per Page', 'bold-post')}
						value={attributes.perPage}
						onChange={(value) => setAttributes({ perPage: value })}
						help={__('Number of items to display.', 'bold-post')}
						__next40pxDefaultSize={true}
					/>
					<SelectControl
						label={__('Includes', 'bold-post')}
						value={attributes.posts}
						onChange={(value) => setAttributes({ posts: value })}
						multiple={true}
						options={includesOptions}
					/>
					<SelectControl
						label={__('Excludes', 'bold-post')}
						value={attributes.excludes}
						onChange={(value) => setAttributes({ excludes: value })}
						multiple={true}
						options={excludesOptions}
					/>
					<SelectControl
						label={__('Categories', 'bold-post')}
						value={attributes.categories}
						onChange={(value) => setAttributes({ categories: value })}
						options={categoriesOptions}
						multiple={true}
						help={__('Select post categories from here. If you do not select any category, it will display posts from all categories.', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Order', 'bold-post')}
						value={attributes.order}
						onChange={(value) => setAttributes({ order: value })}
						options={[
							{ label: __('Ascending', 'bold-post'), value: 'ASC' },
							{ label: __('Descending', 'bold-post'), value: 'DESC' },
						]}
						help={__('Order of items to display.', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Order By', 'bold-post')}
						value={attributes.orderby}
						onChange={(value) => setAttributes({ orderby: value })}
						options={[
							{ label: __('Date', 'bold-post'), value: 'date' },
							{ label: __('Title', 'bold-post'), value: 'title' },
							{ label: __('Name', 'bold-post'), value: 'name' },
							{ label: __('ID', 'bold-post'), value: 'id' },
							{ label: __('Random', 'bold-post'), value: 'rand' },
						]}
						help={__('Order of items to display.', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<NumberControl
						label={__('Offset', 'bold-post')}
						value={attributes.offset}
						onChange={(value) => setAttributes({ offset: value })}
						help={__('Number of items to skip.', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<ToggleControl
						label={__('Is Featured', 'bold-post')}
						checked={attributes.isFeatured}
						onChange={(value) => setAttributes({ isFeatured: value })}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>


				<PanelBody title={__('Layout', 'bold-post')} initialOpen={false}>
					<ImageRadioControl
						value={attributes.sliderStyle}
						onChange={(value) => setAttributes({ sliderStyle: value })}
						options={[
							{ label: __('Default', 'bold-post'), value: 'default', src: grid1 },
							{ label: __('Style 1', 'bold-post'), value: '1', src: grid2 },
						]}
					/>
				</PanelBody>

				{ /* content panel group */}
				<PanelBody title={__('Content', 'bold-post')} initialOpen={false}>

					<ResponsiveWrapper label={__('Columns', 'bold-post')}>
						{(device) => (
							<SelectControl
								value={attributes[getAttrKey('columns', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('columns', device)]: value })}
								options={[
									{ label: __('1 Column', 'bold-post'), value: '1' },
									{ label: __('2 Column', 'bold-post'), value: '2' },
									{ label: __('3 Column', 'bold-post'), value: '3' },
									{ label: __('4 Column', 'bold-post'), value: '4' },
									{ label: __('6 Column', 'bold-post'), value: '6' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						)}
					</ResponsiveWrapper>

				</PanelBody>

				<PanelBody title={__('Thumbnail', 'bold-post')} initialOpen={false}>
					<SelectControl
						label={__('Size', 'bold-post')}
						value={attributes.thumbnailSize}
						onChange={(value) => setAttributes({ thumbnailSize: value })}
						options={imageSizeOptions}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Animation', 'bold-post')}
						value={attributes.animStyle}
						onChange={(value) => setAttributes({ animStyle: value })}
						options={[
							{ label: __('None', 'bold-post'), value: 'none' },
							{ label: __('Left Right', 'bold-post'), value: 'left_right' },
							{ label: __('Top Bottom', 'bold-post'), value: 'top_bottom' }
						]}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>

				<PanelBody title={__('Title', 'bold-post')} initialOpen={false}>
					<SelectControl
						label={__('Title Tag', 'bold-post')}
						value={attributes.titleTag}
						onChange={(value) => setAttributes({ titleTag: value })}
						options={[
							{ label: __('H2', 'bold-post'), value: 'h2' },
							{ label: __('H3', 'bold-post'), value: 'h3' },
							{ label: __('H4', 'bold-post'), value: 'h4' },
							{ label: __('H5', 'bold-post'), value: 'h5' },
							{ label: __('H6', 'bold-post'), value: 'h6' },
						]}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<NumberControl
						label={__('Title Trim', 'bold-post')}
						value={attributes.titleTrim}
						onChange={(value) => setAttributes({ titleTrim: value })}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>

				<PanelBody title={__('Excerpt', 'bold-post')} initialOpen={false}>
					<ToggleControl
						label={__('Show / Hide', 'bold-post')}
						checked={attributes.showExcerpt}
						onChange={(value) => setAttributes({ showExcerpt: value })}
						__nextHasNoMarginBottom={true}
					/>
					{attributes.showExcerpt && (
						<NumberControl
							label={__('Excerpt Trim', 'bold-post')}
							value={attributes.excerptTrim}
							onChange={(value) => setAttributes({ excerptTrim: value })}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
					)}
				</PanelBody>

				<PanelBody title={__('Meta', 'bold-post')} initialOpen={false}>
					<ToggleControl
						label={__('Show / Hide', 'bold-post')}
						checked={attributes.showMeta}
						onChange={(value) => setAttributes({ showMeta: value })}
						__nextHasNoMarginBottom={true}
					/>
					{attributes.showMeta && (
						<>
							<SelectControl
								label={__('Meta', 'bold-post')}
								value={attributes.allowedMetas}
								onChange={(value) => setAttributes({ allowedMetas: value })}
								multiple={true}
								options={[
									{ label: __('Author', 'bold-post'), value: 'author' },
									{ label: __('Date', 'bold-post'), value: 'date' },
									{ label: __('Category', 'bold-post'), value: 'category' },
									{ label: __('Tag', 'bold-post'), value: 'tag' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<SelectControl
								label={__('Position', 'bold-post')}
								value={attributes.metaPosition}
								onChange={(value) => setAttributes({ metaPosition: value })}
								options={[
									{ label: __('Up Title', 'bold-post'), value: 'up_title' },
									{ label: __('Below Title', 'bold-post'), value: 'below_title' },
									{ label: __('Below Content', 'bold-post'), value: 'below_content' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<ToggleControl
								label={__('Show Date Badge', 'bold-post')}
								checked={attributes.showDateOnTop}
								onChange={(value) => { setAttributes({ showDateOnTop: value }); console.log(value); }}
								__nextHasNoMarginBottom={true}
							/>
						</>
					)}
				</PanelBody>

				<PanelBody title={__('Button', 'bold-post')} initialOpen={false}>
					<ToggleControl
						label={__('Show / Hide', 'bold-post')}
						checked={attributes.showReadMore}
						onChange={(value) => setAttributes({ showReadMore: value })}
						__nextHasNoMarginBottom={true}
					/>
					{attributes.showReadMore && (
						<>
							<NumberControl
								label={__('Text', 'bold-post')}
								value={attributes.readMoreText}
								onChange={(value) => setAttributes({ readMoreText: value })}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<SelectControl
								label={__('Icon', 'bold-post')}
								value={attributes.readMoreIcon}
								onChange={(value) => setAttributes({ readMoreIcon: value })}
								options={[
									{ label: __('None', 'bold-post'), value: 'none' },
									{ label: __('Chevron Right', 'bold-post'), value: 'bldpst-icon-chevron-right' },
									{ label: __('Chevron Left', 'bold-post'), value: 'bldpst-icon-chevron-left' },
									{ label: __('Arrow Left', 'bold-post'), value: 'bldpst-icon-arrow-left' },
									{ label: __('Arrow Right', 'bold-post'), value: 'bldpst-icon-arrow-right' },
									{ label: __('Arrow Up Right', 'bold-post'), value: 'bldpst-icon-arrow-up-right' }
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
							<SelectControl
								label={__('Icon Position', 'bold-post')}
								value={attributes.readMoreIconPosition}
								onChange={(value) => setAttributes({ readMoreIconPosition: value })}
								options={[
									{ label: __('Before', 'bold-post'), value: 'before' },
									{ label: __('After', 'bold-post'), value: 'after' },
								]}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						</>
					)}
				</PanelBody>

				<PanelBody title={__('Pagination', 'bold-post')} initialOpen={false}>
					<ToggleControl
						label={__('Show Pagination', 'bold-post')}
						checked={attributes.pagination}
						onChange={(value) => setAttributes({ pagination: value })}
						__nextHasNoMarginBottom={true}
					/>
				</PanelBody>

				<PanelBody title={__('Slider', 'bold-post')} initialOpen={true}>
					<SelectControl
						label={__('Desktop', 'bold-post')}
						value={attributes.slidesPerView}
						options={[
							{ label: __('1', 'bold-post'), value: '1' },
							{ label: __('2', 'bold-post'), value: '2' },
							{ label: __('2.3', 'bold-post'), value: '2.3' },
							{ label: __('3', 'bold-post'), value: '3' },
							{ label: __('3.3', 'bold-post'), value: '3.3' },
							{ label: __('4', 'bold-post'), value: '4' },
							{ label: __('4.3', 'bold-post'), value: '4.3' }
						]}
						onChange={(value) => setAttributes({ slidesPerView: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Tablet', 'bold-post')}
						value={attributes.slidesPerViewTablet}
						options={[
							{ label: __('1', 'bold-post'), value: '1' },
							{ label: __('2', 'bold-post'), value: '2' },
							{ label: __('2.3', 'bold-post'), value: '2.3' },
							{ label: __('3', 'bold-post'), value: '3' },
							{ label: __('3.3', 'bold-post'), value: '3.3' },
							{ label: __('4', 'bold-post'), value: '4' },
							{ label: __('4.3', 'bold-post'), value: '4.3' }
						]}
						onChange={(value) => setAttributes({ slidesPerViewTablet: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Mobile', 'bold-post')}
						value={attributes.slidesPerViewMobile}
						options={[
							{ label: __('1', 'bold-post'), value: '1' },
							{ label: __('2', 'bold-post'), value: '2' },
							{ label: __('2.3', 'bold-post'), value: '2.3' },
							{ label: __('3', 'bold-post'), value: '3' },
							{ label: __('3.3', 'bold-post'), value: '3.3' },
							{ label: __('4', 'bold-post'), value: '4' },
							{ label: __('4.3', 'bold-post'), value: '4.3' }
						]}
						onChange={(value) => setAttributes({ slidesPerViewMobile: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Mobile Small', 'bold-post')}
						value={attributes.slidesPerViewMobileSmall}
						options={[
							{ label: __('1', 'bold-post'), value: '1' },
							{ label: __('2', 'bold-post'), value: '2' },
							{ label: __('2.3', 'bold-post'), value: '2.3' },
							{ label: __('3', 'bold-post'), value: '3' },
							{ label: __('3.3', 'bold-post'), value: '3.3' },
							{ label: __('4', 'bold-post'), value: '4' },
							{ label: __('4.3', 'bold-post'), value: '4.3' }
						]}
						onChange={(value) => setAttributes({ slidesPerViewMobileSmall: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<SelectControl
						label={__('Slides To Scroll', 'bold-post')}
						value={attributes.slidesToScroll}
						options={[
							{ label: __('1', 'bold-post'), value: '1' },
							{ label: __('2', 'bold-post'), value: '2' },
							{ label: __('2.3', 'bold-post'), value: '2.3' },
							{ label: __('3', 'bold-post'), value: '3' },
							{ label: __('3.3', 'bold-post'), value: '3.3' },
							{ label: __('4', 'bold-post'), value: '4' },
							{ label: __('4.3', 'bold-post'), value: '4.3' }
						]}
						onChange={(value) => setAttributes({ slidesToScroll: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<TextControl
						label={__('Space Between', 'bold-post')}
						value={attributes.spaceBetween}
						onChange={(value) => setAttributes({ spaceBetween: value })}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<Divider />
					<ToggleControl
						label={__('Centered Slides', 'bold-post')}
						checked={attributes.centeredSlides}
						onChange={(value) => setAttributes({ centeredSlides: value })}
					/>
					<SelectControl
						label={__('Select effect', 'bold-post')}
						value={attributes.effect}
						options={[
							{ label: __('Slide', 'bold-post'), value: 'slide' },
							{ label: __('Fade', 'bold-post'), value: 'fade' },
							{ label: __('Flip', 'bold-post'), value: 'flip' },
							{ label: __('Cube', 'bold-post'), value: 'cube' },
							{ label: __('Coverflow', 'bold-post'), value: 'coverflow' },
							{ label: __('Cards', 'bold-post'), value: 'cards' },
							{ label: __('Creative', 'bold-post'), value: 'creative' }
						]}
						onChange={(value) => setAttributes({ effect: value })}
						help={__('Choose which effect this booking form is for', 'bold-post')}
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
					/>
					<Divider />
					<ToggleControl
						__nextHasNoMarginBottom={true}
						label={__('Loop', 'bold-post')}
						help={attributes.loop ? __('Loop', 'bold-post') : __('No loop', 'bold-post')}
						checked={attributes.loop}
						onChange={(newValue) => {
							setAttributes({ loop: newValue });
						}}
					/>
					<Divider />
					<ToggleControl
						__nextHasNoMarginBottom={true}
						label={__('Autoplay', 'bold-post')}
						help={attributes.autoplay ? __('Autoplay', 'bold-post') : __('No autoplay', 'bold-post')}
						checked={attributes.autoplay}
						onChange={(newValue) => {
							setAttributes({ autoplay: newValue });
						}}
					/>
					<Divider />
					<TextControl
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
						label={__('Speed', 'bold-post')}
						value={attributes.speed}
						onChange={(value) => setAttributes({ speed: value })}
						help={__('Speed of the transition between slides', 'bold-post')}
					/>
					<Divider />
					<TextControl
						__next40pxDefaultSize={true}
						__nextHasNoMarginBottom={true}
						label={__('Autoplay Speed', 'bold-post')}
						value={attributes.autoplaySpeed}
						onChange={(value) => setAttributes({ autoplaySpeed: value })}
						help={__('Autoplay speed of the transition between slides', 'bold-post')}
					/>
				</PanelBody>

			</InspectorControls>
			<InspectorControls group='styles'>
				<PanelBody title={__('Item', 'bold-post')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'bold-post'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'bold-post'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<BackgroundControl
										label={isHover ? __('Background', 'bold-post') : __('Background', 'bold-post')}
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
											label={__('Overlay', 'bold-post')}
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
					<ResponsiveWrapper label={__('Item Gap', 'bold-post')}>
						{(device) => (
							<NumberControl
								value={attributes[getAttrKey('itemGap', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemGap', device)]: value })}
								__next40pxDefaultSize={true}
								__nextHasNoMarginBottom={true}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'bold-post')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<BoxControl
						label={__('Border Radious', 'bold-post')}
						values={attributes.itemBorderRadius}
						onChange={(nextValues) => setAttributes({ itemBorderRadius: nextValues })}
					/>
				</PanelBody>

				<PanelBody title={__('Title', 'bold-post')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'bold-post'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'bold-post'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={isHover ? __('Color', 'bold-post') : __('Color', 'bold-post')}
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
					<ResponsiveWrapper label={__('Padding', 'bold-post')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemTitlePadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemTitlePadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Margin', 'bold-post')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemTitleMargin', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemTitleMargin', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Typography', 'bold-post')}>
						{(device) => (
							<TypographyControls
								label={__('Typography', 'bold-post')}
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('itemTitleTypography', device)}
							/>
						)}
					</ResponsiveWrapper>
				</PanelBody>

				<PanelBody title={__('Excerpt', 'bold-post')} initialOpen={false}>
					<ColorPopover
						label={__('Color', 'bold-post')}
						color={attributes.itemExcerptColor}
						defaultColor={''}
						onChange={(value) => {
							const hex = (value && typeof value === 'object') ? value.hex : value;
							setAttributes({ itemExcerptColor: hex });
						}}
					/>
					<Divider />
					<ResponsiveWrapper label={__('Padding', 'bold-post')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemExcerptPadding', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemExcerptPadding', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Margin', 'bold-post')}>
						{(device) => (
							<BoxControl
								values={attributes[getAttrKey('itemExcerptMargin', device)]}
								onChange={(value) => setAttributes({ [getAttrKey('itemExcerptMargin', device)]: value })}
							/>
						)}
					</ResponsiveWrapper>
					<Divider />
					<ResponsiveWrapper label={__('Typography', 'bold-post')}>
						{(device) => (
							<TypographyControls
								label={__('Typography', 'bold-post')}
								attributes={attributes}
								setAttributes={setAttributes}
								attributeKey={getAttrKey('itemExcerptTypography', device)}
							/>
						)}
					</ResponsiveWrapper>
				</PanelBody>

				<PanelBody title={__('Date Badge', 'bold-post')} initialOpen={false}>
					<ColorPopover
						label={__('Color', 'bold-post')}
						color={attributes.topDateColor}
						defaultColor={attributes.topDateColor}
						onChange={(value) => setAttributes({ topDateColor: value })}
					/>
					<ColorPopover
						label={__('Background Color', 'bold-post')}
						color={attributes.topDateBackgroundColor}
						defaultColor={attributes.topDateBackgroundColor}
						onChange={(value) => setAttributes({ topDateBackgroundColor: value })}
					/>
				</PanelBody>
				<PanelBody title={__('Meta', 'bold-post')} initialOpen={false}>
					<ColorPopover
						label={__('Color', 'bold-post')}
						color={attributes.metaColor}
						defaultColor={attributes.metaColor}
						onChange={(value) => setAttributes({ metaColor: value })}
					/>
					<BoxControl
						label={__('Margin', 'bold-post')}
						values={attributes.metaMargin}
						onChange={(value) => setAttributes({ metaMargin: value })}
					/>
				</PanelBody>

				<PanelBody title={__('Button', 'bold-post')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'bold-post'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover', 'bold-post'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<BackgroundControl
										label={isHover ? __('Background', 'bold-post') : __('Background', 'bold-post')}
										colorValue={isHover ? attributes.readMoreBackgroundColorHover : attributes.readMoreBackgroundColor}
										gradientValue={isHover ? attributes.readMoreBackgroundGradientHover : attributes.readMoreBackgroundGradient}
										onColorChange={(value) => {
											const hex = (value && typeof value === 'object') ? value.hex : value;
											setAttributes({ [isHover ? 'readMoreBackgroundColorHover' : 'readMoreBackgroundColor']: hex });
										}}
										onGradientChange={(value) => setAttributes({ [isHover ? 'readMoreBackgroundGradientHover' : 'readMoreBackgroundGradient']: value })}
									/>
									<ColorPopover
										label={isHover ? __('Color', 'bold-post') : __('Color', 'bold-post')}
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
						label={__('Padding', 'bold-post')}
						values={attributes.readMorePadding}
						onChange={(value) => setAttributes({ readMorePadding: value })}
					/>
					<Divider />
					<BoxControl
						label={__('Margin', 'bold-post')}
						values={attributes.readMoreMargin}
						onChange={(value) => setAttributes({ readMoreMargin: value })}
					/>
					<Divider />
					<TypographyControls
						label={__('Typography', 'bold-post')}
						attributes={attributes}
						setAttributes={setAttributes}
						attributeKey="readMoreTypography"
					/>
				</PanelBody>

				<PanelBody title={__('Pagination', 'bold-post')} initialOpen={false}>
					<TabPanel
						className="eshb-tab-panel"
						activeClass="is-active"
						tabs={[
							{ name: 'normal', title: __('Normal', 'bold-post'), className: 'eshb-tab-normal' },
							{ name: 'hover', title: __('Hover / Active', 'bold-post'), className: 'eshb-tab-hover' },
						]}
					>
						{(tab) => {
							const isHover = tab.name === 'hover';
							return (
								<div style={{ marginTop: '15px' }}>
									<ColorPopover
										label={__('Color', 'bold-post')}
										color={isHover ? attributes.paginationColorHover : attributes.paginationColor}
										defaultColor={isHover ? 'var(--bldpst-preset-color-white)' : 'var(--bldpst-preset-color-contrast-2)'}
										onChange={(value) => setAttributes({ [isHover ? 'paginationColorHover' : 'paginationColor']: value })}
									/>
									<ColorPopover
										label={__('Background Color', 'bold-post')}
										color={isHover ? attributes.paginationBackgroundColorHover : attributes.paginationBackgroundColor}
										defaultColor={isHover ? 'var(--bldpst-preset-color-primary)' : 'var(--bldpst-preset-color-tertiary)'}
										onChange={(value) => setAttributes({ [isHover ? 'paginationBackgroundColorHover' : 'paginationBackgroundColor']: value })}
									/>
								</div>
							);
						}}
					</TabPanel>

				</PanelBody>

			</InspectorControls>

			<ServerSideRender block="bold-post/post-slider" attributes={attributes} httpMethod="POST" />
		</div>
	);
}