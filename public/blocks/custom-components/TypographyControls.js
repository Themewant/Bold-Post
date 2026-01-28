import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import {
    SelectControl,
    TextControl,
    Popover,
    Button,
    Icon
} from '@wordpress/components';

const TypographyControls = ({ label, attributes, setAttributes, attributeKey, nextDefaultSize }) => {
    const [isVisible, setIsVisible] = useState(false);
    const typography = attributes[attributeKey] || {};

    const _nextDefaultSize = nextDefaultSize || false;

    const toggleVisible = () => {
        setIsVisible((state) => !state);
    };

    const updateTypography = (newAttrs) => {
        const nextTypography = {
            ...typography,
            ...newAttrs
        };

        setAttributes({
            [attributeKey]: nextTypography
        });
    };

    return (
        <div className="eshb-typography-control" style={{ position: 'relative' }}>
            <Button
                variant="secondary"
                onClick={toggleVisible}
                style={{ width: '100%', justifyContent: 'space-between', marginBottom: '15px', boxShadow: 'none' }}
            >
                {label}
                <Icon icon="editor-textcolor" />
            </Button>
            {isVisible && (
                <Popover
                    position="bottom center"
                    onFocusOutside={() => setIsVisible(false)}
                >
                    <div style={{ padding: '20px', width: '260px' }}>
                        <TextControl
                            label={__('Font Size', 'bold-post')}
                            value={typography.fontSize}
                            onChange={(val) => updateTypography({ fontSize: val })}
                            help={__('Include unit (e.g., 14px, 1.2rem)', 'bold-post')}
                            __next40pxDefaultSize={true}
                            __nextHasNoMarginBottom={true}
                        />
                        <SelectControl
                            label={__('Font Weight', 'bold-post')}
                            value={typography.fontWeight}
                            options={[
                                { label: __('Default', 'bold-post'), value: 'inherit' },
                                { label: __('Thin (100)', 'bold-post'), value: '100' },
                                { label: __('Light (300)', 'bold-post'), value: '300' },
                                { label: __('Regular (400)', 'bold-post'), value: '400' },
                                { label: __('Medium (500)', 'bold-post'), value: '500' },
                                { label: __('Semi Bold (600)', 'bold-post'), value: '600' },
                                { label: __('Bold (700)', 'bold-post'), value: '700' },
                                { label: __('Extra Bold (800)', 'bold-post'), value: '800' },
                                { label: __('Black (900)', 'bold-post'), value: '900' },
                            ]}
                            onChange={(val) => updateTypography({ fontWeight: val })}
                            __next40pxDefaultSize={true}
                            __nextHasNoMarginBottom={true}
                        />
                        <SelectControl
                            label={__('Text Transform', 'bold-post')}
                            value={typography.textTransform}
                            options={[
                                { label: __('None', 'bold-post'), value: 'none' },
                                { label: __('Uppercase', 'bold-post'), value: 'uppercase' },
                                { label: __('Lowercase', 'bold-post'), value: 'lowercase' },
                                { label: __('Capitalize', 'bold-post'), value: 'capitalize' },
                            ]}
                            onChange={(val) => updateTypography({ textTransform: val })}
                            __next40pxDefaultSize={true}
                            __nextHasNoMarginBottom={true}
                        />
                        <TextControl
                            __next40pxDefaultSize={_nextDefaultSize}
                            label={__('Line Height', 'bold-post')}
                            value={typography.lineHeight}
                            onChange={(val) => updateTypography({ lineHeight: val })}
                            __nextHasNoMarginBottom={true}
                        />
                        <TextControl
                            __next40pxDefaultSize={_nextDefaultSize}
                            label={__('Letter Spacing', 'bold-post')}
                            value={typography.letterSpacing}
                            onChange={(val) => updateTypography({ letterSpacing: val })}
                            help={__('Include unit (e.g., 1px)', 'bold-post')}
                            __nextHasNoMarginBottom={true}
                        />
                        <Button
                            variant="secondary"
                            isSmall
                            onClick={() => {
                                setAttributes({
                                    [attributeKey]: {
                                        fontSize: '',
                                        fontWeight: 'inherit',
                                        lineHeight: '',
                                        textTransform: 'none',
                                        letterSpacing: ''
                                    }
                                });
                                setIsVisible(false);
                            }}
                            style={{ marginTop: '10px', width: '100%', justifyContent: 'center' }}
                        >
                            {__('Reset Typography', 'bold-post')}
                        </Button>
                    </div>
                </Popover>
            )}
        </div>
    );
};

export default TypographyControls;
