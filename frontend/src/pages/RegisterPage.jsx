import AuthForm from "../components/AuthForm";

export default function RegisterPage() {
  return (
    <AuthForm
      title="TODO List"
      subtitle="Zarejestruj się, aby kontynuować"
      fields={[
        {type: "email", placeholder: "Adres email", required: true},
        { type: "text", placeholder: "Nazwa użytkownika", required: true },
        { type: "password", placeholder: "Hasło", required: true, minLength: 8 },
      ]}
      submitLabel="Zarejestruj się"
      bottomText="Masz już konto?"
      bottomLink="/login"
      bottomLinkLabel="Zaloguj się"
    />
  );
}