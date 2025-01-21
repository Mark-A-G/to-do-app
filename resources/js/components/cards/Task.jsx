import React from "react";

export default function Task({ task, onDelete }) {
    return (
        <div className="w-full p-4 mb-2 bg-white rounded-lg shadow-md border border-gray-200">
            {/* Task Text */}
            <div className="text-gray-800">{task.text}</div>

            {/* Delete Button */}
            <button
                onClick={() => onDelete(task.id)} // Pass the task's ID to the parent
                className="mt-1 text-red-500 hover:text-red-700 focus:outline-none"
            >
                Delete
            </button>
        </div>
    );
}
