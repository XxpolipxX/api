import AddTaskForm from "../components/taskCrud/AddTaskForm";
import FiltrTasks from "../components/taskCrud/FiltrTasks";
import getFilteredTasks from "../hooks/getFilteredTasks";

export default function TasksPage() {
    const handleClick = async (filters) => {
        const result = await getFilteredTasks(filters);
        console.log("wyniki filtrowania: ", result); 
    };

    return (
        <div className="todo-container fade-in">
            <h1 className="title">Twoje zadania</h1>
            <h3 className="subtitle">Panel zarządzania zadaniami</h3>
            <AddTaskForm />
            <FiltrTasks handleClick={handleClick}/>
        </div>
    );
}