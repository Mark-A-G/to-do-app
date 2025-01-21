import React, {useState} from "react";
import {useNavigate} from "react-router-dom";

export default function UserLayout({ children }){

    const navigate = useNavigate();
    const [authorised, setAuthorised] = useState(false);

    //Authorize user
    const authorize = () => {
        axios.get('/authenticated').then(function (response) {
            setAuthorised(true);
        }).catch(function (error) {
            navigate('/');
        });
    }

    authorize();

    return (
       authorised ? children : <div>401 Not Authorised</div>
    );
}
