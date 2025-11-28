import { useState } from "react";
import Category from "./Category";
import Priority from "./Priority";

export default function TaskCrud() {
    const [title, setTitle] = useState("");
    const [category, setCategory] = useState("");
    const [priority, setPriority] = useState("");
    const [description, setDescription] = useState("");

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log(title);
        console.log(category);
        console.log(priority);
        console.log(description);
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
            <button type="submit" className="user-button">Dodaj</button>
        </form>
    );
}