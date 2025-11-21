import { useEffect, useState } from "react";
import getUserLogin from "../services/getUserLogin";

export default function HomePage() {
    const [login, setLogin] = useState(null);

    useEffect(() => {
        getUserLogin().then(setLogin);
        console.log(login);
    }, []);

    if(login === null) {
        return (<h1>Oczekiwanie na login</h1>);
    }

    return (
        <h1>Udało się zalogować {login}</h1>
    );
}