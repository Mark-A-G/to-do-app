import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";

//Layouts
import UserLayout from "./layouts/UserLayout";

// Pages
import LoginPage from "./pages/LoginPage";
import HomePage from "./pages/HomePage";

// Simple React component
export default function App() {
    return (
        <BrowserRouter>
            <Routes>
                {/* Guest Routes */}
                <Route path="/" element={<LoginPage />} />

                {/* User Routes */}
                <Route path="/home" element={<UserLayout><HomePage /></UserLayout>} />
            </Routes>
        </BrowserRouter>
    );
}
