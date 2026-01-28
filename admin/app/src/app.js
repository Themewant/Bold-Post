import React, { useState } from 'react';
import {
    Breadcrumb, Layout, Menu, theme, ConfigProvider, App
} from 'antd';
import Dashboard from './custom-components/dashboard';
import Blocks from './custom-components/blocks';
import Settings from './custom-components/settings';
import { DashboardOutlined, SettingOutlined, BlockOutlined } from '@ant-design/icons';
import { icons } from 'antd/es/image/PreviewGroup';


const { Header, Content, Footer } = Layout;


const items = [
    {
        key: 'blocks',
        label: 'Blocks',
        icon: <BlockOutlined />
    }
]

const ThemeData = {
    borderRadius: 2,
    colorPrimary: '#a216ffff',
    Button: {
        colorPrimary: '#a216ffff',
        algorithm: true,
    }
};


export default function BoldPostApp() {

    const {
        token: { colorBgContainer, borderRadiusLG },
    } = theme.useToken();

    const [current, setCurrent] = useState('blocks');

    const changeMenu = (e) => {
        setCurrent(e.key);
        console.log('key', e.key);

    }

    return (

        <ConfigProvider theme={{ token: ThemeData }}>
            <App>
                <Layout>
                    <Header style={{ display: 'flex', alignItems: 'center', background: '#fff' }}>
                        <div className="bold-post-logo">
                            <img src={bldpst.bldpstUrl + 'public/assets/img/icons/plugin-icon-200_200.svg'} alt="bold-post-logo" />
                        </div>
                        <Menu
                            theme="light"
                            mode="horizontal"
                            defaultSelectedKeys={['dashboard']}
                            items={items}
                            style={{ flex: 1, minWidth: 0, fontWeight: 'bold' }}
                            onClick={changeMenu}
                        />
                    </Header>
                    <Content style={{ padding: '0 48px', margin: '24px 0' }}>
                        <div
                            style={{
                                background: colorBgContainer,
                                minHeight: 280,
                                padding: 24,
                                borderRadius: borderRadiusLG,
                            }}
                        >

                            {current === 'blocks' && <Blocks />}
                        </div>
                    </Content>
                    <Footer style={{ textAlign: 'center' }}>
                        Bold Post ©{new Date().getFullYear()} Created by Themewant
                    </Footer>
                </Layout>
            </App >
        </ConfigProvider>

    );
}