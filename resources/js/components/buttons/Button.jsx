import React from "react";

export default function Button({ label, handleClick }) {
    return (
        <div
            onClick={handleClick}
            className="flex items-center justify-center w-full px-4 py-2 rounded-lg bg-orange-500 text-white text-lg font-semibold shadow-md hover:bg-orange-600 active:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-400 transition-all duration-200 ease-in-out cursor-pointer"
        >
            {label}
        </div>
    );
}

