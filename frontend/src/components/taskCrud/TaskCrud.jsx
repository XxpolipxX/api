import { useState } from "react";
import Category from "./Category";
import Priority from "./Priority";
import addTaskRequest from "../../services/addTaskRequest";

export default function TaskCrud() {
    const [title, setTitle] = useState("");
    const [category, setCategory] = useState("");
    const [priority, setPriority] = useState("");
    const [description, setDescription] = useState("");
    const [date, setDate] = useState("");

    const handleSubmit = async (e) => {
        e.preventDefault();
        // console.log(title);
        // console.log(category);
        // console.log(priority);
        // console.log(description);
        // console.log(date);

        const result = await addTaskRequest(title, category, priority, description, date);
        if(result) {
            console.log(result.task);
        }
    };

    return (
        <form className="task-form" onSubmit={handleSubmit}>
            <input
                type="text"
                placeholder="Tytuł zadania"
                className="text-field"
                required
                onChange={(e) => setTitle(e.target.value)}
                value={title}
                name="title"
            />
            <Category onCategoryChange={setCategory} category={category} />
            <Priority onPriorityChange={setPriority} priority={priority} />
            <textarea className="text-field" placeholder="Opis zadania" value={description} onChange={(e) => setDescription(e.target.value)}></textarea>
            <input type="date" className="text-field"value={date} onChange={(e) => setDate(e.target.value)}/>
            <button type="submit" className="login-button">Dodaj zadanie</button>
        </form>
    );
}