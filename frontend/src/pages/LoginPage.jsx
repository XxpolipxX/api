import AuthForm from "../components/AuthForm";
import handleLogin from "../services/handleLogin";

export default function LoginPage({ setSessionActive }) {
  return (
    <AuthForm
      title="TODO List"
      subtitle="Zaloguj się, aby kontynuować"
      fields={[
        { type: "text", placeholder: "Nazwa użytkownika", name: 'login', required: true },
        { type: "password", placeholder: "Hasło musi mieć co najmniej 8 znaków, 1 dużą literę, 1 cyfrę i 1 znak specjalny", name: 'password', required: true, minLength: 8 },
      ]}
      submitLabel="Zaloguj się"
      bottomText="Nie masz jeszcze konta?"
      bottomLink="/register"
      bottomLinkLabel="Zarejestruj się"
      onSubmit={({ login, password }) => handleLogin(login, password)}
      successMessage="Zalogowano pomyślnie"
      setSessionActive={setSessionActive}
    />
  );
}
