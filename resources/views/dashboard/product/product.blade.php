@extends('dashboard.dashboardMaster')

@section('title', 'পণ্য')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 reveal">
    <div>
        <h1 class="h3 mb-1">পণ্য ব্যবস্থাপনা</h1>
        <p class="text-secondary mb-0">আপনার সকল পণ্য এখানে পরিচালনা করুন।</p>
    </div>
    <button type="button" class="btn btn-accent" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg me-1"></i>নতুন পণ্য যোগ করুন</button>
</div>

<div class="card-box reveal">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 border-bottom">
        <h2 class="h5 mb-0">পণ্যের তালিকা</h2>
        <form method="GET" class="d-flex gap-2">
            <input type="search" name="q" class="form-control" style="max-width:240px" placeholder="পণ্য খুঁজুন..." value="{{ request('q') }}">
            <button class="btn btn-brand" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ছবি</th>
                    <th>নাম</th>
                    <th>ক্যাটাগরি</th>
                    <th>দাম</th>
                    <th>স্টক</th>
                    <th class="text-end">অ্যাকশন</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><img class="thumb" src="https://placehold.co/60x60" alt="চাল"></td>
                    <td>চাল</td>
                    <td>খাদ্য পণ্য</td>
                    <td><b>৳ ৭০</b></td>
                    <td><span class="badge bg-success">৫০</span></td>
                    <td class="text-end text-nowrap">
                        <button class="btn btn-sm btn-outline-brand" title="দেখুন" data-bs-toggle="modal" data-bs-target="#viewModal" data-name="চাল" data-category="খাদ্য পণ্য" data-price="৭০" data-stock="৫০" data-image="https://placehold.co/60x60"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="এডিট" data-bs-toggle="modal" data-bs-target="#editModal" data-name="চাল" data-category="খাদ্য পণ্য" data-price="70" data-stock="50" data-image="https://placehold.co/60x60"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="ডিলিট" data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><img class="thumb" src="https://placehold.co/60x60" alt="সরিষার তেল"></td>
                    <td>সরিষার তেল</td>
                    <td>তেল</td>
                    <td><b>৳ ১৮০</b></td>
                    <td><span class="badge bg-success">৩০</span></td>
                    <td class="text-end text-nowrap">
                        <button class="btn btn-sm btn-outline-brand" title="দেখুন" data-bs-toggle="modal" data-bs-target="#viewModal" data-name="সরিষার তেল" data-category="তেল" data-price="১৮০" data-stock="৩০" data-image="https://placehold.co/60x60"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="এডিট" data-bs-toggle="modal" data-bs-target="#editModal" data-name="সরিষার তেল" data-category="তেল" data-price="180" data-stock="30" data-image="https://placehold.co/60x60"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="ডিলিট" data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><img class="thumb" src="https://placehold.co/60x60" alt="মসুর ডাল"></td>
                    <td>মসুর ডাল</td>
                    <td>ডাল</td>
                    <td><b>৳ ১২০</b></td>
                    <td><span class="badge bg-success">৪০</span></td>
                    <td class="text-end text-nowrap">
                        <button class="btn btn-sm btn-outline-brand" title="দেখুন" data-bs-toggle="modal" data-bs-target="#viewModal" data-name="মসুর ডাল" data-category="ডাল" data-price="১২০" data-stock="৪০" data-image="https://placehold.co/60x60"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="এডিট" data-bs-toggle="modal" data-bs-target="#editModal" data-name="মসুর ডাল" data-category="ডাল" data-price="120" data-stock="40" data-image="https://placehold.co/60x60"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-sm btn-outline-brand" title="ডিলিট" data-bs-toggle="modal" data-bs-target="#delModal"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content" method="POST" action="#" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">নতুন পণ্য যোগ করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Basic Information --}}
                <h6 class="fw-bold mb-3">পণ্যের তথ্য</h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">পণ্যের নাম *</label>
                        <input type="text" name="name" class="form-control"
                            placeholder="যেমন: চাল" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">SKU / Product Code</label>
                        <input type="text" name="sku" class="form-control"
                            placeholder="যেমন: CHS-001">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">ক্যাটাগরি *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">ক্যাটাগরি নির্বাচন করুন</option>
                            <option value="1">খাদ্য পণ্য</option>
                            <option value="2">সবজি</option>
                            <option value="3">ফলমূল</option>
                            <option value="4">দুগ্ধজাত পণ্য</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">ব্র্যান্ড</label>
                        <input type="text" name="brand" class="form-control"
                            placeholder="যেমন: PRAN">
                    </div>

                    <div class="col-12">
                        <label class="form-label">পণ্যের বিবরণ</label>
                        <textarea name="description" class="form-control"
                            rows="2" placeholder="পণ্যের বিবরণ লিখুন"></textarea>
                    </div>
                </div>

                <hr>

                {{-- Product Variant --}}
                <h6 class="fw-bold mb-3">পণ্যের সাইজ / পরিমাণ</h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">পরিমাণ / Size</label>
                        <input type="number" name="unit_value"
                            class="form-control" min="0.01" step="0.01"
                            placeholder="যেমন: 1, 2, 500">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Unit</label>
                        <select name="unit_type" class="form-select">
                            <option value="">Unit নির্বাচন করুন</option>
                            <option value="gram">Gram (g)</option>
                            <option value="kg">Kilogram (kg)</option>
                            <option value="ml">Milliliter (ml)</option>
                            <option value="liter">Liter (L)</option>
                            <option value="piece">Piece (pcs)</option>
                            <option value="pack">Pack</option>
                            <option value="bottle">Bottle</option>
                            <option value="box">Box</option>
                        </select>
                    </div>
                </div>

                {{-- Pricing --}}
                <hr>

                <h6 class="fw-bold mb-3">পণ্যের মূল্য</h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">ক্রয় মূল্য (৳) *</label>
                        <input type="number" name="purchase_price"
                            class="form-control" min="0" step="0.01" required
                            placeholder="0.00">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">বিক্রয় মূল্য (৳) *</label>
                        <input type="number" name="selling_price"
                            class="form-control" min="0" step="0.01" required
                            placeholder="0.00">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Discount Type</label>
                        <select name="discount_type" class="form-select">
                            <option value="">Discount নেই</option>
                            <option value="fixed">Fixed Amount (৳)</option>
                            <option value="percentage">Percentage (%)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Discount Value</label>
                        <input type="number" name="discount_value"
                            class="form-control" min="0" step="0.01"
                            placeholder="0">
                    </div>
                </div>

                {{-- Inventory --}}
                <hr>

                <h6 class="fw-bold mb-3">স্টক ম্যানেজমেন্ট</h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">স্টক পরিমাণ *</label>
                        <input type="number" name="stock"
                            class="form-control" min="0" required
                            placeholder="যেমন: 100">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Low Stock Alert</label>
                        <input type="number" name="low_stock_alert"
                            class="form-control" min="0" value="5">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Expiry Date</label>
                        <input type="date" name="expiry_date"
                            class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Barcode</label>
                        <input type="text" name="barcode"
                            class="form-control" placeholder="Barcode Number">
                    </div>
                </div>

                {{-- Product Image --}}
                <hr>

                <h6 class="fw-bold mb-3">পণ্যের ছবি</h6>

                <div class="mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" name="image" class="form-control"
                        accept="image/*">
                </div>

                {{-- Additional Settings --}}
                <hr>

                <h6 class="fw-bold mb-3">অতিরিক্ত সেটিংস</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" name="is_featured"
                                value="1" class="form-check-input"
                                id="isFeatured">
                            <label class="form-check-label" for="isFeatured">
                                Featured Product
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" name="is_active"
                                value="1" class="form-check-input"
                                id="isActive" checked>
                            <label class="form-check-label" for="isActive">
                                Active Status
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand"
                    data-bs-dismiss="modal">বাতিল</button>

                <button type="submit" class="btn btn-brand">
                    সংরক্ষণ করুন
                </button>
            </div>

        </form>
    </div>
</div>


<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">পণ্যের বিবরণ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="viewImage" src="https://placehold.co/120x120" alt="" class="rounded" style="width:120px;height:120px;object-fit:cover">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">নাম</span><b id="viewName"></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">ক্যাটাগরি</span><b id="viewCategory"></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">দাম</span><b>৳ <span id="viewPrice"></span></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">স্টক</span><span class="badge bg-success" id="viewStock"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="#" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">পণ্য এডিট করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">পণ্যের নাম</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ক্যাটাগরি</label>
                    <input type="text" name="category" id="editCategory" class="form-control" required>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label">দাম (৳)</label>
                        <input type="number" name="price" id="editPrice" class="form-control" min="0" step="0.01" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">স্টক</label>
                        <input type="number" name="stock" id="editStock" class="form-control" min="0" required>
                    </div>
                </div>
                <div>
                    <label class="form-label">ছবি</label>
                    <div class="mb-2">
                        <img id="editImage" src="https://placehold.co/60x60" alt="" class="rounded" style="width:60px;height:60px;object-fit:cover">
                    </div>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-bs-dismiss="modal">বাতিল</button>
                <button type="submit" class="btn btn-brand">আপডেট করুন</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="delModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content text-center p-3" method="POST" action="#">
            @csrf
            @method('DELETE')
            <i class="bi bi-trash fs-1 text-danger"></i>
            <p class="my-2">সত্যিই মুছে ফেলতে চান?</p>
            <div class="d-flex gap-2 justify-content-center">
                <button type="button" class="btn btn-outline-brand" data-bs-dismiss="modal">না</button>
                <button type="submit" class="btn btn-brand">হ্যাঁ, মুছুন</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('show.bs.modal', function (e) {
    var btn = e.relatedTarget;
    if (!btn) return;

    if (e.target.id === 'viewModal') {
        document.getElementById('viewName').textContent = btn.dataset.name;
        document.getElementById('viewCategory').textContent = btn.dataset.category;
        document.getElementById('viewPrice').textContent = btn.dataset.price;
        document.getElementById('viewStock').textContent = btn.dataset.stock;
        document.getElementById('viewImage').src = btn.dataset.image;
    }

    if (e.target.id === 'editModal') {
        document.getElementById('editName').value = btn.dataset.name;
        document.getElementById('editCategory').value = btn.dataset.category;
        document.getElementById('editPrice').value = btn.dataset.price;
        document.getElementById('editStock').value = btn.dataset.stock;
        document.getElementById('editImage').src = btn.dataset.image;
    }
});
</script>

@endsection