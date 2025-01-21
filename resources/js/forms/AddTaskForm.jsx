import React, {useState} from "react";

//Components
import Button from "../components/buttons/Button";
import Text from "../components/inputs/Text.jsx";

export default function AddTaskForm({callBack}) {

    const [inputs, setInputs] = useState({
        text: '',
    });
    const [errors, setErrors] = useState([]);

    const handleChange = (event) => {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;

        setInputs({...inputs, [target.name]: value});
    }

    const handleSubmit = () => {
        //Create post data
        let data = {
            text: inputs.text,
        };

        axios.post('/task', data)
            .then(function (response) {
                setInputs({text: ''});
                callBack();
            })
            .catch(function (error) {
               setErrors(error.response.data.errors);
            });
    }

    return (
        <div className="w-1/4">

            <div className="w-full">
                {/* Email Field */}
                <div className="mb-2">
                    <Text
                        handleChange={handleChange}
                        label=""
                        name="text"
                        value={inputs.text}
                        placeholder="Add a new task"
                        error={errors?.text}
                    />
                </div>

                {/* Submit Button */}
                <div className="">
                    <Button
                        label="Add task"
                        handleClick={handleSubmit}
                        className="w-full py-3 text-white bg-blue-600 rounded hover:bg-blue-700 transition-all duration-200"
                    />
                </div>
            </div>
        </div>
    );
}
