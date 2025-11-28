import { useEffect, useState } from "react";
import getUserLogin from "../hooks/getUserLogin";
import Loading from "../components/Loading";
import UserCrud from "../components/userCrud/UserCrud";
import TaskCrud from "../components/taskCrud/TaskCrud";

export default function HomePage({ setSessionActive }) {
    const [login, setLogin] = useState(null);

    useEffect(() => {
        getUserLogin().then(setLogin);
    }, []);

    if(login === null) {
        return <Loading />;
    }

    return (
        <div className="todo-container fade-in">
            <h1 className="title">TODO List</h1>
            <h3 className="subtitle">Witaj, <span className="username">{login}</span>!</h3>

            <UserCrud setLogin={setLogin} setSessionActive={setSessionActive} />
            <TaskCrud />
        </div>
    );
}