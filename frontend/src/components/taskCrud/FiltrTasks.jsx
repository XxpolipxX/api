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

    const onFilterClick = () => {
        handleClick({
            showDescription,
            showCategory: showCategories,
            showPriority,
            showDate,
            showStatus,
            selectedCategory: category,
            selectedPriority: priority,
            selectedDueDateGt: dueDateGt,
            selectedDueDateLt: dueDateLt,
            selectedStatus: status
        });
    };

    return (
        <div className="filters">
            <h4 className="filters-title">Wybierz pola do pobrania: </h4>
            <div className="filter-fields">
                <label htmlFor="show-title"><input type="checkbox" id="show-title" name="show-title" checked disabled/>Tytuł (zawsze)</label>

                <label htmlFor="show-description"><input type="checkbox" checked={showDescription} onChange={(e) => setShowDescription(e.target.checked)} id="show-description" name="show-description"/>Opis</label>
                <label htmlFor="show-category"><input type="checkbox" checked={showCategories} onChange={(e) => setShowCategories(e.target.checked)} id="show-category" name="show-category"/>Kategoria</label>
                <label htmlFor="show-priority"><input type="checkbox" checked={showPriority} onChange={(e) => setShowPriority(e.target.checked)} id="show-priority" name="show-priority"/>Priorytet</label>
                <label htmlFor="show-date"><input type="checkbox" checked={showDate} onChange={(e) => setShowDate(e.target.checked)} id="show-date" name="show-date"/>Data</label>
                <label htmlFor="show-status"><input type="checkbox" checked={showStatus} onChange={(e) => setShowStatus(e.target.checked)} id="show-status" name="show-status"/>Status</label>
            </div>

            <h4 className="filters-title">Filtry zadań: </h4>
            <div className="filter-options">
                <div className="filter-group">
                    <label htmlFor="filtr-tasks-category">Kategoria</label>
                    <CategorySelect onCategoryChange={setCategory} category={category} id="filtr-tasks-category" name="filtr-tasks-category"/>
                </div>
                <div className="filter-group">
                    <label htmlFor="filtr-tasks-priority">Priorytet</label>
                    <PrioritySelect onPriorityChange={setPriority} priority={priority} id={"filtr-tasks-priority"} name="filtr-tasks-priority"/>
                </div>
                <div className="filter-group">
                    <label htmlFor="due-date-gt">Termin po:</label>
                    <input type="date" id="due-date-gt" name="due-date-gt" value={dueDateGt} onChange={(e) => setDueDateGt(e.target.value)} className="text-field"/>
                </div>
                <div className="filter-group">
                    <label htmlFor="due-date-lt">Termin przed:</label>
                    <input type="date" id="due-date-lt" name="due-date-lt" value={dueDateLt} onChange={(e) => setDueDateLt(e.target.value)} className="text-field"/>
                </div>
                <div className="filter-group">
                    <label htmlFor="status">Status zadania: </label>
                    <select id="status" name="status" className="text-field" value={status} onChange={(e) => setStatus(e.target.value)}>
                        <option value={""}>-- wybierz status --</option>
                        <option value={"0"}>Niewykonane</option>
                        <option value={"1"}>Wykonane</option>
                    </select>
                </div>
            </div>

            <button className="user-button success" onClick={onFilterClick}>Filtruj</button>
        </div>
    );
}