import App from "./App";
import { render } from '@wordpress/element';
import { createRoot } from 'react-dom/client';

/**
 * Import the stylesheet for the plugin.
 */
import './css/main.scss';
import './css/index.css'

const container = document.getElementById('my-plugin-app');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<App/>);
