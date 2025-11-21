import { useEffect, useState } from "react";
import checkSession from '../hooks/checkSession';
import Loading from "./Loading";

export default function SessionGate({ children }) {
    const [isSessionActive, setIsSessionActive] = useState(null);

    useEffect(() => {
        checkSession().then(setIsSessionActive);
    }, []);

    if(isSessionActive === null) {
        return <Loading />;
    }

    return children(isSessionActive, setIsSessionActive);
}