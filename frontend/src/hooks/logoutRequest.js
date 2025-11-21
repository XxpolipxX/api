export default async function logoutRequest() {
    try {
        const response = await fetch ('/api/v1/logout', {
            method: "DELETE",
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        return response.ok;
    } catch {
        return false;
    }
}