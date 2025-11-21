export default async function getUserLogin() {
    try {
        const response = await fetch('/api/v1/getLogin', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });
        // console.log(response.login);
        // console.log(response);
        // console.log("GETUSERLOGIN: ", response.login);
        // return response.login;
        const result = await response.json();
        return result.login;
    } catch {
        return false;
    }
}