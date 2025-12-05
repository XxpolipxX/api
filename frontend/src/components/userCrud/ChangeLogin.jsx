import { useState } from "react";
import changeLoginRequest from "../../services/changeLoginRequest";

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
    <form onSubmit={handleSubmit} className="inline-form">
      <input type="text" onChange={(e) => setNewLogin(e.target.value)} name="new-login" id="new-login" required className="text-field" placeholder="Nowy login" autoComplete="off"/>
      <button type="submit" className="user-button">Zmień login</button>
    </form>
  );
}