import React, {useEffect, useState} from "react";

// Forms
import AddTaskForm from "../forms/AddTaskForm.jsx";

// Cards
import Task from "../components/cards/Task.jsx";

export default function HomePage() {
    const [tasks, setTasks] = useState([]); // State for the list of tasks

    const handleDelete = (id) => {
        axios.delete('/task/'+id).then(function (response) {
            //TODO
        });
        getTasks();
    }

    //Get list of tasks
    const getTasks = () => {
        axios.get('/task').then(function (response) {
            setTasks(response.data.data);
        });
    }

    // Fetch tasks when the component mounts
    useEffect(() => {
        getTasks();
    }, []); // Empty dependency array ensures this runs only once

    return (
        <div className="flex flex-col items-center justify-center h-screen bg-gray-100 p-4">
            <h1 className="text-3xl font-semibold mb-4 text-blue-600">To-Do List App</h1>

            {/* Input for new task */}
            <AddTaskForm callBack={getTasks} />

            {/* Display tasks */}
            <div className="mt-4 w-1/4">
                {tasks.length === 0 ? (
                    <div className="text-gray-500">No tasks yet, add one!</div>
                ) : (
                    tasks.map((task, index) => (
                        <Task key={index} task={task} onDelete={handleDelete} />
                    ))
                )}
            </div>
        </div>
    );
}

