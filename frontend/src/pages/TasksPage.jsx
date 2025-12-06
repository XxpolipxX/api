import AddTaskForm from "../components/taskCrud/AddTaskForm";
import FiltrTasks from "../components/taskCrud/FiltrTasks";
import getFilteredTasks from "../hooks/getFilteredTasks";
import Tasks from "../components/taskCrud/Tasks";
import { useState } from "react";
import markAsCompleted from "../services/markAsCompleted";
import deleteTaskRequest from "../services/deleteTaskRequest";

export default function TasksPage() {
    const [tasks, setTasks] = useState([]);

    const handleClick = async (filters) => {
        const result = await getFilteredTasks(filters);
        console.log("wyniki filtrowania: ", result);
        setTasks(result); 
    };

    const markAsCompletedHandler = async (id) => {
        const result = await markAsCompleted(id);
        if(result && result.success) {
            setTasks(prev =>
                prev.map(task =>
                    task.id === id ? {...task, is_completed: 1} : task
                )
            );
        }
    };

    const deleteTask = async (id) => {
        const result = await deleteTaskRequest(id);
        if(result && result.success) {
            setTasks(prev => prev.filter(task => task.id !== id));
        }
    };

    return (
        <div className="todo-container fade-in">
            <h1 className="title">Twoje zadania</h1>
            <h3 className="subtitle">Panel zarządzania zadaniami</h3>
            <AddTaskForm />
            <FiltrTasks handleClick={handleClick}/>
            <Tasks tasks={tasks} markAsCompleted={markAsCompletedHandler} deleteTask={deleteTask}/>
        </div>
    );
}