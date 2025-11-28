import { useEffect, useState } from "react";
import getPriorities from "../../hooks/getPriorities";

export default function Priority({ onPriorityChange, priority }) {
    const [priorities, setPriorities] = useState([]);

    useEffect(() => {
        async function fetchData() {
            const data = await getPriorities();
            setPriorities(data);
            if(data.length > 0 && !priority) {
                onPriorityChange(data[0].id);
            }
        }
        fetchData();
    }, [onPriorityChange]);

    return (
        <select
            className="text-field"
            name="priority"
            value={priority}
            onChange={(e) => onPriorityChange(e.target.value)}
        >
            {priorities.map((prio) => (
                <option value={prio.id} key={prio.id}>
                    {prio.name}
                </option>
            ))}
        </select>
    );
}