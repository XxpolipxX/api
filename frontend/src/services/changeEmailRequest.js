export default async function changeEmailRequest(newEmail) {
    if(!newEmail) {
        return {
            success: false,
            error: 'Nie wypełniono wszystkich pól'
        };
    }

    try {
        const response = await fetch ('/api/v1/changeEmail', {
            method: "PATCH",
            credentials: 'include',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({new_email: newEmail})
        });

        const result = await response.json();
        if(result.success) {
            return {
                success: result.success,
                newEmail: result.newEmail
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