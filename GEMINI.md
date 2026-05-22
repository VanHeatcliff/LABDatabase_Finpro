# Clothing Store — Project Instructions for Gemini

> File ini dibaca otomatis oleh Gemini CLI sebagai konteks project.
> Berisi panduan lengkap untuk pengembangan project sebagai **Planner** dan **UI/UX Designer**.

---

## Project Identity

| Attribute | Value |
|-----------|-------|
| **Nama Project** | Clothing Store |
| **Deskripsi** | E-commerce web app untuk penjualan pakaian |
| **Framework** | Laravel 12 (PHP 8.2+) |
| **Database** | SQLite (development) — `database/database.sqlite` |
| **Frontend** | Blade templates + Vite + Tailwind CSS + Alpine.js |
| **Package Manager** | Composer (PHP), npm (JS) |
| **Server** | XAMPP on Windows |
| **Bahasa UI** | Indonesian (Bahasa Indonesia) |
| **Target Audience** | Indonesian young adults (18-35), fashion-conscious |

---

## Architecture Overview

Monolithic Laravel application dengan **domain-organized controllers** dan **service layer pattern**.

### Directory Structure

```
app/
├── Helpers/            # Utility/helper classes
├── Http/
│   ├── Controllers/
│   │   ├── Admin/      # AdminController, AdminAuthController, DashboardController, ProdukController
│   │   ├── Alamat/     # AlamatPengirimanController
│   │   ├── Auth/       # AuthController (pelanggan auth)
│   │   ├── Diskon/     # DiskonController
│   │   ├── Keranjang/  # KeranjangController
│   │   ├── Pelanggan/  # PelangganController
│   │   ├── Pembayaran/ # MetodeBayarController
│   │   ├── Pesanan/    # PesananController, CheckoutController, DetailPesananController
│   │   ├── Produk/     # ProdukController, KategoriController
│   │   └── Ulasan/     # UlasanController
│   ├── Middleware/
│   └── Requests/
├── Models/             # 15 Eloquent models
├── Providers/
└── Services/           # Business logic layer
    ├── DiskonService.php
    ├── PembayaranService.php
    ├── PesananService.php
    └── ProdukService.php

resources/views/
├── Auth/               # Login & register views
├── admin/              # Admin panel views (dashboard, produk, diskon, pesanan)
├── components/         # Reusable: navbar, footer, alert, product-card, sidebar-admin
├── home.blade.php      # Homepage (hero + features + categories)
├── keranjang/          # Cart views
├── layouts/            # app.blade.php (customer), admin.blade.php, auth.blade.php
├── pelanggan/          # Customer profile views
├── pesanan/            # Order views
└── produk/             # index.blade.php (catalog), show.blade.php (detail)

routes/
├── web.php             # Web routes (public + pelanggan + admin)
├── api.php             # RESTful API endpoints
└── console.php         # Artisan commands
```

### Domain Models (15 Eloquent Models)

| Model | Domain | Model | Domain |
|-------|--------|-------|--------|
| `User` | Base user | `Pesanan` | Order |
| `Admin` | Administrator | `DetailPesanan` | Order item |
| `Pelanggan` | Customer | `Pembayaran` | Payment |
| `Produk` | Product | `MetodeBayar` | Payment method |
| `Kategori` | Category | `AlamatPengiriman` | Shipping address |
| `Keranjang` | Cart | `Diskon` | Discount |
| `DetailKeranjang` | Cart item | `DiskonPromosi` | Promo discount |
| `Ulasan` | Review | | |

### Authentication System

- **Dual-guard auth**: `pelanggan` (customers) dan `admin` (administrators)
- Pelanggan: register, login, logout via `AuthController`
- Admin: login, logout via `AdminAuthController`
- Middleware: `auth:pelanggan`, `auth:admin`, `guest:pelanggan`

### Route Groups

1. **Public**: Homepage (`/`), product catalog (`/produk`, `/produk/{id}`)
2. **Guest-only**: Login (`/login`), Register (`/register`)
3. **Pelanggan (auth)**: Cart, checkout, orders, profile, promo codes
4. **Admin (auth)**: Dashboard, CRUD produk/diskon/ulasan, order management
5. **API**: RESTful endpoints mirroring web functionality

---

## Role 1: Planner Agent

Ketika diminta merencanakan fitur atau perubahan, gunakan panduan berikut.

### Planning Workflow

```
1. UNDERSTAND   → Parse request, tanyakan jika ambigu
2. RESEARCH     → Cek file, model, route, dan pattern yang ada
3. ANALYZE      → Identifikasi komponen terdampak, dependensi, risiko
4. DECOMPOSE    → Pecah menjadi sub-task berurutan
5. PLAN         → Tulis implementation plan lengkap
6. REVIEW       → Self-review untuk kelengkapan dan edge cases
7. PRESENT      → Tampilkan plan dan minta feedback
```

### Implementation Plan Format

```markdown
# [Feature/Task Title]

## Summary
Deskripsi singkat tentang apa yang dilakukan dan mengapa.

## Affected Components
- **Models**: [daftar model terdampak]
- **Controllers**: [daftar controller terdampak]
- **Services**: [daftar service terdampak]
- **Views**: [daftar view terdampak]
- **Routes**: [daftar perubahan route]
- **Migrations**: [migrasi baru yang diperlukan]

## Prerequisites
- [ ] Prasyarat yang perlu dicek

## Implementation Steps

### Step 1: [Judul] — [Complexity: Low/Medium/High]
**File(s)**: `path/to/file`
**Action**: CREATE / MODIFY / DELETE
Deskripsi apa yang harus dilakukan dan mengapa.

### Step 2: [Judul] — [Complexity: Low/Medium/High]
...

## Database Changes
- [ ] New migration: `deskripsi`
- [ ] Seed data changes: `deskripsi`

## Risk Assessment
| Risk | Severity | Mitigation |
|------|----------|------------|
| ...  | Low/Med/High | ... |

## Testing Plan
- [ ] Unit tests
- [ ] Feature tests
- [ ] Manual verification

## Open Questions
- [ ] Pertanyaan yang belum terjawab
```

### Task Decomposition Order

Selalu urutkan sub-task berdasarkan dependensi:
```
migrations → models → services → controllers → routes → views → tests
```

---

## Role 2: UI/UX Designer Agent

Ketika diminta membuat atau memperbaiki tampilan, gunakan design system berikut.

### Brand Identity

| Attribute | Value |
|-----------|-------|
| **Brand Name** | CLOTHING**STORE** |
| **Brand Voice** | Premium, minimal, modern, confident |
| **Font** | Poppins (300, 400, 600, 700) via Google Fonts |

### Color Palette

#### Customer-Facing (Storefront)
```
Background        : bg-gray-50 / bg-zinc-50
Surface           : bg-white
Text Primary      : text-zinc-900 / text-gray-900
Text Secondary    : text-zinc-500 / text-gray-500
Text Muted        : text-zinc-400 / text-gray-400
Accent Primary    : bg-zinc-900 / bg-black
Accent Hover      : bg-gray-800 / bg-zinc-800
Accent Text       : text-white
Hero Gradient     : from-zinc-600 to-zinc-400 (text gradient)
Decorative Blobs  : bg-indigo-100/50, bg-rose-100/40
```

#### Admin Panel
```
Sidebar BG        : bg-gray-900
Active Nav        : bg-red-600
Admin Content BG  : bg-gray-100
Danger/Logout     : text-red-600
```

#### Semantic Colors
```
Success : bg-green-500 / text-green-600
Warning : bg-yellow-500 / text-yellow-600
Error   : bg-red-600 / text-red-600
Info    : bg-blue-500 / text-blue-600
Badge   : bg-red-600 text-white rounded-full
```

### Layout Patterns

| Element | Pattern |
|---------|---------|
| Page container | `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8` |
| Section spacing | `mb-24` between major sections |
| Card padding | `p-4` to `p-8` |
| Card radius | `rounded-lg` (small), `rounded-3xl` (hero) |
| Grid gap | `gap-4 md:gap-6` to `gap-6 lg:gap-8` |

### Shadows & Borders
```
Card Default  : shadow-sm border border-gray-200
Card Hover    : hover:shadow-lg
Hero Section  : shadow-sm border border-zinc-100
Image Cards   : shadow-2xl border-4 border-white
Feature Cards : shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-zinc-100
```

### Animation Library

```css
/* Entrance animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fadeInUp 1s ease-out forwards; opacity: 0; }

/* Floating animation */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0px); }
}
.animate-float { animation: float 6s ease-in-out infinite; }

/* Staggered delays */
.delay-100 to .delay-500 (100ms increments)
```

### Transition Patterns
```html
<!-- Hover -->
hover:scale-105 transition-transform
hover:scale-110 transition-transform duration-700
group-hover:opacity-75 transition-opacity

<!-- Alpine.js enter/leave -->
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="transform opacity-0 scale-95"
x-transition:enter-end="transform opacity-100 scale-100"
x-transition:leave="transition ease-in duration-75"
```

### Component Library (Existing)

| Component | File | Purpose |
|-----------|------|---------|
| Navbar | `components/navbar.blade.php` | Sticky top nav, responsive, dual-auth, cart badge |
| Footer | `components/footer.blade.php` | Site footer |
| Alert | `components/alert.blade.php` | Flash messages |
| Product Card | `components/product-card.blade.php` | Product grid item |
| Admin Sidebar | `components/sidebar-admin.blade.php` | Admin navigation |

### Layout System

| Layout | File | Usage |
|--------|------|-------|
| Customer | `layouts/app.blade.php` | Storefront pages (Vite + Poppins + Alpine.js) |
| Admin | `layouts/admin.blade.php` | Admin panel (Tailwind CDN + FontAwesome + sidebar) |
| Auth | `layouts/auth.blade.php` | Login/register pages |

### Design Patterns

**Hero Section**: Full-width, rounded-[3rem], decorative blurred blobs, 2-column (text + images), float animation

**Product Card**: Image (aspect-ratio, hover:opacity-75) → category badge (absolute, bg-black) → name (truncated) → price + cart button (rounded-full)

**Navbar**: Sticky top-0 z-50, white bg, border-bottom, active = border-b-2 border-black, mobile hamburger via Alpine.js

**Category Cards**: h-[30rem], full-bleed bg image, gradient overlay, hover: image scale-110, text slide-up reveal

**Admin Dashboard**: Fixed sidebar (w-64, bg-gray-900) + scrollable content, active nav = bg-red-600

**Forms**: rounded-md inputs, border-gray-300, focus:ring-black, bg-black submit buttons

### Icon Systems

- **Customer pages**: Inline SVG (Heroicons outline style)
- **Admin panel**: FontAwesome 6.4.0 (CDN loaded in admin layout)

### UI Text (Indonesian)

```
Buttons: Belanja Sekarang, Tambah ke Keranjang, Checkout, Masuk, Daftar, Keluar, Simpan, Hapus, Batal
Labels: Riwayat Pesanan, Profil Saya, Keranjang, Katalog, Home, Produk, Dashboard
Status: Menunggu Pembayaran, Diproses, Dikirim, Selesai, Dibatalkan
Currency: Rp {{ number_format($harga, 0, ',', '.') }}
```

---

## Project Conventions

### Naming Conventions

| Element | Convention | Example |
|---------|-----------|---------|
| Models | PascalCase, singular, Indonesian | `Pesanan`, `DetailKeranjang` |
| Controllers | PascalCase + `Controller`, domain folder | `Pesanan/PesananController` |
| Services | PascalCase + `Service` | `PesananService` |
| Views | kebab-case directories | `pesanan/index.blade.php` |
| Routes | kebab-case URLs, dot-notation names | `pesanan.store` |
| DB Tables | snake_case, Indonesian | `detail_keranjang` |

### Code Patterns (WAJIB DIIKUTI)

1. **Service Layer** — Business logic di `app/Services/`, controller tetap thin
2. **Domain Folders** — Controllers diorganisir per domain, BUKAN flat di root Controllers
3. **Blade Components** — UI reusable di `resources/views/components/`
4. **Dual Auth Guards** — Selalu spesifik guard (`pelanggan` atau `admin`)
5. **Resource Routes** — Gunakan `Route::resource()` / `Route::apiResource()` jika applicable
6. **DB Transactions** — Gunakan `DB::transaction()` untuk operasi multi-tabel

### Anti-Patterns (JANGAN DILAKUKAN)

- ❌ Business logic langsung di controller
- ❌ Controller flat di luar domain folder
- ❌ Raw SQL — gunakan Eloquent
- ❌ Hardcode auth guard
- ❌ View tanpa layout system
- ❌ Skip validasi input
- ❌ Inline styles — gunakan Tailwind utilities
- ❌ Placeholder images di production
- ❌ Lupa `@csrf` di form
- ❌ English UI text (target audience Indonesian)
- ❌ `{!! !!}` tanpa sanitasi eksplisit
- ❌ Mixing Tailwind CDN (admin) dengan Vite Tailwind (customer) di satu layout

---

## Security Checklist

Untuk setiap perubahan, SELALU pertimbangkan:

- [ ] Input validation via Form Requests
- [ ] CSRF protection pada forms
- [ ] Authorization checks (user boleh akses resource ini?)
- [ ] SQL injection prevention (Eloquent, bukan raw queries)
- [ ] XSS prevention (`{{ }}` di Blade, bukan `{!! !!}`)
- [ ] File upload validation (type, size) jika ada
- [ ] Rate limiting pada sensitive endpoints

## Performance Checklist

- [ ] Eager loading relationships (hindari N+1)
- [ ] Pagination untuk list views
- [ ] Caching jika appropriate
- [ ] Database indexing pada kolom yang sering di-query
- [ ] Lazy loading images (`loading="lazy"`)
- [ ] Minimize inline `<style>` blocks

---

## Database

- Development menggunakan **SQLite** — hindari syntax khusus MySQL
- Migrations harus compatible dengan SQLite
- Jalankan `php artisan migrate` setelah membuat migration baru

---

## Commands Reference

```bash
# Development
composer dev                    # Start all (server + queue + logs + vite)
php artisan serve               # Laravel dev server
npm run dev                     # Vite dev server

# Database
php artisan migrate             # Run migrations
php artisan migrate:rollback    # Rollback
php artisan db:seed             # Run seeders
php artisan tinker              # Interactive REPL

# Code Generation
php artisan make:model Name -m              # Model + migration
php artisan make:controller Folder/NameController  # Controller di domain folder
php artisan make:request NameRequest        # Form request
php artisan make:migration create_xxx_table # Migration

# Testing
php artisan test                # Run all tests
composer test                   # Via composer script

# Maintenance
php artisan route:list          # Show routes
php artisan config:clear        # Clear config cache
php artisan cache:clear         # Clear app cache
php artisan view:clear          # Clear compiled views
```

---

## Accessibility Requirements

- Semua images harus punya `alt` text deskriptif
- Interactive elements perlu `focus:ring` states
- Color contrast minimum 4.5:1
- Gunakan `sr-only` untuk screen-reader labels
- Touch targets minimum 44x44px di mobile
- Gunakan semantic HTML (`nav`, `main`, `header`, `footer`, `section`)

---

## Responsive Design

Mobile-first approach:
- Single column di mobile → multi-column di desktop
- Hidden nav di mobile → hamburger menu
- Breakpoints: `sm` (640px), `md` (768px), `lg` (1024px), `xl` (1280px)

---

## Quality Checklist (Sebelum Finalisasi)

### Visual
- [ ] Konsisten dengan brand colors dan typography
- [ ] Visual hierarchy benar
- [ ] Semua images punya aspect ratio dan alt text
- [ ] Tidak ada layout yang broken di semua breakpoint
- [ ] Empty states di-design (bukan blank)

### Interactive
- [ ] Semua button/link punya hover state
- [ ] Focus states visible untuk keyboard navigation
- [ ] Form validation errors ditampilkan jelas
- [ ] Success/error feedback via flash messages

### Consistency
- [ ] Menggunakan komponen yang sudah ada
- [ ] Mengikuti color patterns
- [ ] Font Poppins di seluruh halaman
- [ ] Bahasa Indonesia untuk semua UI text
- [ ] Format currency: `Rp X.XXX.XXX`
