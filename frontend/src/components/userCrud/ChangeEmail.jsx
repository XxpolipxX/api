import { useState } from "react";
import changeEmailRequest from '../../services/changeEmailRequest';

export default function ChangeEmail() {
    const [newEmail, setNewEmail] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();

        const result = await changeEmailRequest(newEmail);
        if(result) {
            console.log(result.newEmail);
        }
        setNewEmail("");
    };

    return (
        <form onSubmit={handleSubmit}>
            <input type="email" className="text-field" onChange={(e) => setNewEmail(e.target.value)} value={newEmail} placeholder="Nowy email"/>
            <input type="submit" className="login-button" value="Zmień swój email" />
        </form>
    );
}