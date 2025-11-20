export default async function handleRegister(login, password, email) {
    if(!login || !password || !email) {
        return {
            success: false,
            error: 'Nie wypełniono wszystkich pól'
        }
    }

    if(password.length < 8) {
        return {
            success: false,
            error: 'Hasło nie spełnia wymagań'
        }
    }

    try {
        const response = await fetch("/api/v1/register", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({login, password, email})
        });

        const result = await response.json();
        // console.log(result);
        if(result.success) {
            return {
                success: result.success,
                login: result.login
            }
        } else {
            return {
                success: result.success,
                error: result.error
            }
        }
    } catch(error) {
        return {error: error.message}
    }
}
