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
    TextControl,
    ToggleControl,
    Icon
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
import style1 from './assets/img/style-1.png';
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
        value: category.id,
    }));

    let excludesOptions = [...categoriesOptions];
    let includesOptions = [...categoriesOptions];

    // add no excludes
    excludesOptions.unshift({ label: __('No Excludes', 'bold-post'), value: 'no-excludes' });

    // add all
    includesOptions.unshift({ label: __('All', 'bold-post'), value: 'all' });

    const getAttrKey = (base, device) => {
        if (device === 'desktop') return base;
        return `${base}${device.charAt(0).toUpperCase() + device.slice(1)}`;
    };

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                {/* Query settings panel group */}
                <PanelBody title={__('Query', 'bold-post')} initialOpen={true}>
                    <NumberControl
                        label={__('Categories Per Page', 'bold-post')}
                        value={attributes.perPage}
                        onChange={(value) => setAttributes({ perPage: value })}
                        help={__('Number of categories to display', 'bold-post')}
                        __next40pxDefaultSize={true}
                    />
                    <SelectControl
                        label={__('Includes', 'bold-post')}
                        value={attributes.includes}
                        onChange={(value) => setAttributes({ includes: value })}
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
                        label={__('Order', 'bold-post')}
                        value={attributes.order}
                        onChange={(value) => setAttributes({ order: value })}
                        options={[
                            { label: __('Ascending', 'bold-post'), value: 'ASC' },
                            { label: __('Descending', 'bold-post'), value: 'DESC' },
                        ]}
                        help={__('Order of categories to display', 'bold-post')}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                    <SelectControl
                        label={__('Order By', 'bold-post')}
                        value={attributes.orderby}
                        onChange={(value) => setAttributes({ orderby: value })}
                        options={[
                            { label: __('Name', 'bold-post'), value: 'name' },
                            { label: __('Count', 'bold-post'), value: 'count' },
                            { label: __('ID', 'bold-post'), value: 'id' },
                            { label: __('Slug', 'bold-post'), value: 'slug' },
                        ]}
                        help={__('Order categories by', 'bold-post')}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                    <ToggleControl
                        label={__('Hide Empty Categories', 'bold-post')}
                        checked={attributes.hideEmpty}
                        onChange={(value) => setAttributes({ hideEmpty: value })}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                <PanelBody title={__('Layout', 'bold-post')} initialOpen={false}>
                    <ImageRadioControl
                        value={attributes.listStyle}
                        onChange={(value) => setAttributes({ listStyle: value })}
                        options={[
                            { label: __('Style 1', 'bold-post'), value: '1', src: style1 },
                        ]}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                {/* Content settings panel group */}
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
                </PanelBody>

                <PanelBody title={__('Description', 'bold-post')} initialOpen={false}>
                    <ToggleControl
                        label={__('Show / Hide', 'bold-post')}
                        checked={attributes.showDescription}
                        onChange={(value) => setAttributes({ showDescription: value })}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                <PanelBody title={__('Count', 'bold-post')} initialOpen={false}>
                    <ToggleControl
                        label={__('Show Post Count', 'bold-post')}
                        checked={attributes.showCount}
                        onChange={(value) => setAttributes({ showCount: value })}
                        __nextHasNoMarginBottom={true}
                    />
                    <ToggleControl
                        label={__('Show Empty Count', 'bold-post')}
                        checked={attributes.showEmptyCount}
                        onChange={(value) => setAttributes({ showEmptyCount: value })}
                        __nextHasNoMarginBottom={true}
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
                                        label={isHover ? __('Background (Hover)', 'bold-post') : __('Background', 'bold-post')}
                                        colorValue={isHover ? attributes.itemBackgroundColorHover : attributes.itemBackgroundColor}
                                        gradientValue={isHover ? attributes.itemBackgroundGradientHover : attributes.itemBackgroundGradient}
                                        onColorChange={(value) => {
                                            const hex = (value && typeof value === 'object') ? value.hex : value;
                                            setAttributes({ [isHover ? 'itemBackgroundColorHover' : 'itemBackgroundColor']: hex });
                                        }}
                                        onGradientChange={(value) => setAttributes({ [isHover ? 'itemBackgroundGradientHover' : 'itemBackgroundGradient']: value })}
                                    />
                                </div>
                            );
                        }}
                    </TabPanel>
                    <Divider />
                    <ResponsiveWrapper label={__('Item Gap', 'bold-post')}>
                        {(device) => (
                            <TextControl
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
                        label={__('Border Radius', 'bold-post')}
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
                                        label={isHover ? __('Color (Hover)', 'bold-post') : __('Color', 'bold-post')}
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
                    <BoxControl
                        label={__('Padding', 'bold-post')}
                        values={attributes.itemTitlePadding}
                        onChange={(value) => setAttributes({ itemTitlePadding: value })}
                    />
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
                                attributes={attributes}
                                setAttributes={setAttributes}
                                attributeKey={getAttrKey('itemTitleTypography', device)}
                            />
                        )}
                    </ResponsiveWrapper>
                </PanelBody>

                <PanelBody title={__('Description', 'bold-post')} initialOpen={false}>
                    <ColorPopover
                        label={__('Color', 'bold-post')}
                        color={attributes.itemDescriptionColor}
                        defaultColor={''}
                        onChange={(value) => {
                            const hex = (value && typeof value === 'object') ? value.hex : value;
                            setAttributes({ itemDescriptionColor: hex });
                        }}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Padding', 'bold-post')}
                        values={attributes.itemDescriptionPadding}
                        onChange={(value) => setAttributes({ itemDescriptionPadding: value })}
                    />
                    <Divider />
                    <ResponsiveWrapper label={__('Margin', 'bold-post')}>
                        {(device) => (
                            <BoxControl
                                values={attributes[getAttrKey('itemDescriptionMargin', device)]}
                                onChange={(value) => setAttributes({ [getAttrKey('itemDescriptionMargin', device)]: value })}
                            />
                        )}
                    </ResponsiveWrapper>
                    <Divider />
                    <ResponsiveWrapper label={__('Typography', 'bold-post')}>
                        {(device) => (
                            <TypographyControls
                                attributes={attributes}
                                setAttributes={setAttributes}
                                attributeKey={getAttrKey('itemDescriptionTypography', device)}
                            />
                        )}
                    </ResponsiveWrapper>
                </PanelBody>

                <PanelBody title={__('Count', 'bold-post')} initialOpen={false}>
                    <ColorPopover
                        label={__('Color', 'bold-post')}
                        color={attributes.countColor}
                        defaultColor={attributes.countColor}
                        onChange={(value) => setAttributes({ countColor: value })}
                    />
                    <ColorPopover
                        label={__('Background Color', 'bold-post')}
                        color={attributes.countBackgroundColor}
                        defaultColor={attributes.countBackgroundColor}
                        onChange={(value) => setAttributes({ countBackgroundColor: value })}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Padding', 'bold-post')}
                        values={attributes.countPadding}
                        onChange={(value) => setAttributes({ countPadding: value })}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Border Radius', 'bold-post')}
                        values={attributes.countBorderRadius}
                        onChange={(value) => setAttributes({ countBorderRadius: value })}
                    />
                    <Divider />
                    <TypographyControls
                        label={__('Typography', 'bold-post')}
                        attributes={attributes}
                        setAttributes={setAttributes}
                        attributeKey="countTypography"
                    />
                </PanelBody>

            </InspectorControls>

            <ServerSideRender block="bold-post/category-list" attributes={attributes} httpMethod="POST" />
        </div>
    );
}

