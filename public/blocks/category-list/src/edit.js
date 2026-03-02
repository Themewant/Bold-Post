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
    excludesOptions.unshift({ label: __('No Excludes', 'boldpost'), value: 'no-excludes' });

    // add all
    includesOptions.unshift({ label: __('All', 'boldpost'), value: 'all' });

    const getAttrKey = (base, device) => {
        if (device === 'desktop') return base;
        return `${base}${device.charAt(0).toUpperCase() + device.slice(1)}`;
    };

    return (
        <div {...useBlockProps()}>
            <InspectorControls>
                {/* Query settings panel group */}
                <PanelBody title={__('Query', 'boldpost')} initialOpen={true}>
                    <NumberControl
                        label={__('Categories Per Page', 'boldpost')}
                        value={attributes.perPage}
                        onChange={(value) => setAttributes({ perPage: value })}
                        help={__('Number of categories to display', 'boldpost')}
                        __next40pxDefaultSize={true}
                    />
                    <SelectControl
                        label={__('Includes', 'boldpost')}
                        value={attributes.includes}
                        onChange={(value) => setAttributes({ includes: value })}
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
                    <SelectControl
                        label={__('Order', 'boldpost')}
                        value={attributes.order}
                        onChange={(value) => setAttributes({ order: value })}
                        options={[
                            { label: __('Ascending', 'boldpost'), value: 'ASC' },
                            { label: __('Descending', 'boldpost'), value: 'DESC' },
                        ]}
                        help={__('Order of categories to display', 'boldpost')}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                    <SelectControl
                        label={__('Order By', 'boldpost')}
                        value={attributes.orderby}
                        onChange={(value) => setAttributes({ orderby: value })}
                        options={[
                            { label: __('Name', 'boldpost'), value: 'name' },
                            { label: __('Count', 'boldpost'), value: 'count' },
                            { label: __('ID', 'boldpost'), value: 'id' },
                            { label: __('Slug', 'boldpost'), value: 'slug' },
                        ]}
                        help={__('Order categories by', 'boldpost')}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                    <ToggleControl
                        label={__('Hide Empty Categories', 'boldpost')}
                        checked={attributes.hideEmpty}
                        onChange={(value) => setAttributes({ hideEmpty: value })}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                <PanelBody title={__('Layout', 'boldpost')} initialOpen={false}>
                    <ImageRadioControl
                        value={attributes.listStyle}
                        onChange={(value) => setAttributes({ listStyle: value })}
                        options={[
                            { label: __('Style 1', 'boldpost'), value: '1', src: style1 },
                        ]}
                        __next40pxDefaultSize={true}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                {/* Content settings panel group */}
                <PanelBody title={__('Content', 'boldpost')} initialOpen={false}>
                    <ResponsiveWrapper label={__('Columns', 'boldpost')}>
                        {(device) => (
                            <SelectControl
                                value={attributes[getAttrKey('columns', device)]}
                                onChange={(value) => setAttributes({ [getAttrKey('columns', device)]: value })}
                                options={[
                                    { label: __('1 Column', 'boldpost'), value: '1' },
                                    { label: __('2 Column', 'boldpost'), value: '2' },
                                    { label: __('3 Column', 'boldpost'), value: '3' },
                                    { label: __('4 Column', 'boldpost'), value: '4' },
                                    { label: __('6 Column', 'boldpost'), value: '6' },
                                ]}
                                __next40pxDefaultSize={true}
                                __nextHasNoMarginBottom={true}
                            />
                        )}
                    </ResponsiveWrapper>

                </PanelBody>

                <PanelBody title={__('Title', 'boldpost')} initialOpen={false}>
                    <SelectControl
                        label={__('Title Tag', 'boldpost')}
                        value={attributes.titleTag}
                        onChange={(value) => setAttributes({ titleTag: value })}
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
                </PanelBody>

                <PanelBody title={__('Description', 'boldpost')} initialOpen={false}>
                    <ToggleControl
                        label={__('Show / Hide', 'boldpost')}
                        checked={attributes.showDescription}
                        onChange={(value) => setAttributes({ showDescription: value })}
                        __nextHasNoMarginBottom={true}
                    />
                </PanelBody>
                <PanelBody title={__('Count', 'boldpost')} initialOpen={false}>
                    <ToggleControl
                        label={__('Show Post Count', 'boldpost')}
                        checked={attributes.showCount}
                        onChange={(value) => setAttributes({ showCount: value })}
                        __nextHasNoMarginBottom={true}
                    />
                    <ToggleControl
                        label={__('Show Empty Count', 'boldpost')}
                        checked={attributes.showEmptyCount}
                        onChange={(value) => setAttributes({ showEmptyCount: value })}
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
                                        label={isHover ? __('Background (Hover)', 'boldpost') : __('Background', 'boldpost')}
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
                    <ResponsiveWrapper label={__('Item Gap', 'boldpost')}>
                        {(device) => (
                            <TextControl
                                value={attributes[getAttrKey('itemGap', device)]}
                                onChange={(value) => setAttributes({ [getAttrKey('itemGap', device)]: value })}
                                __next40pxDefaultSize={true}
                                __nextHasNoMarginBottom={true}
                                max={5}
                            />
                        )}
                    </ResponsiveWrapper>
                    <ResponsiveWrapper label={__('Item Row Gap', 'boldpost')}>
                        {(device) => (
                            <TextControl
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
                        label={__('Border Radius', 'boldpost')}
                        values={attributes.itemBorderRadius}
                        onChange={(nextValues) => setAttributes({ itemBorderRadius: nextValues })}
                    />
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
                                        label={isHover ? __('Color (Hover)', 'boldpost') : __('Color', 'boldpost')}
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
                        label={__('Padding', 'boldpost')}
                        values={attributes.itemTitlePadding}
                        onChange={(value) => setAttributes({ itemTitlePadding: value })}
                    />
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
                    <ResponsiveWrapper label={__('Typography', 'boldpost')}>
                        {(device) => (
                            <TypographyControls
                                attributes={attributes}
                                setAttributes={setAttributes}
                                attributeKey={getAttrKey('itemTitleTypography', device)}
                            />
                        )}
                    </ResponsiveWrapper>
                </PanelBody>

                <PanelBody title={__('Description', 'boldpost')} initialOpen={false}>
                    <ColorPopover
                        label={__('Color', 'boldpost')}
                        color={attributes.itemDescriptionColor}
                        defaultColor={''}
                        onChange={(value) => {
                            const hex = (value && typeof value === 'object') ? value.hex : value;
                            setAttributes({ itemDescriptionColor: hex });
                        }}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Padding', 'boldpost')}
                        values={attributes.itemDescriptionPadding}
                        onChange={(value) => setAttributes({ itemDescriptionPadding: value })}
                    />
                    <Divider />
                    <ResponsiveWrapper label={__('Margin', 'boldpost')}>
                        {(device) => (
                            <BoxControl
                                values={attributes[getAttrKey('itemDescriptionMargin', device)]}
                                onChange={(value) => setAttributes({ [getAttrKey('itemDescriptionMargin', device)]: value })}
                            />
                        )}
                    </ResponsiveWrapper>
                    <Divider />
                    <ResponsiveWrapper label={__('Typography', 'boldpost')}>
                        {(device) => (
                            <TypographyControls
                                attributes={attributes}
                                setAttributes={setAttributes}
                                attributeKey={getAttrKey('itemDescriptionTypography', device)}
                            />
                        )}
                    </ResponsiveWrapper>
                </PanelBody>

                <PanelBody title={__('Count', 'boldpost')} initialOpen={false}>
                    <ColorPopover
                        label={__('Color', 'boldpost')}
                        color={attributes.countColor}
                        defaultColor={attributes.countColor}
                        onChange={(value) => setAttributes({ countColor: value })}
                    />
                    <ColorPopover
                        label={__('Background Color', 'boldpost')}
                        color={attributes.countBackgroundColor}
                        defaultColor={attributes.countBackgroundColor}
                        onChange={(value) => setAttributes({ countBackgroundColor: value })}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Padding', 'boldpost')}
                        values={attributes.countPadding}
                        onChange={(value) => setAttributes({ countPadding: value })}
                    />
                    <Divider />
                    <BoxControl
                        label={__('Border Radius', 'boldpost')}
                        values={attributes.countBorderRadius}
                        onChange={(value) => setAttributes({ countBorderRadius: value })}
                    />
                    <Divider />
                    <TypographyControls
                        label={__('Typography', 'boldpost')}
                        attributes={attributes}
                        setAttributes={setAttributes}
                        attributeKey="countTypography"
                    />
                </PanelBody>

            </InspectorControls>

            <ServerSideRender block="boldpost/category-list" attributes={attributes} httpMethod="POST" />
        </div>
    );
}

