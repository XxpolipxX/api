import { useState } from "react";
import { useNavigate } from "react-router-dom";
import changeLoginRequest from "../services/changeLoginRequest";

export default function ChangeLogin() {
  const [newLogin, setNewLogin] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();

    const result = await changeLoginRequest(newLogin);
    if (result) {
      navigate("/home", { replace: true });
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <input
        type="text"
        placeholder="Nowy login"
        value={newLogin}
        onChange={(e) => setNewLogin(e.target.value)}
      />
      <input type="submit" value="Zmień swój login" />
    </form>
  );
}