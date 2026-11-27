<!DOCTYPE html>
<html lang="bn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chashi Grocery Shop</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Raleway:wght@600;700;800&family=Noto+Sans+Bengali:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <!-- css -->
  <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
</head>

<body>

  <!-- ================= TOP BAR ================= -->
  <div class="topbar py-2">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
      <span><i class="bi bi-geo-alt-fill text-accent me-1"></i> আপনার এলাকার বিশ্বস্ত মুদি দোকান</span>
      <span><i class="bi bi-telephone-fill text-accent me-1"></i> +880 1700-000000 &nbsp;|&nbsp; <i class="bi bi-clock text-accent me-1"></i> সকাল ৭টা – রাত ১০টা</span>
    </div>
  </div>

  <!-- ================= HEADER ================= -->
  <header class="main-nav py-3 sticky-top ">
    <div class="container">
      <div class="row align-items-center g-2">
        <div class="col col-lg-3 order-1">
          <a class="d-flex align-items-center gap-2 text-decoration-none fw-bold fs-4 text-white" href="index.html" style="font-family:'Raleway',sans-serif">
            <span class="logo-mark">C</span> Chashi
          </a>
        </div>

        <!-- Search (Laravel: GET ?q=) -->
        <div class="col-12 col-lg-6 order-3 order-lg-2">
          <form class="search-box input-group" method="GET" action="#products">
            <input type="search" name="q" class="form-control" placeholder="তেল, সাবান, চাল... খুঁজুন">
            <button class="btn btn-accent" type="submit"><i class="bi bi-search"></i></button>
          </form>
        </div>

        <div class="col-auto col-lg-3 order-2 order-lg-3 d-flex justify-content-end align-items-center gap-1 ">
          <!-- Language (Laravel: route /lang/bn, /lang/en) -->
          <div class="btn-group me-1">
            <a href="?lang=bn" class="btn lang-btn active">বাংলা</a>
            <a href="?lang=en" class="btn lang-btn">EN</a>
          </div>
          <!-- Wishlist -->
          <button class="btn btn-accent position-relative" data-bs-toggle="offcanvas" data-bs-target="#wishCanvas" aria-label="Wishlist">
            <i class="bi bi-heart"></i>
            <span id="wishCount" class="badge bg-light text-dark position-absolute top-0 start-100 translate-middle rounded-pill">0</span>
          </button>
          <!-- Account (Laravel: route('login') / dashboard) -->
          <a href="login.html" class="btn btn-accent" aria-label="Account"><i class="bi bi-person"></i></a>
          <!-- Cart -->
          <button class="btn btn-accent position-relative" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas" aria-label="Cart">
            <i class="bi bi-cart3"></i>
            <span id="cartCount" class="badge bg-success text-light position-absolute top-0 start-100 translate-middle rounded-pill">0</span>
          </button>
        </div>
      </div>
    </div>
  </header>

  <nav class="links-nav">
    <div class="container links-scroll">
      <a href="#home">হোম</a>
      <a href="#categories">ক্যাটাগরি</a>
      <a href="#offers">অফার</a>
      <a href="#products">পণ্য</a>
      <a href="#reviews">রিভিউ</a>
      <a href="#contact">যোগাযোগ</a>
    </div>
  </nav>

  <!-- ================= BANNER SLIDER ================= -->
  <section id="home" class='py-3 px-3'>

    <div id="bannerCarousel"
      class="carousel slide position-relative"
      data-bs-ride="carousel"
      data-bs-interval="2500">


      <div class="carousel-indicators">

        @foreach ($banners as $key => $banner)

        <button type="button"
          data-bs-target="#bannerCarousel"
          data-bs-slide-to="{{ $key }}"
          class="{{ $key == 0 ? 'active' : '' }}"
          aria-current="{{ $key == 0 ? 'true' : 'false' }}"
          aria-label="Slide {{ $key + 1 }}">
        </button>

        @endforeach

      </div>


      <div class="carousel-inner rounded-3">

        @foreach ($banners as $key => $banner)

        <div class="carousel-item img-bg {{ $key == 0 ? 'active' : '' }}"
          style="background-image: url('{{ asset($banner->image) }}')">

          <div class="container banner-inner">

            <h1 class="display-5 fw-bold" style="color:#D5B77A">
              {{ $banner->title }}
            </h1>

            <p class="lead" style="color:#F2E9DB">
              {{ $banner->subtitle }}
            </p>

            @if ($banner->button_text && $banner->button_link)
            <a href="{{ $banner->button_link }}"
              class="btn btn-lg btn-accent">
              {{ $banner->button_text }}
            </a>
            @endif

          </div>

        </div>

        @endforeach

      </div>
    </div>

  </section>
  <!-- ================= CATEGORIES =================
     Laravel: categories loop korbe -->
 <section id="categories" class="py-4">
  <div class="container">
    <h2 class="mb-4">ক্যাটাগরি অনুযায়ী কিনুন</h2>

    <div class="cat-wrap position-relative">
      <div class="cat-viewport" id="catViewport">
        <div class="cat-track" id="catTrack">
          @foreach ($categories as $category)
            <div class="cat-slide">
              <a href="?category={{ $category->slug }}#products" class="cat-item">
                <div class="cat-box">
                  <img src="{{ asset($category->image) }}" alt="{{ $category->title }}">
                </div>
                <div class="cat-name">{{ $category->title }}</div>
              </a>
            </div>
          @endforeach
        </div>
      </div>

      <button class="cat-nav cat-prev" type="button" id="catPrev" aria-label="Previous">
        <i class="bi bi-chevron-left"></i>
      </button>
      <button class="cat-nav cat-next" type="button" id="catNext" aria-label="Next">
        <i class="bi bi-chevron-right"></i>
      </button>
    </div>
  </div>
</section>
  <!-- ================= FEATURES ================= -->
  <section class="py-4 bg-white border-bottom border-sec">
    <div class="container">
      <div class="row g-3 text-center">
        <div class="col-6 col-md-3"><i class="bi bi-truck feature-icon"></i>
          <div class="fw-semibold">হোম ডেলিভারি</div><small class="text-secondary">দ্রুত ও নিরাপদ</small>
        </div>
        <div class="col-6 col-md-3"><i class="bi bi-patch-check feature-icon"></i>
          <div class="fw-semibold">খাঁটি মান</div><small class="text-secondary">১০০% অরিজিনাল</small>
        </div>
        <div class="col-6 col-md-3"><i class="bi bi-cash-coin feature-icon"></i>
          <div class="fw-semibold">ন্যায্য দাম</div><small class="text-secondary">বাজারের সেরা</small>
        </div>
        <div class="col-6 col-md-3"><i class="bi bi-arrow-repeat feature-icon"></i>
          <div class="fw-semibold">সহজ রিটার্ন</div><small class="text-secondary">সমস্যা হলে ফেরত</small>
        </div>
      </div>
    </div>
  </section>



  <!-- ================= PRODUCTS =================
     Laravel: products loop korbe — ekta card-ei sob, filter/sort/search controller-e -->
  <section id="products" class="py-5 bg-white border-top border-bottom border-sec">
    <div class="container">

      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <h2 class="mb-0">আমাদের পণ্য</h2>
        <!-- Sort (Laravel: hidden input-e category, q rakho) -->
        <form method="GET" action="#products">
          <select name="sort" class="form-select" style="max-width:220px" onchange="this.form.submit()">
            <option value="">সাজান: ডিফল্ট</option>
            <option value="low">দাম: কম → বেশি</option>
            <option value="high">দাম: বেশি → কম</option>
            <option value="name">নাম অনুযায়ী</option>
          </select>
        </form>
      </div>

      <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="index.html#products" class="btn btn-sm btn-outline-brand active">সব পণ্য</a>
        <a href="?category=oil#products" class="btn btn-sm btn-outline-brand">তেল</a>
        <a href="?category=soap#products" class="btn btn-sm btn-outline-brand">সাবান/ক্লিনিং</a>
        <a href="?category=grain#products" class="btn btn-sm btn-outline-brand">চাল-ডাল</a>
        <a href="?category=spice#products" class="btn btn-sm btn-outline-brand">মসলা</a>
        <a href="?category=snack#products" class="btn btn-sm btn-outline-brand">চা-নাস্তা</a>
        <a href="?category=daily#products" class="btn btn-sm btn-outline-brand">দৈনন্দিন</a>
      </div>

      <div class="row g-3">

        <!-- Product card: data-* gulo cart/wishlist JS porbe. Laravel-e shudhu value gulo variable theke bosbe -->
        <!-- Card 1 -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card-box h-100 p-0 position-relative overflow-hidden d-flex flex-row"
            data-product data-id="1" data-name="সয়াবিন তেল (১ লিটার)" data-price="175"
            data-img="https://placehold.co/400x400/F2E9DB/352638?text=Soybean+Oil">

            <div class="position-relative flex-shrink-0" style="width:42%; min-height:210px;">
              <span class="badge badge-off position-absolute top-0 start-0 m-2" style="z-index:2">5% ছাড়</span>
              <img src="https://placehold.co/400x400/F2E9DB/352638?text=Soybean+Oil" alt="সয়াবিন তেল"
                class="w-100 h-100" style="object-fit:cover;">
            </div>

            <div class="p-3 d-flex flex-column flex-grow-1 border-start">
              <div class="d-flex justify-content-between align-items-start mb-1">
                <small class="text-secondary">তেল</small>
                <button class="wish-btn js-wish position-static" aria-label="Wishlist"><i class="bi bi-heart"></i></button>
              </div>
              <h6 class="mb-1 text-dark fw-medium">সয়াবিন তেল (১ লিটার)</h6>
              <div class="small mb-2" style="color:#C9A86A">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                <span class="text-secondary ms-1">(৪.৫)</span>
              </div>
              <div class="mb-3">
                <span class="price fs-4">৳175</span>
                <del class="text-secondary small ms-1">৳185</del>
              </div>
              <div class="d-flex gap-2 mt-auto">
                <button class="btn btn-brand flex-fill js-add" title="কার্টে যোগ করুন">
                  <i class="bi bi-cart-plus"></i><span class="d-none d-sm-inline ms-1">কার্ট</span>
                </button>
                <button class="btn btn-accent flex-fill js-buy">
                  <i class="bi bi-lightning-charge-fill me-1"></i>এখনই কিনুন
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card-box h-100 p-0 position-relative overflow-hidden d-flex flex-row"
            data-product data-id="2" data-name="মসুর ডাল (১ কেজি)" data-price="120"
            data-img="https://placehold.co/400x400/E8DCC4/352638?text=Masoor+Dal">

            <div class="position-relative flex-shrink-0" style="width:42%; min-height:210px;">
              <span class="badge badge-off position-absolute top-0 start-0 m-2" style="z-index:2">8% ছাড়</span>
              <img src="https://placehold.co/400x400/E8DCC4/352638?text=Masoor+Dal" alt="মসুর ডাল"
                class="w-100 h-100" style="object-fit:cover;">
            </div>

            <div class="p-3 d-flex flex-column flex-grow-1 border-start">
              <div class="d-flex justify-content-between align-items-start mb-1">
                <small class="text-secondary">ডাল</small>
                <button class="wish-btn js-wish position-static" aria-label="Wishlist"><i class="bi bi-heart"></i></button>
              </div>
              <h6 class="mb-1 text-dark fw-medium">মসুর ডাল (১ কেজি)</h6>
              <div class="small mb-2" style="color:#C9A86A">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                <span class="text-secondary ms-1">(৪.০)</span>
              </div>
              <div class="mb-3">
                <span class="price fs-4">৳120</span>
                <del class="text-secondary small ms-1">৳130</del>
              </div>
              <div class="d-flex gap-2 mt-auto">
                <button class="btn btn-brand flex-fill js-add" title="কার্টে যোগ করুন">
                  <i class="bi bi-cart-plus"></i><span class="d-none d-sm-inline ms-1">কার্ট</span>
                </button>
                <button class="btn btn-accent flex-fill js-buy">
                  <i class="bi bi-lightning-charge-fill me-1"></i>এখনই কিনুন
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card-box h-100 p-0 position-relative overflow-hidden d-flex flex-row"
            data-product data-id="3" data-name="মিনিকেট চাল (৫ কেজি)" data-price="360"
            data-img="https://placehold.co/400x400/F2E9DB/6B7F5E?text=Rice+5kg">

            <div class="position-relative flex-shrink-0" style="width:42%; min-height:210px;">
              <span class="badge badge-off position-absolute top-0 start-0 m-2" style="z-index:2">3% ছাড়</span>
              <img src="https://placehold.co/400x400/F2E9DB/6B7F5E?text=Rice+5kg" alt="মিনিকেট চাল"
                class="w-100 h-100" style="object-fit:cover;">
            </div>

            <div class="p-3 d-flex flex-column flex-grow-1 border-start">
              <div class="d-flex justify-content-between align-items-start mb-1">
                <small class="text-secondary">চাল</small>
                <button class="wish-btn js-wish position-static" aria-label="Wishlist"><i class="bi bi-heart"></i></button>
              </div>
              <h6 class="mb-1 text-dark fw-medium">মিনিকেট চাল (৫ কেজি)</h6>
              <div class="small mb-2" style="color:#C9A86A">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                <span class="text-secondary ms-1">(৫.০)</span>
              </div>
              <div class="mb-3">
                <span class="price fs-4">৳360</span>
                <del class="text-secondary small ms-1">৳375</del>
              </div>
              <div class="d-flex gap-2 mt-auto">
                <button class="btn btn-brand flex-fill js-add" title="কার্টে যোগ করুন">
                  <i class="bi bi-cart-plus"></i><span class="d-none d-sm-inline ms-1">কার্ট</span>
                </button>
                <button class="btn btn-accent flex-fill js-buy">
                  <i class="bi bi-lightning-charge-fill me-1"></i>এখনই কিনুন
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card-box h-100 p-0 position-relative overflow-hidden d-flex flex-row"
            data-product data-id="4" data-name="লাক্স সাবান (৪ পিস)" data-price="140"
            data-img="https://placehold.co/400x400/E8DCC4/6B7F5E?text=Soap+Pack">

            <div class="position-relative flex-shrink-0" style="width:42%; min-height:210px;">
              <span class="badge badge-off position-absolute top-0 start-0 m-2" style="z-index:2">10% ছাড়</span>
              <img src="https://placehold.co/400x400/E8DCC4/6B7F5E?text=Soap+Pack" alt="লাক্স সাবান"
                class="w-100 h-100" style="object-fit:cover;">
            </div>

            <div class="p-3 d-flex flex-column flex-grow-1 border-start">
              <div class="d-flex justify-content-between align-items-start mb-1">
                <small class="text-secondary">সাবান</small>
                <button class="wish-btn js-wish position-static" aria-label="Wishlist"><i class="bi bi-heart"></i></button>
              </div>
              <h6 class="mb-1 text-dark fw-medium">লাক্স সাবান (৪ পিস)</h6>
              <div class="small mb-2" style="color:#C9A86A">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i><i class="bi bi-star"></i>
                <span class="text-secondary ms-1">(৩.৫)</span>
              </div>
              <div class="mb-3">
                <span class="price fs-4">৳140</span>
                <del class="text-secondary small ms-1">৳155</del>
              </div>
              <div class="d-flex gap-2 mt-auto">
                <button class="btn btn-brand flex-fill js-add" title="কার্টে যোগ করুন">
                  <i class="bi bi-cart-plus"></i><span class="d-none d-sm-inline ms-1">কার্ট</span>
                </button>
                <button class="btn btn-accent flex-fill js-buy">
                  <i class="bi bi-lightning-charge-fill me-1"></i>এখনই কিনুন
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- Laravel: product na thakle empty message dekhabe -->
    </div>
  </section>
  <!-- ================= SPECIAL OFFER / TODAY'S OFFER (image bg) =================
     Laravel: offers table (title, text, button, link, image, text color) -->
  <section id="offers" class="pb-5">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-6">
          <div class="offer-card img-bg" style="background-image:url('https://placehold.co/900x500/352638/F2E9DB?text=Special+Offer')">
            <small class="text-uppercase text-accent">বিশেষ অফার</small>
            <h3 style="color:#F2E9DB">তেলে ১০% পর্যন্ত ছাড়!</h3>
            <p style="color:#F2E9DB">সয়াবিন, সরিষা ও রাইস ব্রান তেলে বিশেষ অফার।</p>
            <div><a href="?category=oil#products" class="btn btn-accent">তেল দেখুন</a></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="offer-card img-bg" style="background-image:url('https://placehold.co/900x500/65705A/F2E9DB?text=Todays+Offer')">
            <small class="text-uppercase text-accent">আজকের অফার</small>
            <h3 style="color:#F2E9DB">সাবান কিনলে ২টায় ১টা ফ্রি*</h3>
            <p style="color:#F2E9DB">নির্বাচিত সাবান ও ডিটারজেন্টে আকর্ষণীয় ডিল।</p>
            <div><a href="?category=soap#products" class="btn btn-accent">সাবান দেখুন</a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================= REVIEWS (Laravel: reviews table) ================= -->
  <section id="reviews" class="py-5">
    <div class="container">
      <h2 class="text-center mb-4">গ্রাহকরা কী বলছেন</h2>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card-box p-4 h-100">
            <div class="stars mb-2">★★★★★</div>
            <p class="text-secondary">দাম ভালো, তেল একদম খাঁটি। প্রতি মাসের বাজার এখান থেকেই করি।</p>
            <div class="fw-semibold text-brand">— রহিম উদ্দিন</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box p-4 h-100">
            <div class="stars mb-2">★★★★★</div>
            <p class="text-secondary">হোম ডেলিভারি খুব দ্রুত পেয়েছি। পণ্যের মান সবসময় ঠিক থাকে।</p>
            <div class="fw-semibold text-brand">— ফাতেমা বেগম</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box p-4 h-100">
            <div class="stars mb-2">★★★★☆</div>
            <p class="text-secondary">সব মুদি জিনিস এক জায়গায় পাই, চাচার ব্যবহারও অনেক ভালো।</p>
            <div class="fw-semibold text-brand">— করিম হোসেন</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer id="contact" class="pt-5 pb-3" style="background:var(--text); color:var(--bg)">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h4 class="text-white"><span class="logo-mark me-2">C</span>Chashi</h4>
          <p style="color:var(--secondary)">আপনার প্রতিদিনের মুদি সামগ্রীর বিশ্বস্ত ঠিকানা। তেল, সাবান, চাল, ডাল, মসলা — সবই পাবেন এক দোকানে।</p>
        </div>
        <div class="col-md-4">
          <h5 class="text-accent">যোগাযোগ</h5>
          <ul class="list-unstyled" style="color:var(--secondary)">
            <li><i class="bi bi-geo-alt me-2"></i>বাজার রোড, আপনার শহর</li>
            <li><i class="bi bi-telephone me-2"></i>+880 1700-000000</li>
            <li><i class="bi bi-envelope me-2"></i>info@Chashi.com</li>
            <li><i class="bi bi-clock me-2"></i>প্রতিদিন সকাল ৭টা – রাত ১০টা</li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5 class="text-accent">দ্রুত লিংক</h5>
          <ul class="list-unstyled">
            <li><a class="text-decoration-none" style="color:var(--secondary)" href="#home">হোম</a></li>
            <li><a class="text-decoration-none" style="color:var(--secondary)" href="#categories">ক্যাটাগরি</a></li>
            <li><a class="text-decoration-none" style="color:var(--secondary)" href="#products">পণ্য</a></li>
            <li><a class="text-decoration-none" style="color:var(--secondary)" href="#reviews">রিভিউ</a></li>
          </ul>
        </div>
      </div>
      <hr style="border-color:var(--secondary)">
      <p class="text-center small mb-0" style="color:var(--secondary)">&copy; 2026 Chashi Grocery Shop. সর্বস্বত্ব সংরক্ষিত।</p>
    </div>
  </footer>

  <!-- ================= WISHLIST DRAWER ================= -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="wishCanvas" style="background:var(--bg)">
    <div class="offcanvas-header bg-brand">
      <h5 class="offcanvas-title text-white">আমার উইশলিস্ট</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <div id="wishItems" data-empty="উইশলিস্ট খালি আছে।"></div>
    </div>
  </div>

  <!-- ================= CART DRAWER ================= -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartCanvas" style="background:var(--bg)">
    <div class="offcanvas-header bg-brand">
      <h5 class="offcanvas-title text-white">আপনার কার্ট</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <div id="cartItems" class="flex-grow-1" data-empty="কার্ট খালি আছে।"></div>
      <div class="border-top border-sec pt-3">
        <div class="d-flex justify-content-between fw-bold fs-5 mb-3"><span>মোট</span><span id="cartTotal" class="price">৳0</span></div>
        <!-- Laravel: data-whatsapp settings theke ashbe -->
        <button id="orderBtn" class="btn btn-brand w-100"
          data-whatsapp="8801700000000"
          data-hello="আসসালামু আলাইকুম, আমি অর্ডার করতে চাই:"
          data-total="মোট"
          data-alert="আগে কার্টে পণ্য যোগ করুন।">
          <i class="bi bi-whatsapp me-1"></i> WhatsApp এ অর্ডার করুন
        </button>
        <button id="clearBtn" class="btn btn-outline-brand w-100 mt-2">কার্ট খালি করুন</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* JS shudhu cart + wishlist. Product data page-er data-* attribute theke ashe, tai Laravel-e kono change lagbe na. */
    const CURRENCY = "৳";
    const $ = (s) => document.querySelector(s);
    const load = (k) => JSON.parse(localStorage.getItem(k) || "{}");
    const store = (k, v) => localStorage.setItem(k, JSON.stringify(v));
    const money = (n) => CURRENCY + Number(n).toLocaleString("en-US");
    const esc = (s) => String(s ?? "").replace(/[&<>"']/g, (c) => ({
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#39;"
    } [c]));

    let cart = load("ChashiCart"); // { id: {id, name, price, img, qty} }
    let wish = load("ChashiWish"); // { id: {id, name, price, img} }

    const productOf = (card) => ({
      id: card.dataset.id,
      name: card.dataset.name,
      price: +card.dataset.price,
      img: card.dataset.img
    });

    // ---------- Cart ----------
    function addToCart(p) {
      cart[p.id] = cart[p.id] ? {
        ...cart[p.id],
        qty: cart[p.id].qty + 1
      } : {
        ...p,
        qty: 1
      };
      store("ChashiCart", cart);
      renderCart();
    }

    function changeQty(id, d) {
      if (!cart[id]) return;
      cart[id].qty += d;
      if (cart[id].qty <= 0) delete cart[id];
      store("ChashiCart", cart);
      renderCart();
    }

    function renderCart() {
      const list = Object.values(cart);
      const box = $("#cartItems");
      box.innerHTML = list.length ? list.map(i => `
      <div class="d-flex align-items-center gap-2 border-bottom border-sec py-2">
        <img class="thumb-sm" src="${esc(i.img)}" alt="">
        <div class="flex-grow-1">
          <div class="small fw-semibold">${esc(i.name)}</div>
          <div class="small text-secondary">${money(i.price)} × ${i.qty} = ${money(i.price * i.qty)}</div>
        </div>
        <div class="btn-group btn-group-sm">
          <button class="btn btn-outline-brand" data-act="dec" data-id="${i.id}">−</button>
          <button class="btn btn-outline-brand disabled">${i.qty}</button>
          <button class="btn btn-outline-brand" data-act="inc" data-id="${i.id}">+</button>
        </div>
      </div>`).join("") : `<p class="text-secondary text-center mt-4">${esc(box.dataset.empty)}</p>`;
      $("#cartTotal").textContent = money(list.reduce((s, i) => s + i.price * i.qty, 0));
      $("#cartCount").textContent = list.reduce((s, i) => s + i.qty, 0);
    }

    // ---------- Wishlist ----------
    function toggleWish(p) {
      if (wish[p.id]) delete wish[p.id];
      else wish[p.id] = p;
      store("ChashiWish", wish);
      renderWish();
    }

    function renderWish() {
      const list = Object.values(wish);
      const box = $("#wishItems");
      box.innerHTML = list.length ? list.map(i => `
      <div class="d-flex align-items-center gap-2 border-bottom border-sec py-2">
        <img class="thumb-sm" src="${esc(i.img)}" alt="">
        <div class="flex-grow-1">
          <div class="small fw-semibold">${esc(i.name)}</div>
          <div class="small price">${money(i.price)}</div>
        </div>
        <button class="btn btn-sm btn-brand" data-act="wish-add" data-id="${i.id}"><i class="bi bi-cart-plus"></i></button>
        <button class="btn btn-sm btn-outline-brand" data-act="wish-del" data-id="${i.id}"><i class="bi bi-trash"></i></button>
      </div>`).join("") : `<p class="text-secondary text-center mt-4">${esc(box.dataset.empty)}</p>`;
      $("#wishCount").textContent = list.length;
      // heart icon sync on product cards
      document.querySelectorAll("[data-product]").forEach(card => {
        const icon = card.querySelector(".js-wish i");
        if (icon) icon.className = "bi " + (wish[card.dataset.id] ? "bi-heart-fill" : "bi-heart");
      });
    }

    // ---------- Click handling ----------
    document.addEventListener("click", (e) => {
      const card = e.target.closest("[data-product]");
      if (card && e.target.closest(".js-add")) addToCart(productOf(card));
      if (card && e.target.closest(".js-wish")) toggleWish(productOf(card));

      const btn = e.target.closest("[data-act]");
      if (!btn) return;
      const id = btn.dataset.id;
      if (btn.dataset.act === "inc") changeQty(id, 1);
      if (btn.dataset.act === "dec") changeQty(id, -1);
      if (btn.dataset.act === "wish-add") addToCart(wish[id]);
      if (btn.dataset.act === "wish-del") toggleWish(wish[id]);
    });

    $("#clearBtn").addEventListener("click", () => {
      cart = {};
      store("ChashiCart", cart);
      renderCart();
    });

    // ---------- WhatsApp order ----------
    $("#orderBtn").addEventListener("click", (e) => {
      const d = e.currentTarget.dataset;
      const list = Object.values(cart);
      if (!list.length) {
        alert(d.alert);
        return;
      }
      let total = 0;
      let msg = d.hello + "\n\n";
      list.forEach(i => {
        msg += `• ${i.name} × ${i.qty} = ${money(i.price * i.qty)}\n`;
        total += i.price * i.qty;
      });
      msg += `\n${d.total}: ${money(total)}`;
      window.open(`https://wa.me/${d.whatsapp}?text=${encodeURIComponent(msg)}`, "_blank");
    });

    renderCart();
    renderWish();
  document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('catTrack');
    const viewport = document.getElementById('catViewport');
    const prevBtn = document.getElementById('catPrev');
    const nextBtn = document.getElementById('catNext');
    if (!track) return;

    const originals = Array.from(track.children);
    const total = originals.length;
    const INTERVAL = 2000;
    const SPEED = 500;

    function perView() {
        const w = window.innerWidth;
        if (w <= 575) return 3;
        if (w <= 991) return 4;
        return 5;
    }

    // Slide kom hole slider-er dorkar nai
    if (total <= perView()) {
        prevBtn.style.display = nextBtn.style.display = 'none';
        return;
    }

    // Shuru-te ar shesh-e clone, jate dui dik theke seamless loop hoy
    const CLONES = 6; // max perView (5) er cheye beshi
    const n = Math.min(CLONES, total);
    for (let i = 0; i < n; i++) {
        track.appendChild(originals[i].cloneNode(true));
        track.insertBefore(originals[total - 1 - i].cloneNode(true), track.firstChild);
    }

    let index = n;           // clone-er por real 1st item
    let busy = false;
    let timer;

    function slideW() {
        return track.children[0].getBoundingClientRect().width;
    }

    function setPos(animate) {
        track.style.transition = animate ? 'transform ' + SPEED + 'ms ease' : 'none';
        track.style.transform = 'translateX(' + (-index * slideW()) + 'px)';
    }

    function go(dir) {
        if (busy) return;
        busy = true;
        index += dir;
        setPos(true);
    }

    track.addEventListener('transitionend', function () {
        // Clone-e pouchhe gele chupchap real item-e jump
        if (index >= n + total) index = n;
        if (index < n) index = n + total - 1;
        setPos(false);
        busy = false;
    });

    function start() { stop(); timer = setInterval(function () { go(1); }, INTERVAL); }
    function stop()  { clearInterval(timer); }

    nextBtn.addEventListener('click', function () { go(1); start(); });
    prevBtn.addEventListener('click', function () { go(-1); start(); });

    viewport.addEventListener('mouseenter', stop);
    viewport.addEventListener('mouseleave', start);
    window.addEventListener('resize', function () { setPos(false); });

    setPos(false);
    start();
});
  </script>
</body>

</html>