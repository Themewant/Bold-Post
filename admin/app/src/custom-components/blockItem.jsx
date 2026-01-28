import React from 'react';
import { Col, Switch } from 'antd';

export default function BlockItem(
    {
        title,
        id,
        description,
        icon,
        onChangeHandler,
        status,
    }
) {
    return (
        <Col className="gutter-row" span={5}>
            <div className="bldpst-block-item">
                <div className="meta">
                    <div className='icon'>
                        <img src={bldpst.bldpstUrl + 'public/assets/img/icons/' + icon} alt="" />
                    </div>
                    <div className='content'>
                        <strong>{title}</strong>
                        <p>{description}</p>
                    </div>
                </div>
                <div className='switch'>
                    <Switch size="small" onChange={onChangeHandler} checked={status === 'enable'} />
                </div>
            </div>
        </Col>
    );
}