export default async function getPriorities() {
    try {
        const response = await fetch('/api/v2/getPriorities', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        const result = await response.json();
        if(result.success) {
            return result.priorities;
        }
        return [];
    } catch {
        return false;
    }
}