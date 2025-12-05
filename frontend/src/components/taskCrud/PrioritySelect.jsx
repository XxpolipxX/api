import { useEffect, useState } from "react";
import getPriorities from '../../hooks/getPriorities';

export default function PrioritySelect({ onPriorityChange, priority, id, name }) {
    const [priorities, setPriority] = useState([]);

    useEffect(() => {
        async function fetchData() {
            const data = await getPriorities();
            setPriority(data);
            if(data.length > 0 && !priority) {
                onPriorityChange(data[0].id);
            }
        }
        fetchData();
    }, [onPriorityChange]);

    return (
        <select
            className="text-field"
            name={name || undefined}
            value={priority || undefined}
            onChange={(e) => onPriorityChange(e.target.value)}
            id={id || undefined}
        >
            {priorities.map((prio) => (
                <option value={prio.id} key={prio.id}>
                    {prio.name}
                </option>
            ))}
        </select>
    );
}