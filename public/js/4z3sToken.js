const _4z3sToken = (function () {
    let csrfTokenName = null;
    let csrfTokenValue = null;
    let secureToken = null;

    const tokenEndpoint = "/token/refresh";

    async function fetchTokens() {
        try {
            const res = await fetch(tokenEndpoint, {
                method: "GET",
                headers: { "Accept": "application/json" },
                cache: "no-store"
            });

            if (!res.ok) throw new Error(`Token fetch failed: ${res.status}`);

            const data = await res.json();
            csrfTokenName = data.csrf_token_name;
            csrfTokenValue = data.csrf_token_value;
            secureToken = data.secure_token;
            return true;
        } catch (err) {
            console.error("Gagal mengambil token:", err);
            return false;
        }
    }

    function getTokens() {
        return { csrfTokenName, csrfTokenValue, secureToken };
    }

    return { fetchTokens, getTokens };
})();
