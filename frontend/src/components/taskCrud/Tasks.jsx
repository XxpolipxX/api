export default function Tasks({ tasks, markAsCompleted, deleteTask }) {
  const priorityMap = {
    1: "ważne",
    2: "pilne",
    3: "nie ważne"
  };

  const priorityClassMap = {
    1: "high",
    2: "medium",
    3: "low"
  };

  const categoriesMap = {
    1: "szkoła",
    2: "praca",
    3: "dom"
  };

  const statusMap = {
    0: "oczekujące",
    1: "wykonane"
  };

  return (
    <div className="task-list">
      <h3 className="subtitle">Lista zadań</h3>

      {!tasks || tasks.length === 0 ? (
        <p className="no-tasks">Brak zadań do wyświetlenia.</p>
      ) : (
        tasks.map((task) => (
          <div className="task-item" key={task.id}>
            <div className="task-header">
              <span>{task.title}</span>
              {task.priority_id && (
                <span className={"task-priority " + priorityClassMap[task.priority_id]}>
                  {priorityMap[task.priority_id]}
                </span>
              )}
            </div>
            {task.description && <p>{task.description}</p>}
            {task.category_id && <p>Kategoria: {categoriesMap[task.category_id]}</p>}
            {task.due_date && <p>Termin: {task.due_date}</p>}
            {task.is_completed !== undefined && (
              <p>Status: {statusMap[task.is_completed]}</p>
            )}
            <div className="task-actions">
              {task.is_completed == 0 && (
                <button className="task-btn complete-btn" onClick={() => markAsCompleted(task.id)}>Oznacz jako wykonane</button>
              )}
              <button className="task-btn delete-btn" onClick={() => deleteTask(task.id)}>Usuń</button>
            </div>
          </div>
        ))
      )}
    </div>
  );
}