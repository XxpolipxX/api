import { useEffect, useState } from "react";
import getUserLogin from "../hooks/getUserLogin";
import Loading from "../components/Loading";
import Logout from "../components/Logout";

export default function HomePage({ setSessionActive }) {
    const [login, setLogin] = useState(null);

    useEffect(() => {
        getUserLogin().then(setLogin);
    }, []);

    if(login === null) {
        return <Loading />;
    }

    return (
        <>
            <h1>Udało się zalogować {login}</h1>
            <Logout setSessionActive={setSessionActive} />
        </>
    );
}