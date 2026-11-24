<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'ড্যাশবোর্ড | Chashi Admin')</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Raleway:wght@600;700;800&family=Noto+Sans+Bengali:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Laravel: ei 6 ta color settings table theke ashbe (frontend-er moto) */
    :root {
      --primary: #352638;
      --secondary: #B9A0A9;
      --accent: #D5B77A;
      --bg: #F2E9DB;
      --olive: #65705A;
      --text: #28252A
    }

    body {
      font-family: 'Poppins', 'Noto Sans Bengali', sans-serif;
      background: var(--bg);
      color: var(--text)
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .btn,
    .badge {
      font-family: 'Raleway', 'Noto Sans Bengali', sans-serif
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: var(--primary);
      font-weight: 700
    }

    .btn-brand {
      background: var(--primary);
      color: var(--bg);
      border: 1px solid var(--primary)
    }

    .btn-brand:hover {
      background: var(--text);
      color: var(--bg)
    }

    .btn-accent {
      background: var(--accent);
      color: var(--text);
      border: 1px solid var(--accent);
      font-weight: 600
    }

    .btn-accent:hover {
      filter: brightness(.92);
      color: var(--text)
    }

    .btn-outline-brand {
      border: 1px solid var(--primary);
      color: var(--primary);
      background: transparent
    }

    .btn-outline-brand:hover {
      background: var(--primary);
      color: var(--bg)
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 .2rem rgba(213, 183, 122, .35)
    }

    .pagination .page-link {
      color: var(--primary)
    }

    .pagination .active .page-link {
      background: var(--primary);
      border-color: var(--primary);
      color: var(--bg)
    }

    #side {
      position: fixed;
      inset: 0 auto 0 0;
      width: 250px;
      background: var(--primary);
      overflow-y: auto;
      z-index: 1040;
      transition: transform .25s ease
    }

    #side .brand {
      color: #fff;
      font: 800 1.4rem 'Raleway', sans-serif;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: .5rem;
      padding: 1.25rem
    }

    .logo-mark {
      width: 38px;
      height: 38px;
      background: var(--accent);
      color: var(--primary);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center
    }

    #side a.nav-i {
      display: flex;
      align-items: center;
      gap: .7rem;
      color: var(--bg);
      text-decoration: none;
      padding: .7rem 1.25rem;
      border-left: 4px solid transparent;
      font-size: .92rem;
      transition: background .2s, padding-left .2s
    }

    #side a.nav-i:hover {
      background: rgba(255, 255, 255, .08);
      padding-left: 1.5rem
    }

    #side a.nav-i.active {
      background: rgba(213, 183, 122, .15);
      border-left-color: var(--accent);
      color: var(--accent);
      font-weight: 600
    }

    #backdrop {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(40, 37, 42, .5);
      z-index: 1035
    }

    main {
      margin-left: 250px;
      min-height: 100vh
    }

    .topbar {
      background: #fff;
      border-bottom: 1px solid var(--secondary);
      z-index: 1030
    }

    .card-box {
      background: #fff;
      border: 1px solid var(--secondary);
      border-radius: .5rem
    }

    .stat {
      padding: 1.1rem;
      display: flex;
      gap: 1rem;
      align-items: center
    }

    .stat .ic {
      width: 48px;
      height: 48px;
      border-radius: .5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      background: var(--bg);
      color: var(--olive)
    }

    .stat .n {
      font: 700 1.5rem 'Raleway', sans-serif;
      color: var(--primary);
      line-height: 1.1
    }

    .table thead th {
      background: var(--bg);
      color: var(--primary);
      font-size: .85rem;
      white-space: nowrap
    }

    .thumb {
      width: 42px;
      height: 42px;
      border-radius: .3rem;
      object-fit: cover
    }

    .bar-row {
      display: flex;
      align-items: center;
      gap: .6rem;
      margin-bottom: .6rem;
      font-size: .85rem
    }

    .bar-row .lb {
      width: 110px;
      flex-shrink: 0
    }

    .bar-row .bar {
      height: 14px;
      background: var(--olive);
      border-radius: 3px;
      width: 0;
      transition: width .9s cubic-bezier(.2, .7, .2, 1)
    }

    .stars {
      color: var(--accent)
    }

    .st-new {
      background: var(--accent);
      color: var(--text)
    }

    .st-proc {
      background: var(--secondary);
      color: var(--text)
    }

    .st-done {
      background: var(--olive);
      color: #fff
    }

    .st-cancel {
      background: var(--text);
      color: #fff
    }

    @keyframes pageIn {
      from {
        opacity: 0;
        transform: translateY(8px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    tbody tr {
      animation: rowIn .35s ease both
    }

    tbody tr:nth-child(1) {
      animation-delay: .05s
    }

    tbody tr:nth-child(2) {
      animation-delay: .1s
    }

    tbody tr:nth-child(3) {
      animation-delay: .15s
    }

    tbody tr:nth-child(4) {
      animation-delay: .2s
    }

    tbody tr:nth-child(5) {
      animation-delay: .25s
    }

    tbody tr:nth-child(n+6) {
      animation-delay: .3s
    }

    @keyframes rowIn {
      from {
        opacity: 0;
        transform: translateX(-8px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    .stat {
      transition: transform .2s, box-shadow .2s
    }

    .stat:hover {
      transform: translateY(-3px);
      box-shadow: 0 .4rem 1rem rgba(53, 38, 56, .12)
    }

    @media(max-width:991px) {
      #side {
        transform: translateX(-100%)
      }

      #side.open {
        transform: none
      }

      #side.open~#backdrop {
        display: block
      }

      main {
        margin-left: 0
      }
    }

    @media(prefers-reduced-motion:reduce) {
      * {
        animation: none !important;
        transition: none !important
      }
    }
  </style>
</head>

<body>
  <!-- ===== SIDEBAR (Laravel: layouts/admin.blade.php-te ekbar) ===== -->
  <aside id="side">
    <a class="brand" href="{{ route('index') }}"><span class="logo-mark">C</span> Chashi</a>
    <nav>
      <a href="{{route('index')}}" class="nav-i {{request()->routeIs('index') ? 'active': ''}} "><i class="bi bi-speedometer2"></i>ড্যাশবোর্ড</a>
      <a href="{{route('banner')}}" data-route="banners" class="nav-i {{request()->routeIs('banner') ? 'active': ''}} "><i class="bi bi-images"></i>ব্যানার</a>
      <a href="{{route('product')}}" data-route="products" class="nav-i {{request()->routeIs('product') ? 'active': ''}} "><i class="bi bi-box-seam"></i>পণ্য</a>
      <a href="#" data-route="categories" class="nav-i"><i class="bi bi-grid"></i>ক্যাটাগরি</a>
      <a href="#" data-route="orders" class="nav-i"><i class="bi bi-receipt"></i>অর্ডার</a>
      <a href="#" data-route="offers" class="nav-i"><i class="bi bi-megaphone"></i>অফার</a>
      <a href="#" data-route="reviews" class="nav-i"><i class="bi bi-chat-quote"></i>রিভিউ</a>
      <a href="#" data-route="settings" class="nav-i"><i class="bi bi-gear"></i>সেটিংস</a>
    </nav>
  </aside>
  <div id="backdrop"></div>

  <main>
    <div class="topbar d-flex align-items-center gap-3 px-3 py-2 sticky-top">
      <button class="btn btn-outline-brand d-lg-none" id="menuBtn" aria-label="Menu"><i class="bi bi-list"></i></button>
      <h5 class="mb-0 flex-grow-1">@yield('title', 'ড্যাশবোর্ড | Chashi Admin')</h5>
      <a href="{{route('website')}}" target="_blank" class="btn btn-sm btn-outline-brand"><i class="bi bi-box-arrow-up-right me-1"></i>ওয়েবসাইট দেখুন</a>
      <!-- Laravel: logout form (POST) -->
      <a href="login.html" class="btn btn-sm btn-brand"><i class="bi bi-box-arrow-right me-1"></i>লগআউট</a>
    </div>
    <div class="p-3 p-lg-4 page-in">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* Shudhu animation + sidebar toggle. Kono data/CRUD logic nai — sob Laravel-e. */
    document.addEventListener("DOMContentLoaded", () => {
      const side = document.getElementById("side");
      const toggle = () => side.classList.toggle("open");
      document.getElementById("menuBtn")?.addEventListener("click", toggle);
      document.getElementById("backdrop")?.addEventListener("click", toggle);

      // Number count-up: <div data-count="1250" data-prefix="৳">
      document.querySelectorAll("[data-count]").forEach(el => {
        const end = +el.dataset.count,
          pre = el.dataset.prefix || "",
          t0 = performance.now(),
          dur = 900;
        const tick = (t) => {
          const p = Math.min((t - t0) / dur, 1),
            e = 1 - Math.pow(1 - p, 3);
          el.textContent = pre + Math.round(end * e).toLocaleString("en-US");
          if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
      });

      // Bar chart grow: <div class="bar" data-w="60">
      requestAnimationFrame(() => setTimeout(() => {
        document.querySelectorAll(".bar[data-w]").forEach(b => b.style.width = b.dataset.w + "%");
      }, 150));
    });
  </script>
</body>

</html>