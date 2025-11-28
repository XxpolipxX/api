export default async function getCategories() {
    try {
        const response = await fetch('/api/v2/getCategories', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        const result = await response.json();
        if(result.success) {
            return result.categories;
        }
        return [];
    } catch {
        return false;
    }
}