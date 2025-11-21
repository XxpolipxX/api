export default async function checkSession() {
    try {
        const response = await fetch('/api/v1/check_session', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        console.log(response);
        return response.ok;
    } catch {
        return false;
    }
}
