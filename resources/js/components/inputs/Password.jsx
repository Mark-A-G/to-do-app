import React from "react";

export default function Password({ label, name, placeholder, value, handleChange, error })
{
    return (
        <div>
            <label htmlFor={name} className="block text-sm font-medium text-gray-700">
                {label}
            </label>
            <input
                type="password"
                name={name}
                id={name}
                placeholder={placeholder}
                value={value}
                onChange={handleChange}
                className={`w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out ${error ? 'border-red-500' : ''}`}
            />
            {error && <p className="text-xs text-red-500">{error}</p>}
        </div>
    );
}
