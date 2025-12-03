import Logout from "./Logout";
import ChangeLogin from "./ChangeLogin";
import ChangeEmail from "./ChangeEmail";
import DeleteAccount from "./DeleteAccount";
import { Link } from "react-router-dom";

export default function UserCrud({ setSessionActive, setLogin }) {
    return (
        <>
            <div className="actions-box">
                <h2>Zarządzanie kontem</h2>

                <ChangeLogin setLogin={setLogin} />
                <ChangeEmail />
                <Logout setSessionActive={setSessionActive}/>
                <DeleteAccount setSessionActive={setSessionActive} />
            </div>

            <Link to={"/home/tasks"} className="register-link">Przejdź do zadań</Link>
        </>
    );
}