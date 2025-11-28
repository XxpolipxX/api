import { useNavigate } from "react-router-dom";
import logoutRequest from "../../hooks/logoutRequest";

export default function Logout({ setSessionActive }) {
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    const result = await logoutRequest();

    if (result) {
      setSessionActive(false);
      navigate("/login", { replace: true });
    }
  };

  return (
    <form onSubmit={handleSubmit} className="inline-form">
      <input type="submit" value="Wyloguj" className="login-button"/>
    </form>
  );
}