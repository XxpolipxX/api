export default async function deleteTaskRequest(taskID) {
    if(!taskID) {
        return false;
    }

    try {
        const response = await fetch('/api/v2/deleteTask', {
            method: 'DELETE',
            credentials: 'include',
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({task_id: taskID})
        });

        if(!response.ok) {
            return false;
        }

        const result = await response.json();
        return result;
    }catch {
        return false;
    }
}