<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'ড্যাশবোর্ড | Chashi Admin')</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Raleway:wght@600;700;800&family=Noto+Sans+Bengali:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
</head>

<body>
  <!-- ===== SIDEBAR (Laravel: layouts/admin.blade.php-te ekbar) ===== -->
  <aside id="side">
    <a class="brand" href="{{ route('index') }}"><span class="logo-mark">C</span> Chashi</a>
    <nav>
      <a href="{{route('index')}}" class="nav-i {{request()->routeIs('index') ? 'active': ''}} "><i class="bi bi-speedometer2"></i>ড্যাশবোর্ড</a>
      <a href="{{route('banner')}}" data-route="banners" class="nav-i {{request()->routeIs('banner') ? 'active': ''}} "><i class="bi bi-images"></i>ব্যানার</a>
      <a href="{{route('categories')}}" data-route="categories" class="nav-i {{request()->routeIs('categories') ? 'active': ''}} "><i class="bi bi-grid"></i>ক্যাটাগরি</a>
      <a href="{{route('product')}}" data-route="products" class="nav-i {{request()->routeIs('product') ? 'active': ''}} "><i class="bi bi-box-seam"></i>পণ্য</a>
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
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>