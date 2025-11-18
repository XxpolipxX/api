import AuthForm from "../components/AuthForm";

export default function LoginPage() {
  return (
    <AuthForm
      title="TODO List"
      subtitle="Zaloguj się, aby kontynuować"
      fields={[
        { type: "text", placeholder: "Nazwa użytkownika", required: true },
        { type: "password", placeholder: "Hasło", required: true, minLength: 8 },
      ]}
      submitLabel="Zaloguj się"
      bottomText="Nie masz jeszcze konta?"
      bottomLink="/register"
      bottomLinkLabel="Zarejestruj się"
    />
  );
}