export default async function changeLoginRequest(newLogin) {
    if(!newLogin) {
        return {
            success: false,
            error: 'Nie wypełniono wszystkich pól'
        };
    }

    try {
        const response = await fetch ('/api/v1/changeLogin', {
            method: "PATCH",
            credentials: 'include',
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({new_login: newLogin})          
        });

        const result = await response.json();
        if(result.success) {
            return {
                success: result.success,
                newLogin: result.newLogin
            }
        } else {
            return {
                success: result.success,
                error: result.error
            }
        }
    } catch(error) {
        return {error: error.message};
    }
}