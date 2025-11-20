import { useEffect, useState } from "react";
import checkSession from '../hooks/checkSession';

export default function SessionGate({ children }) {
    const [isSessionActive, setIsSessionActive] = useState(null);

    useEffect(() => {
        checkSession().then(setIsSessionActive);
    }, []);

    if(isSessionActive === null) {
        return <div className="loading">Sprawdzanie sesji...</div>;
    }

    return children(isSessionActive, setIsSessionActive);
}