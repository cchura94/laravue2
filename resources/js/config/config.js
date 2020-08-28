export const base_url = "//localhost:8000/api";

export const urlLogin = base_url + "/auth/login";


export function getHeader() {

    try {
        const token = JSON.parse(atob(localStorage.getItem("token")));
        const headers = {
            'Accept': 'application/json',
            'Authorization': "bearer " + token.access_token
        }
        return headers;
    } catch (error) {
        localStorage.removeItem("token");
    }



}
