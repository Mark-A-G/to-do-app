import React, {useState} from "react";
import {useNavigate} from "react-router-dom";

//Components
import Button from "../components/buttons/Button";
import Text from "../components/inputs/Text.jsx";
import Password from "../components/inputs/Password.jsx";

export default function LoginForm() {

    const navigate = useNavigate();

    const [inputs, setInputs] = useState({
        email: null,
        password: null,
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
            email: inputs.email,
            password: inputs.password,
        };

        axios.post('/login', data)
            .then(function (response) {
                console.log(response);
                navigate('/home');
            })
            .catch(function (error) {
               setErrors(error.response.data.errors);
            });
    }

    return (
        <div className="w-96 bg-white p-8 rounded-lg shadow-xl space-y-6">
            <div className="text-2xl font-semibold text-center text-blue-600">
                Login
            </div>

            <div className="space-y-4">
                {/* Email Field */}
                <div>
                    <Text
                        handleChange={handleChange}
                        label="Email"
                        name="email"
                        placeholder="Enter your email"
                        error={errors?.email}
                    />
                </div>

                {/* Password Field */}
                <div>
                    <Password
                        handleChange={handleChange}
                        label="Password"
                        name="password"
                        placeholder="Enter your password"
                        error={errors?.password}
                    />
                </div>

                {/* Login Button */}
                <div className="mt-4">
                    <Button
                        label="Log in"
                        handleClick={handleSubmit}
                        className="w-full py-3 text-white bg-blue-600 rounded hover:bg-blue-700 transition-all duration-200"
                    />
                </div>
            </div>

            <div className="text-sm text-center text-gray-500">
                Don't have an account? <a href="/register" className="text-blue-600 hover:underline">Register here</a>
            </div>
        </div>
    );
}
