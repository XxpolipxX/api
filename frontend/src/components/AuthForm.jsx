import { Link } from "react-router-dom";

export default function AuthForm({
    title,
    subtitle,
    fields,
    submitLabel,
    bottomText,
    bottomLink,
    bottomLinkLabel
}) {
    return (
        <form method="post" className="login-container fade-in">
            <h1 className="title">{title}</h1>
            <h3 className="subtitle">{subtitle}</h3>

            {fields.map((field, index) => (
                <input
                    key={index}
                    type={field.type}
                    placeholder={field.placeholder}
                    className="text-field"
                    required
                    minLength={field.minLength || undefined}
                />
            ))}

            <h4 className="error-label">Tu bedo erory</h4>
            <h4 className="success-label">Tu bedzie że pykło</h4>

            <input type="submit" value={submitLabel} className="login-button"/>

            <h3 className="bottom-text">{bottomText}</h3>
            <Link to={bottomLink} className="register-link">
                {bottomLinkLabel}
            </Link>
        </form>
    );
}