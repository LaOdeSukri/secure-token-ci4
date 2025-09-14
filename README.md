# Secure Token & CSRF Protection for CodeIgniter 4

Repository ini berisi implementasi **CSRF Protection** dan **Secure Token** tambahan untuk meningkatkan keamanan form & AJAX request di CodeIgniter 4, termasuk untuk halaman layanan publik (tanpa login).

## 🚀 Fitur Utama
- **CSRF Token Otomatis**: Token selalu diperbarui via AJAX sebelum request dikirim.
- **Secure Token Per-Session**: Token acak tambahan untuk mencegah replay attack & CSRF bypass.
- **Support AJAX & Fetch API**: Siap dipakai untuk form biasa maupun request JSON.
- **Reusable Helper**: Disediakan `SecureTokenHelper` agar mudah dipakai di seluruh aplikasi.
- **Modular & Clean Code**: Controller, Model, Helper, dan JS dipisahkan dengan rapi.

## 📂 Struktur Folder


app/
├── Controllers/
│ └── TokenController.php # Endpoint untuk ambil token CSRF & Secure Token
│
├── Helpers/
│ └── secure_token_helper.php # Helper untuk generate & validasi secure token
│
├── Models/
│ └── SecureTokenModel.php # Model untuk menyimpan secure token per session
│
├── Config/
│ └── Routes.php # Route tambahan untuk /token/get
│
public/
└── js/
└── 4z3sToken.js # JS untuk fetch token & inject ke request



## ⚙️ Instalasi
1. Salin seluruh folder dari project ini ke root project CodeIgniter 4.
2. Pastikan **CSRF Protection** aktif di `.env`:
    ```env
    csrfProtection = true
    ```
3. Pastikan file JS `4z3sToken.js` di-load di halaman publik (misalnya `main.php` layout):
    ```html
    <script src="<?= base_url('js/4z3sToken.js') ?>"></script>
    ```

## 🧑‍💻 Contoh Penggunaan (AJAX)
```html
<form id="form-layanan">
  <input type="text" id="nama" name="nama" placeholder="Nama Anda">
  <button type="button" onclick="kirimDataAjax()">Kirim</button>
</form>

<script>
async function kirimDataAjax() {
    await _4z3sToken.fetchTokens(); // Refresh token sebelum kirim
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
    console.log(result);
}
</script>


🔒 Keamanan Tambahan

Secure Token disimpan di database per-session.

Semua request wajib membawa header X-SECURE-TOKEN.

Validasi dilakukan di Controller menggunakan helper.

🧾 Lisensi

MIT License © 2025 LaOdeSukri


--
