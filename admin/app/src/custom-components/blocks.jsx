import React, { useState } from 'react';
import BlockItem from './blockItem';
import { Row, notification } from 'antd';


export default function Blocks() {
    const [blocks, setBlocks] = useState(bldpst.blocks);

    // update by ajax
    const updateBlockStatus = (blockId, currentStatus) => { // Accept currentStatus to calculate new one locally
        const newStatus = currentStatus === 'enable' ? 'disable' : 'enable';

        // Optimistic Update
        setBlocks(prevBlocks => prevBlocks.map(block =>
            block.id === blockId ? { ...block, status: newStatus } : block
        ));

        const data = {
            action: 'bldpst_update_block_status',
            blockId: blockId,
            status: newStatus,
            nonce: bldpst.nonce
        };

        console.log('Sending data:', data);

        fetch(bldpst.rest_url + 'update-block-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': bldpst.nonce
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                console.log('Response:', data);
                // API returns { status: 'success', saved_status: '...' }
                if (data.status === 'success') {
                    // Update global variable to keep in sync if needed (optional but good for consistency if mixed usage)
                    // bldpst.blocks reference doesn't automatically update, but we can update if we strongly need to.
                    // For now, rely on local state.

                    // Verify server state matches optimistic state (optional double check)
                    if (data.saved_status !== newStatus) {
                        setBlocks(prevBlocks => prevBlocks.map(block =>
                            block.id === blockId ? { ...block, status: data.saved_status } : block
                        ));
                    }
                    notification.success({
                        message: 'Block Status Updated',
                        description: 'Block status has been updated successfully.',
                        duration: 2,
                    });
                } else {
                    // Revert on API failure signal
                    console.error('API Error:', data);
                    setBlocks(prevBlocks => prevBlocks.map(block =>
                        block.id === blockId ? { ...block, status: currentStatus } : block
                    ));
                    notification.error({
                        message: 'Block Status Update Failed',
                        description: 'Block status update failed. Please try again.',
                        duration: 2,
                    });
                }
            })
            .catch((error) => {
                console.error('Network Error:', error);
                // Revert on Network Error
                setBlocks(prevBlocks => prevBlocks.map(block =>
                    block.id === blockId ? { ...block, status: currentStatus } : block
                ));
            });

    }

    return (
        <div className='bldpst-options-content'>
            <h1 className='bldpst-options-title'>Blocks</h1>
            <Row gutter={[16, 16]} justify="space-between">
                {blocks.map((block, index) => (

                    <BlockItem
                        key={index}
                        title={block.title}
                        id={block.id}
                        description={block.description}
                        icon={block.iconName}
                        onChangeHandler={() => updateBlockStatus(block.id, block.status)}
                        status={block.status}
                    />

                ))
                }
            </Row>
        </div>
    );
}
