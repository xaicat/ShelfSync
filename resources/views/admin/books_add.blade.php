<x-admin-layout>

<div style="margin-bottom:24px;" class="anim-fade-up">
    <div class="ss-section-label">Catalog</div>
    <h1 class="ss-page-title">Add New Book</h1>
    <p class="ss-page-subtitle">Add a new book to the library catalog</p>
</div>

<div class="ss-card anim-fade-up-1" style="padding:36px;max-width:900px;">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Book Title <span style="color:var(--ss-rose);">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="ss-input" placeholder="e.g. Clean Code">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Category <span style="color:var(--ss-rose);">*</span></label>
                            <select name="category_id" required class="ss-input">
                                <option value="" disabled selected>Choose…</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text" name="author" value="{{ old('author') }}"
                        class="ss-input" placeholder="e.g. Robert C. Martin">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Price (BDT) <span style="color:var(--ss-rose);">*</span></label>
                            <input type="number" name="price" value="{{ old('price') }}" step="0.01" required
                                class="ss-input" placeholder="0.00">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Quantity <span style="color:var(--ss-rose);">*</span></label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}" required min="0"
                                class="ss-input" placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Weight (g)</label>
                            <input type="number" name="weight" value="{{ old('weight') }}"
                                class="ss-input" placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="ss-input"
                        placeholder="A brief summary of the book…">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Right Column — Image -->
            <div class="col-md-5">
                <div class="mb-3">
                    <label>Book Cover Image</label>
                    <div id="dropZone" style="border:2px dashed var(--ss-border-strong);border-radius:14px;padding:20px;text-align:center;cursor:pointer;transition:border-color 0.2s;" onclick="document.getElementById('imageInput').click()">
                        <img id="imgPreview" src="" alt=""
                            style="display:none;max-width:100%;max-height:220px;border-radius:10px;margin:0 auto 12px;object-fit:cover;">
                        <div id="dropPlaceholder">
                            <i class="fas fa-cloud-upload-alt" style="font-size:2.5rem;color:var(--ss-text-3);margin-bottom:12px;display:block;"></i>
                            <p style="color:var(--ss-text-2);font-size:0.85rem;margin:0;">Click to upload cover image</p>
                            <p style="color:var(--ss-text-3);font-size:0.75rem;margin-top:4px;">PNG, JPG, GIF up to 2MB</p>
                        </div>
                        <input type="file" id="imageInput" name="image" accept="image/*" style="display:none;" onchange="previewImage(event)">
                    </div>
                </div>
            </div>
        </div>

        <hr style="border-color:var(--ss-border);margin:24px 0;">

        <div style="display:flex;gap:12px;align-items:center;">
            <button type="submit" class="ss-btn ss-btn-primary ss-btn-lg">
                <i class="fas fa-plus-circle"></i> Add Book
            </button>
            <a href="{{ route('admin.books') }}" class="ss-btn ss-btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<script>
function previewImage(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        const img = document.getElementById('imgPreview');
        img.src = ev.target.result;
        img.style.display = 'block';
        document.getElementById('dropPlaceholder').style.display = 'none';
        document.getElementById('dropZone').style.borderColor = 'var(--ss-cyan)';
    };
    reader.readAsDataURL(file);
}
</script>
</x-admin-layout>