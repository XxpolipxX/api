import { useEffect, useState } from "react";
import checkSession from '../hooks/checkSession';
import Loading from "./Loading";

export default function SessionGate({ children }) {
    const [isSessionActive, setIsSessionActive] = useState(null);

    useEffect(() => {
        checkSession().then(setIsSessionActive);
    }, []);

    if(isSessionActive === null) {
        // return <div className="loading">Sprawdzanie sesji...</div>;
        return <Loading />;
    }

    return children(isSessionActive, setIsSessionActive);
}