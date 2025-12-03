import { useState } from "react";
import CategorySelect from "./CategorySelect";
import PrioritySelect from "./PrioritySelect";

export default function FiltrTasks({ handleClick }) {
    const [showDescription, setShowDescription] = useState(false);
    const [showCategories, setShowCategories] = useState(false);
    const [showPriority, setShowPriority] = useState(false);
    const [showDate, setShowDate] = useState(false);
    const [showStatus, setShowStatus] = useState(false);

    const [category, setCategory] = useState("");
    const [priority, setPriority] = useState("");
    const [dueDateGt, setDueDateGt] = useState("");
    const [dueDateLt, setDueDateLt] = useState("");
    const [status, setStatus] = useState("0");

    return (
        <div className="filters">
            <h4 className="filters-title">Wybierz pola do pobrania: </h4>
            <div className="filter-fields">
                <label><input type="checkbox" checked disabled/>Tytuł (zawsze)</label>

                <label><input type="checkbox" checked={showDescription} onChange={(e) => setShowDescription(e.target.checked)}/>Opis</label>
                <label><input type="checkbox" checked={showCategories} onChange={(e) => setShowCategories(e.target.checked)}/>Kategoria</label>
                <label><input type="checkbox" checked={showPriority} onChange={(e) => setShowPriority(e.target.checked)}/>Priorytet</label>
                <label><input type="checkbox" checked={showDate} onChange={(e) => setShowDate(e.target.checked)}/>Data</label>
                <label><input type="checkbox" checked={showStatus} onChange={(e) => setShowStatus(e.target.checked)}/>Status</label>
            </div>

            <h4 className="filters-title">Filtry zadań: </h4>
            <div className="filter-options">
                <div className="filter-group">
                    <label>Kategoria</label>
                    <CategorySelect onCategoryChange={setCategory} category={category}/>
                </div>
                <div className="filter-group">
                    <label>Priorytet</label>
                    <PrioritySelect onPriorityChange={setPriority} priority={priority}/>
                </div>
                <div className="filter-group">
                    <label>Termin po:</label>
                    <input type="date" value={dueDateGt} onChange={(e) => setDueDateGt(e.target.value)} className="text-field"/>
                </div>
                <div className="filter-group">
                    <label>Termin przed:</label>
                    <input type="date" value={dueDateLt} onChange={(e) => setDueDateLt(e.target.value)} className="text-field"/>
                </div>
                <div className="filter-group">
                    <label>Status zadania: </label>
                    <select className="text-field" value={status} onChange={(e) => setStatus(e.target.value)}>
                        <option value={"0"}>-- wybierz status --</option>
                        <option value={"0"}>Niewykonane</option>
                        <option value={"1"}>Wykonane</option>
                    </select>
                </div>
            </div>

            <button className="user-button success" onClick={handleClick}>Filtruj</button>
        </div>
    );
}