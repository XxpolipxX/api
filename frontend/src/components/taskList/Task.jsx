export default function Task({ title, priority, description, date, completed }) {
    return (
        <div className="task-item">
            <div className="task-header">
                <span className="task-title">{title}</span>
                <span className={"task-priority " + { priority}}>{priority}</span>
                <span className="task-status">{completed ? "Wykonane" : "Niewykonane"}</span>
            </div>
            <p className="task-desc">{description}</p>
            <p className="task-date">{date}</p>
            <div className="task-actions">
                <button className="user-button">Edytuj</button>
                <button className="user-button">Usuń</button>
                <button className="user-button">Oznacz jako wykonane</button>
            </div>
        </div>
    );
}