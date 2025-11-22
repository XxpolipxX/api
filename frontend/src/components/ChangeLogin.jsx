import { useState } from "react";
import changeLoginRequest from "../services/changeLoginRequest";

export default function ChangeLogin({ setLogin }) {
  const [newLogin, setNewLogin] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    const result = await changeLoginRequest(newLogin);
    if (result) {
      console.log(result.newLogin);
      setLogin(result.newLogin);
    }

    setNewLogin("");
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