import { useNavigate } from "react-router-dom";
import deleteAccountRequest from "../../hooks/deleteAccountRequest";

export default function DeleteAccount({ setSessionActive }) {
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();

        const result = await deleteAccountRequest();

        if(result) {
            setSessionActive(false);
            navigate("/login", {replace: true});
        }
    }

    return (
        <form onSubmit={handleSubmit} className="inline-form">
            <button className="user-button danger">Usuń konto</button>
        </form>
    );
}