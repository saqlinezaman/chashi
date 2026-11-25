@extends('dashboard.dashboardMaster')

@section('title', 'ব্যানার')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 reveal">
    <div>
        <h1 class="h3 mb-1">ব্যানার ব্যবস্থাপনা</h1>
        <p class="text-secondary mb-0">হোমপেজের স্লাইডার ব্যানার এখানে পরিচালনা করুন।</p>
    </div>
    <button type="button" class="btn btn-accent" data-bs-toggle="modal" data-bs-target="#addModal"><i class="bi bi-plus-lg me-1"></i>নতুন ব্যানার যোগ করুন</button>
</div>

<div class="card-box reveal">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 border-bottom">
        <h2 class="h5 mb-0">ব্যানারের তালিকা</h2>
        <form method="GET" class="d-flex gap-2">
            <input type="search" name="q" class="form-control" style="max-width:240px" placeholder="ব্যানার খুঁজুন..." value="{{ request('q') }}">
            <button class="btn btn-brand" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ছবি</th>
                    <th>শিরোনাম</th>
                    <th>বাটন</th>
                    <th>স্ট্যাটাস</th>
                    <th class="text-end">অ্যাকশন</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($banners as $banner)
                <tr>

                    <td><img class="thumb" src="{{ $banner->image }}" alt="{{ $banner->title }}"></td>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->button_text }}</td>
                    <td>
                        <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $banner->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                        </span>
                    </td>
                    <td class="text-end text-nowrap">
                        <button class="btn btn-sm btn-outline-brand" title="দেখুন" data-bs-toggle="modal" data-bs-target="#viewModal" data-title="{{ $banner->title }}" data-subtitle="{{ $banner->subtitle }}" data-button="{{ $banner->button_text }}" data-link="{{ $banner->button_link }}" data-order="{{ $banner->order }}" data-status="{{ $banner->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}" data-image="{{ $banner->image }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-brand" title="এডিট" data-bs-toggle="modal" data-bs-target="#editModal{{ $banner->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-brand" title="ডিলিট" data-bs-toggle="modal" data-bs-target="#delModal{{ $banner->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class=" justify-content-end py-2">
    {{ $banners->links() }}
</div>




{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <form id="bannerForm"
            class="modal-content"
            method="POST"
            action="{{ route('banner.store') }}"
            enctype="multipart/form-data">

            @csrf

            <div class="modal-header">
                <h5 class="modal-title">নতুন ব্যানার যোগ করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <h6 class="fw-bold mb-3">ব্যানারের তথ্য</h6>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label class="form-label">শিরোনাম *</label>
                        <input type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title') }}"
                            placeholder="যেমন: তেলে ১০% পর্যন্ত ছাড়!">
                    </div>

                    <div class="col-12">
                        <label class="form-label">উপশিরোনাম</label>
                        <textarea name="subtitle"
                            class="form-control"
                            rows="2"
                            placeholder="সংক্ষিপ্ত বিবরণ লিখুন">{{ old('subtitle') }}</textarea>
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold mb-3">বাটন সেটিংস</h6>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">বাটনের লেখা</label>
                        <input type="text"
                            name="button_text"
                            class="form-control"
                            value="{{ old('button_text') }}"
                            placeholder="যেমন: তেল দেখুন">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">বাটনের লিংক</label>
                        <input type="text"
                            name="button_link"
                            class="form-control"
                            value="{{ old('button_link') }}"
                            placeholder="যেমন: /category/oil">
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold mb-3">ব্যানারের ছবি</h6>

                <div class="mb-3">
                    <input type="file"
                        name="image"
                        class="form-control"
                        accept="image/*">

                    <div class="text-danger small image-error"></div>

                    <div class="form-text">
                        প্রস্তাবিত সাইজ: 1920 × 600 px
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold mb-3">অতিরিক্ত সেটিংস</h6>

                <div class="row g-3">
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check">
                            <input type="checkbox"
                                name="is_active"
                                value="1"
                                class="form-check-input"
                                id="isActive"
                                checked>

                            <label class="form-check-label" for="isActive">
                                Active Status
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-brand"
                    data-bs-dismiss="modal">
                    বাতিল
                </button>

                <button type="submit" class="btn btn-brand">
                    সংরক্ষণ করুন
                </button>
            </div>

        </form>
    </div>
</div>

{{-- View Modal --}}
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ব্যানারের বিবরণ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="viewImage" src="https://placehold.co/300x120" alt="" class="rounded" style="width:100%;max-height:140px;object-fit:cover">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">শিরোনাম</span><b id="viewTitle"></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">উপশিরোনাম</span><span id="viewSubtitle" class="text-end"></span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">বাটন</span><b id="viewButton"></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">লিংক</span><span id="viewLink"></span></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">ক্রম</span><b id="viewOrder"></b></li>
                    <li class="list-group-item d-flex justify-content-between"><span class="text-secondary">স্ট্যাটাস</span><span class="badge bg-success" id="viewStatus"></span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-brand" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>


{{-- Edit Modal --}}
@foreach ($banners as $banner)
<div id="editModal{{ $banner->id }}" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="POST" action="{{ route('banner.update', $banner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">ব্যানার এডিট করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">শিরোনাম</label>
                    <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">উপশিরোনাম</label>
                    <textarea name="subtitle" class="form-control" rows="2">{{ $banner->subtitle }}</textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label">বাটনের লেখা</label>
                        <input type="text" name="button_text" class="form-control" value="{{ $banner->button_text }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label">বাটনের লিংক</label>
                        <input type="text" name="button_link" class="form-control" value="{{ $banner->button_link }}">
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label">স্ট্যাটাস</label>
                        <select name="is_active" class="form-select" required>
                            <option value="1" {{ $banner->is_active ? 'selected' : '' }}>সক্রিয়</option>
                            <option value="0" {{ !$banner->is_active ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="form-label">ছবি</label>
                    <div class="mb-2">
                        <img src="{{ $banner->image }}" alt="" class="rounded" style="width:120px;height:60px;object-fit:cover">
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
@endforeach

{{-- Delete Modal --}}
@foreach ($banners as $banner)
<div class="modal fade" id="delModal{{ $banner->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <form class="modal-content text-center p-3" method="POST" action="{{ route('banner.destroy', $banner->id) }}">
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
@endforeach

<script>
    document.addEventListener('show.bs.modal', function(e) {
        var btn = e.relatedTarget;
        if (!btn) return;

        if (e.target.id === 'viewModal') {
            document.getElementById('viewTitle').textContent = btn.dataset.title;
            document.getElementById('viewSubtitle').textContent = btn.dataset.subtitle;
            document.getElementById('viewButton').textContent = btn.dataset.button;
            document.getElementById('viewLink').textContent = btn.dataset.link;
            document.getElementById('viewOrder').textContent = btn.dataset.order;
            var st = document.getElementById('viewStatus');
            st.textContent = btn.dataset.status;
            st.className = 'badge ' + (btn.dataset.status === 'সক্রিয়' ? 'bg-success' : 'bg-danger');
            document.getElementById('viewImage').src = btn.dataset.image;
        }
    });
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('bannerForm');
        const imageInput = form.querySelector('input[name="image"]');
        const imageError = form.querySelector('.image-error');

        form.addEventListener('submit', function(e) {

            imageError.textContent = '';
            imageInput.classList.remove('is-invalid');

            if (!imageInput.files.length) {

                e.preventDefault();
                e.stopPropagation();

                imageError.textContent = 'অনুগ্রহ করে ব্যানারের ছবি নির্বাচন করুন।';
                imageInput.classList.add('is-invalid');

            }

        });

        imageInput.addEventListener('change', function() {

            imageError.textContent = '';
            imageInput.classList.remove('is-invalid');

        });

    });
</script>

@endsection