import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import {
    RangeControl,
    ColorPicker,
    BaseControl,
    Popover,
    Button,
    Icon,
    SelectControl
} from '@wordpress/components';

const BorderControl = ({ label, value, onChange }) => {

    // Handle potential object for width if coming from default block.json with side values
    let currentWidth = 0;
    if (value?.width) {
        if (typeof value.width === 'object') {
            // Fallback if user defined it as object in block.json
            currentWidth = value.width.top ?? 0;
        } else {
            currentWidth = value.width;
        }
    }

    const borderValue = {
        width: currentWidth,
        style: value?.style ?? 'solid',
        color: value?.color ?? '',
    };

    const { width, style, color } = borderValue;

    // Preview style
    const previewStyle = {
        width: '24px',
        height: '24px',
        borderRadius: '4px',
        borderWidth: (parseInt(width) || 0) + 'px',
        borderStyle: style,
        borderColor: color || '#ddd',
        backgroundColor: '#fff',
    };

    const [isVisible, setIsVisible] = useState(false);
    const toggleVisible = () => setIsVisible(!isVisible);

    const updateBorder = (newPart) => {
        onChange({ ...borderValue, ...newPart });
    };

    const handleColorChange = (newColor) => {
        const hex = (newColor && typeof newColor === 'object') ? (newColor.hex || newColor.color) : newColor;
        updateBorder({ color: hex });
    };

    return (
        <div className="eshb-border-control" style={{ position: 'relative' }}>
            <Button
                variant="secondary"
                onClick={toggleVisible}
                style={{ width: '100%', justifyContent: 'space-between', marginBottom: '15px' }}
            >
                <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                    <div style={{
                        width: '24px',
                        height: '24px',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        marginRight: '5px'
                    }}>
                        <div style={previewStyle} />
                    </div>
                    {label || __('Border', 'boldpost')}
                </div>
                <Icon icon="plus" />
            </Button>
            {isVisible && (
                <Popover position="bottom center" onFocusOutside={() => setIsVisible(false)}>
                    <div style={{ padding: '16px', width: '280px' }}>
                        <RangeControl
                            label={__('Width', 'boldpost')}
                            value={parseInt(width) || 0}
                            onChange={(val) => updateBorder({ width: val })}
                            min={0}
                            max={50}
                        />
                        <SelectControl
                            label={__('Style', 'boldpost')}
                            value={style}
                            options={[
                                { label: 'Solid', value: 'solid' },
                                { label: 'Dashed', value: 'dashed' },
                                { label: 'Dotted', value: 'dotted' },
                                { label: 'Double', value: 'double' },
                                { label: 'Groove', value: 'groove' },
                                { label: 'Ridge', value: 'ridge' },
                                { label: 'Inset', value: 'inset' },
                                { label: 'Outset', value: 'outset' },
                                { label: 'None', value: 'none' },
                            ]}
                            onChange={(val) => updateBorder({ style: val })}
                            __nextHasNoMarginBottom={true}
                        />
                        <BaseControl label={__('Color', 'boldpost')} style={{ marginTop: '15px' }} __nextHasNoMarginBottom={true}>
                            <ColorPicker
                                color={color}
                                onChange={handleColorChange}
                                enableAlpha
                            />
                        </BaseControl>
                        <Button
                            variant="secondary"
                            isSmall
                            onClick={() => {
                                onChange({ width: 0, style: 'solid', color: '' });
                                setIsVisible(false);
                            }}
                            style={{ marginTop: '15px', width: '100%', justifyContent: 'center' }}
                        >
                            {__('Reset', 'boldpost')}
                        </Button>
                    </div>
                </Popover>
            )}
        </div>
    );
};
export default BorderControl;