import { createRoot } from "react-dom/client";
import BoldPostApp from './app';
import 'antd/dist/reset.css';
import './style.css';

const container = document.getElementById('bldpst-dashboard');
if (container) {
    const root = createRoot(container);
    root.render(<BoldPostApp />);
}