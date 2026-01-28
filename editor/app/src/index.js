import { createElement } from '@wordpress/element';
import { SVG, Path, Rect } from '@wordpress/primitives';
import { registerBlockCategory } from './components/registerBlocklCategory';

const catIcon = () => {
    return createElement(
        SVG,
        { xmlns: "http://www.w3.org/2000/svg", viewBox: "0 0 178 164", width: "20", height: "20", fill: "none" },
        createElement(Path, { d: "M0 37.0188C0 67.5048 6.5328 74.0375 37.0192 74.0375C67.5056 74.0375 74.0384 67.5048 74.0384 37.0188C74.0384 6.53273 67.5056 0 37.0192 0C6.5328 0 0 6.53273 0 37.0188Z", fill: "#A216FF" }),
        createElement(Path, { d: "M0 126.507C0 156.993 6.53003 163.526 37.0034 163.526C67.4768 163.526 74.0384 157.025 74.0384 126.507C74.0384 96.0211 67.5084 89.4884 37.0034 89.4884C6.49848 89.4884 0 96.0211 0 126.507Z", fill: "#A216FF" }),
        createElement(Path, { d: "M89.4854 21.1126C89.4854 38.4993 93.2111 42.225 110.598 42.225C127.985 42.225 131.711 38.4993 131.711 21.1126C131.711 3.7258 127.985 6.47618e-05 110.598 6.47618e-05C93.2111 -0.0179339 89.4854 3.7078 89.4854 21.1126Z", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "11.5153", width: "23.0321", height: "7.67728", rx: "3.83864", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "23.0319", width: "38.3869", height: "7.67728", rx: "3.83864", fill: "#A216FF" }),
        createElement(Path, { d: "M89.4854 81.7632C89.4854 99.1499 93.2111 102.876 110.598 102.876C127.985 102.876 131.711 99.1499 131.711 81.7632C131.711 64.3764 127.985 60.6507 110.598 60.6507C93.2111 60.6327 89.4854 64.3584 89.4854 81.7632Z", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "72.1666", width: "23.0321", height: "7.67728", rx: "3.83864", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "83.6826", width: "38.3869", height: "7.67728", rx: "3.83864", fill: "#A216FF" }),
        createElement(Path, { d: "M89.4854 142.414C89.4854 159.801 93.2111 163.526 110.598 163.526C127.985 163.526 131.711 159.801 131.711 142.414C131.711 125.027 127.985 121.301 110.598 121.301C93.2111 121.283 89.4854 125.009 89.4854 142.414Z", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "132.817", width: "23.0321", height: "7.67728", rx: "3.83864", fill: "#A216FF" }),
        createElement(Rect, { x: "139.393", y: "144.333", width: "38.3869", height: "7.67728", rx: "3.83864", fill: "#A216FF" })
    );
}
registerBlockCategory('bold-post', 'Bold Post', catIcon);