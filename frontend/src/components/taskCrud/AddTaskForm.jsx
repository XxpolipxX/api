import { useState } from "react";
import CategorySelect from "./CategorySelect";
import PrioritySelect from "./PrioritySelect";
import addTaskRequest from "../../services/addTaskRequest";

export default function AddTaskForm() {
    const [title, setTitle] = useState("");
    const [category, setCategory] = useState("");
    const [priority, setPriority] = useState("");
    const [description, setDescription] = useState("");
    const [date, setDate] = useState("");

    const [success, setSuccess] = useState("");
    const [error, setError] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        setError("");
        setSuccess("");

        const result = await addTaskRequest(title, category, priority, description, date);

        if(result.success) {
            setSuccess("Udało się dodać zadanie");
        } else {
            setError(result.error);
        }
    };

    return (
        <form className="task-form" onSubmit={handleSubmit}>
            <input
                type="text"
                placeholder="Tytuł zadania"
                className="text-field"
                required
                value={title}
                onChange={(e) => setTitle(e.target.value)}
            />
            <CategorySelect onCategoryChange={setCategory} category={category} />
            <PrioritySelect onPriorityChange={setPriority} priority={priority} />
            <textarea
                className="text-field"
                placeholder="Opis zadania"
                value={description}
                onChange={(e) => setDescription(e.target.value)}
            ></textarea>
            <input type="date" className="text-field" required value={date} onChange={(e) => setDate(e.target.value)}/>
            <button type="submit" className="login-button">Dodaj zadanie</button>

            {error && <h4 className="error-label">{error ? error : ''}</h4>}
            {success && <h4 className="success-label">{success ? success : ''}</h4>}
        </form>
    );
}