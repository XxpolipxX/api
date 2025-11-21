import { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import checkSession from "../hooks/checkSession";

export default function AuthForm({
    title,
    subtitle,
    fields,
    submitLabel,
    bottomText,
    bottomLink,
    bottomLinkLabel,
    onSubmit,
    successMessage,
    setSessionActive
}) {
    const [error, setError] = useState("");
    const [success, setSuccess] = useState("");

    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");
        setSuccess("");

        const formData = new FormData(e.target);
        const values = Object.fromEntries(formData.entries());

        const result = await onSubmit(values);

        if(result.success) {
            setSuccess(successMessage || "Operacja zakończona pomyślnie");

            const sessionConfirmed = await checkSession();
            console.log(sessionConfirmed);
            if(sessionConfirmed) {
                setSessionActive(true);
                navigate("/home");
            }
        } else {
            setError(result.error || "Wystąpił błąd");
        }
    };

    return (
        <form method="post" className="login-container fade-in" onSubmit={handleSubmit}>
            <h1 className="title">{title}</h1>
            <h3 className="subtitle">{subtitle}</h3>

            {fields.map((field, index) => (
                <input
                    key={index}
                    type={field.type}
                    placeholder={field.placeholder}
                    className="text-field"
                    name={field.name}
                    required
                    minLength={field.minLength || undefined}
                />
            ))}

            { error && <h4 className="error-label">{error ? error : 'Hasło musi mieć min. 8 znaków, zawierać 1 dużą literę, 1 cyfrę i 1 znak specjalny'}</h4> }
            { success && <h4 className="success-label">{success}</h4> }

            <input type="submit" value={submitLabel} className="login-button"/>

            <h3 className="bottom-text">{bottomText}</h3>
            <Link to={bottomLink} className="register-link">
                {bottomLinkLabel}
            </Link>
        </form>
    );
}