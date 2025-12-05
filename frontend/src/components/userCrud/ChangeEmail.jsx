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
        <form onSubmit={handleSubmit} className="inline-form">
            <input type="email" className="text-field" onChange={(e) => setNewEmail(e.target.value)} value={newEmail} placeholder="Nowy email" required id="new-email" name="new-email" autoComplete="off"/>
            <button type="submit" className="user-button">Zmień email</button>
        </form>
    );
}