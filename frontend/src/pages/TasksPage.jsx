import AddTaskForm from "../components/taskCrud/AddTaskForm";
import FiltrTasks from "../components/taskCrud/FiltrTasks";

export default function TasksPage() {
    return (
        <div className="todo-container fade-in">
            <h1 className="title">Twoje zadania</h1>
            <h3 className="subtitle">Panel zarządzania zadaniami</h3>
            <AddTaskForm />
            <FiltrTasks />
        </div>
    );
}