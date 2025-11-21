import { useEffect, useState } from "react";
import getUserLogin from "../hooks/getUserLogin";
import Loading from "../components/Loading";

export default function HomePage() {
    const [login, setLogin] = useState(null);

    useEffect(() => {
        getUserLogin().then(setLogin);
        console.log(login);
    }, []);

    if(login === null) {
        return <Loading />;
    }

    return (
        <h1>Udało się zalogować {login}</h1>
    );
}