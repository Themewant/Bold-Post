import { __ } from '@wordpress/i18n';
import { BaseControl, Tooltip } from '@wordpress/components';

const ImageRadioControl = ({
    label,
    options = [],
    value,
    onChange,
    help
}) => {
    return (
        <BaseControl label={label} help={help} className="eshb-image-radio-control" __nextHasNoMarginBottom={true}>
            <div style={{
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fill, minmax(60px, 1fr))',
                gap: '10px'
            }}>
                {options.map((option, index) => (
                    <Tooltip text={option.label} key={index}>
                        <div
                            className={`eshb-image-radio-item ${value === option.value ? 'active' : ''}`}
                            onClick={() => onChange(option.value)}
                            style={{
                                border: value === option.value ? '2px solid var(--wp-admin-theme-color)' : '1px solid #e0e0e0',
                                borderRadius: '4px',
                                padding: '4px',
                                cursor: 'pointer',
                                backgroundColor: value === option.value ? 'rgba(var(--wp-admin-theme-color-rgb), 0.04)' : '#fff',
                                transition: 'all 0.2s ease',
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'center'
                            }}
                        >
                            <img
                                src={option.src}
                                alt={option.label}
                                style={{
                                    display: 'block',
                                    maxWidth: '100%',
                                    height: 'auto',
                                    borderRadius: '2px'
                                }}
                            />
                        </div>
                    </Tooltip>
                ))}
            </div>
        </BaseControl>
    );
};

export default ImageRadioControl;
