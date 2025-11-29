export default async function addTaskRequest(title, categoryID, priorityID, description, date) {
    if(!title || !categoryID || !priorityID || !description || !date) {
        return {
            success: false,
            error: 'Nie wypełniono wszystkich pól'
        };
    }

    try {
        const response = await fetch('/api/v2/addTask', {
            method: 'POST',
            credentials: 'include',
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                title: title,
                description: description,
                due_date: date,
                category_id: categoryID,
                priority_id: priorityID,
                is_completed: false
            })
        });

        const result = await response.json();
        if(result.success) {
            return {
                success: result.success,
                task: result.task
            };
        } else {
            return {
                success: result.success,
                error: result.error
            };
        }
    }catch(error) {
        return {error: error.message};
    }
}