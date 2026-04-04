<x-admin-layout>

<div style="margin-bottom:24px;" class="anim-fade-up">
    <div class="ss-section-label">Catalog</div>
    <h1 class="ss-page-title">Update Book</h1>
    <p class="ss-page-subtitle">Editing: <strong style="color:var(--ss-cyan);">{{ $book->name }}</strong></p>
</div>

<div class="ss-card anim-fade-up-1" style="padding:36px;max-width:900px;">
    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label>Book Title <span style="color:var(--ss-rose);">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $book->name) }}" required
                                class="ss-input" placeholder="Book title">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" class="ss-input">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Author</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}"
                        class="ss-input" placeholder="e.g. Robert C. Martin">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Price (BDT) <span style="color:var(--ss-rose);">*</span></label>
                            <input type="number" name="price" value="{{ old('price', $book->price) }}" step="0.01" required
                                class="ss-input">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Quantity <span style="color:var(--ss-rose);">*</span></label>
                            <input type="number" name="quantity" value="{{ old('quantity', $book->quantity) }}" required min="0"
                                class="ss-input">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Weight (g)</label>
                            <input type="number" name="weight" value="{{ old('weight', $book->weight) }}"
                                class="ss-input">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="4" class="ss-input"
                        placeholder="Brief summary…">{{ old('description', $book->description) }}</textarea>
                </div>
            </div>

            <div class="col-md-5">
                <div class="mb-3">
                    <label>Update Cover Image</label>
                    <div id="dropZone" style="border:2px dashed var(--ss-border-strong);border-radius:14px;padding:16px;text-align:center;cursor:pointer;transition:border-color 0.2s;" onclick="document.getElementById('imageInput').click()">
                        <img id="imgPreview" src="{{ $book->image ? asset('products/'.$book->image) : '' }}" alt="Cover"
                            style="{{ $book->image ? 'display:block' : 'display:none' }};max-width:100%;max-height:200px;border-radius:10px;margin:0 auto 10px;object-fit:cover;">
                        <div id="dropPlaceholder" style="{{ $book->image ? 'display:none' : 'display:block' }}">
                            <i class="fas fa-sync-alt" style="font-size:2rem;color:var(--ss-text-3);margin-bottom:10px;display:block;"></i>
                            <p style="color:var(--ss-text-2);font-size:0.82rem;margin:0;">Click to replace cover image</p>
                        </div>
                        @if($book->image)
                        <p style="font-size:0.72rem;color:var(--ss-text-3);margin-top:8px;">Click to change image</p>
                        @endif
                        <input type="file" id="imageInput" name="productImage" accept="image/*" style="display:none;" onchange="previewImage(event)">
                    </div>
                </div>
            </div>
        </div>

        <hr style="border-color:var(--ss-border);margin:24px 0;">

        <div style="display:flex;gap:12px;">
            <button type="submit" class="ss-btn ss-btn-primary ss-btn-lg">
                <i class="fas fa-save"></i> Save Changes
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