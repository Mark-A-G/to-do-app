import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";

// Simple React component
export default function App() {
    return (
        <BrowserRouter>
            <Routes>
                {/* Guest Routes */}
                <Route path="/" element={<div>Hello world</div>} />
            </Routes>
        </BrowserRouter>
    );
}
