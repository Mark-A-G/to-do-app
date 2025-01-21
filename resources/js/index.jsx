import React from 'react';
import { createRoot } from "react-dom/client";
import App from './App.jsx'

// Create a root and render the component
if(document.getElementById('app'))
{
    const root = createRoot(document.getElementById('app'));
    root.render(<App />);
}
