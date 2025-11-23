import Logout from "./Logout";
import ChangeLogin from "./ChangeLogin";
import ChangeEmail from "./ChangeEmail";
import DeleteAccount from "./DeleteAccount";

export default function UserCrud({ setSessionActive, setLogin }) {
    return (
        <div className="container">
            <Logout setSessionActive={setSessionActive}/>
            <ChangeLogin setLogin={setLogin} />
            <ChangeEmail />
            <DeleteAccount setSessionActive={setSessionActive} />
        </div>
    );
}