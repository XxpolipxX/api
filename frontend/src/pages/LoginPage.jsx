import AuthForm from "../components/AuthForm";
import handleLogin from "../services/handleLogin";

export default function LoginPage() {
  return (
    <AuthForm
      title="TODO List"
      subtitle="Zaloguj się, aby kontynuować"
      fields={[
        { type: "text", placeholder: "Nazwa użytkownika", name: 'login', required: true },
        { type: "password", placeholder: "Hasło", name: 'password', required: true, minLength: 8 },
      ]}
      submitLabel="Zaloguj się"
      bottomText="Nie masz jeszcze konta?"
      bottomLink="/register"
      bottomLinkLabel="Zarejestruj się"
      onSubmit={({ login, password }) => handleLogin(login, password)}
    />
  );
}
