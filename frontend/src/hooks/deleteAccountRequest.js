export default async function deleteAccountRequest() {
    try {
        const response = await fetch('/api/v1/deleteAccount', {
            method: 'DELETE',
            credentials: 'include',
            headers: {"Accept": 'application/json'}
        });
        return response.ok;
    } catch {
        return false;
    }
}