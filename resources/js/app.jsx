import './bootstrap';
//import io from 'socket.io-client';

import Alpine from 'alpinejs';
import $ from 'jquery';
import Echo from 'laravel-echo';
window.Alpine = Alpine;
import React from 'react';
import { createRoot } from 'react-dom/client';
import Example from './components/Example';
import ReactDOM from 'react-dom/client';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';

// Mount React component to DOM

//console.log('React root is mounted to react component');
console.log("React trying to mount:", reactDiv);
const reactDiv = document.getElementById('react-app');
if (reactDiv) {
    createRoot(reactDiv).render(<Example />);
}
if (document.getElementById('react-root')) {
    ReactDOM.render(
        <Example />,
        document.getElementById('react-root')

    );  console.log('React root is mounted to react component');
}



