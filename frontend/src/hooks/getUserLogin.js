export default async function getUserLogin() {
    try {
        const response = await fetch('/api/v1/getLogin', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        const result = await response.json();
        return result.login;
    } catch {
        return false;
    }
}