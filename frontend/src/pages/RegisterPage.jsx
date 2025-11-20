import AuthForm from "../components/AuthForm";
import handleRegister from "../services/handleRegister";

export default function RegisterPage() {
  return (
    <AuthForm
      title="TODO List"
      subtitle="Zarejestruj się, aby kontynuować"
      fields={[
        {type: "email", placeholder: "Adres email", name: 'email', required: true},
        { type: "text", placeholder: "Nazwa użytkownika", name: 'login', required: true },
        { type: "password", placeholder: "Hasło", name: 'password', required: true, minLength: 8 },
      ]}
      submitLabel="Zarejestruj się"
      bottomText="Masz już konto?"
      bottomLink="/login"
      bottomLinkLabel="Zaloguj się"
      onSubmit={({ login, password, email }) => handleRegister(login, password, email)}
      successMessage="Rejestracja zakończona pomyślnie"
    />
  );
}