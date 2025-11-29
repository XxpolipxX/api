import { useState, useEffect } from "react";
import getCategories from "../../hooks/getCategories";

export default function Category({ onCategoryChange, category }) {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        async function fetchData() {
            const data = await getCategories();
            setCategories(data);
            if (data.length > 0 && !category) {
                onCategoryChange(data[0].id);
            }
        }
        fetchData();
    }, [onCategoryChange]);

    return (
        <select
            className="text-field"
            name="category"
            value={category}
            onChange={(e) => onCategoryChange(e.target.value)}
        >
            {categories.map((cat) => (
                <option value={cat.id} key={cat.id}>
                    {cat.name}
                </option>
            ))}
        </select>
    );
}