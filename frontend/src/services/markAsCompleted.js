export default async function markAsCompleted(taskID) {
    if(!taskID) {
        return false;
    }

    try {
        const response = await fetch('/api/v2/markAsDone', {
            method: 'PATCH',
            credentials: 'include',
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
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