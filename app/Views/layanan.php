<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Layanan</title>
</head>
<body>
    <h3>Form Layanan</h3>
    <input type="text" id="nama" placeholder="Nama Anda">
    <button onclick="kirimDataAjax()">Kirim</button>

    <script src="<?= base_url('js/4z3sToken.js') ?>"></script>
    <script>
    async function kirimDataAjax() {
        await _4z3sToken.fetchTokens();
        const { csrfTokenName, csrfTokenValue, secureToken } = _4z3sToken.getTokens();

        const data = { nama: document.getElementById('nama').value };

        const res = await fetch("<?= site_url('layanan/submit') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                [csrfTokenName]: csrfTokenValue,
                "X-SECURE-TOKEN": secureToken
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();
        alert(JSON.stringify(result));
    }
    </script>
</body>
</html>
