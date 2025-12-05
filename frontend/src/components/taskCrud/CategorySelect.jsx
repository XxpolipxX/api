import { useEffect, useState } from 'react';
import getCategories from '../../hooks/getCategories';

export default function CategorySelect({ onCategoryChange, category, name, id }) {
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        async function fetchData() {
            const data = await getCategories();
            setCategories(data);
            if(data.length > 0 && !category) {
                onCategoryChange(data[0].id);
            }
        }
        fetchData();
    }, [onCategoryChange]);

    return (
        <select
            className='text-field'
            name={name || undefined}
            value={category || undefined}
            onChange={(e) => onCategoryChange(e.target.value)}
            id={id || undefined}
        >
            {categories.map((cat) => (
                <option value={cat.id} key={cat.id}>
                    {cat.name}
                </option>
            ))}
        </select>
    );
}