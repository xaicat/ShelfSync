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

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="ss-card" style="padding:18px;background:rgba(0,212,255,0.03);border:1px solid rgba(0,212,255,0.25);">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                        <i class="fas fa-wand-magic-sparkles" style="color:var(--ss-cyan);"></i>
                        <h4 style="font-size:0.95rem;margin:0;color:var(--ss-cyan);font-weight:700;">Magic Book Fetcher</h4>
                    </div>
                    <div style="display:flex;gap:12px;align-items:center;">
                        <input type="text" id="isbnInput" class="ss-input" placeholder="Enter ISBN (e.g. 0451524934)" style="flex:1;">
                        <button type="button" id="fetchBtn" onclick="fetchISBN()" class="ss-btn ss-btn-primary" style="white-space:nowrap;">
                            Fetch Metadata
                        </button>
                    </div>
                    <p style="font-size:0.75rem;color:var(--ss-text-3);margin:8px 0 0;">Auto-fills Title, Author, Category, and Cover Image from OpenLibrary</p>
                </div>
            </div>
        </div>

        <input type="hidden" name="new_category" id="newCategoryInput">

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
                            <label>Category</label>
                            <select name="category_id" id="categorySelect" class="ss-input">
                                <option value="" selected>Choose… (or auto-fetch)</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="newCatText" style="color:var(--ss-electric);font-size:0.75rem;display:none;"></small>
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
                    <label>Book Cover URL</label>
                    <input type="url" name="cover_url" id="coverUrlInput" class="ss-input" placeholder="https://..." oninput="updatePreview(this.value)" style="margin-bottom:12px;">
                    
                    <div id="dropZone" style="border:2px dashed var(--ss-border-strong);border-radius:14px;padding:20px;text-align:center;transition:border-color 0.2s;">
                        <img id="imgPreview" src="" alt=""
                            style="display:none;max-width:100%;max-height:220px;border-radius:10px;margin:0 auto;object-fit:cover;">
                        <div id="dropPlaceholder">
                            <i class="fas fa-image" style="font-size:2.5rem;color:var(--ss-text-3);margin-bottom:12px;display:block;"></i>
                            <p style="color:var(--ss-text-2);font-size:0.85rem;margin:0;">Cover Preview</p>
                        </div>
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
function updatePreview(url) {
    const img = document.getElementById('imgPreview');
    const ph = document.getElementById('dropPlaceholder');
    const zone = document.getElementById('dropZone');
    
    if (url) {
        img.src = url;
        img.style.display = 'block';
        ph.style.display = 'none';
        zone.style.borderColor = 'var(--ss-cyan)';
    } else {
        img.style.display = 'none';
        ph.style.display = 'block';
        zone.style.borderColor = 'var(--ss-border-strong)';
    }
}


async function fetchISBN() {
    const isbnInput = document.getElementById('isbnInput');
    // 1. Multi-Format Support: Strip dashes and spaces completely
    const rawIsbn = isbnInput.value.replace(/[-\s]/g, '').trim();
    if (!rawIsbn) {
        isbnInput.focus();
        return;
    }
    
    // 4. UI Feedback: Change button text to 'Searching...' and disable
    const btn = document.getElementById('fetchBtn');
    const originalBtnHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
    btn.disabled = true;

    try {
        // 3. Timeout & Error Handling: Promise.race with a 5000ms timeout
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 5000);
        
        const fetchPromise = fetch(`https://openlibrary.org/api/books?bibkeys=ISBN:${rawIsbn}&format=json&jscmd=data`, { signal: controller.signal });
        
        const res = await fetchPromise;
        clearTimeout(timeoutId);

        if (!res.ok) {
            throw new Error('Network response was not ok');
        }
        
        const json = await res.json();
        const bookData = json[`ISBN:${rawIsbn}`];
        
        if (bookData) {
            document.querySelector('input[name="name"]').value = bookData.title || '';
            
            if (bookData.authors && bookData.authors.length > 0) {
                document.querySelector('input[name="author"]').value = bookData.authors[0].name;
            }
            
            if (bookData.subjects && bookData.subjects.length > 0) {
                const sub = bookData.subjects[0].name;
                document.getElementById('newCategoryInput').value = sub;
                document.getElementById('categorySelect').value = '';
                document.getElementById('categorySelect').style.display = 'none';
                const catText = document.getElementById('newCatText');
                catText.innerHTML = `✨ Identified as: <strong>${sub}</strong> (will be created automatically)`;
                catText.style.display = 'block';
            }
            
            // 2. Cover Image Proxy & Fallback
            // Always try the direct URL structure first. OpenLibrary creates them dynamically. 
            // -L means large size.
            const cov = `https://covers.openlibrary.org/b/isbn/${rawIsbn}-L.jpg?default=false`;
            document.getElementById('coverUrlInput').value = cov;
            const img = document.getElementById('imgPreview');
            img.src = cov;
            
            // Fallback if the image doesn't exist (onerror)
            img.onerror = function() {
                this.onerror = null; // Prevent infinite loops
                this.src = '{{ asset("img/no-cover.svg") }}';
            };

            img.style.display = 'block';
            document.getElementById('dropPlaceholder').style.display = 'none';
            document.getElementById('dropZone').style.borderColor = 'var(--ss-cyan)';
            
            btn.innerHTML = '<i class="fas fa-check"></i> Success';
            btn.classList.add('ss-btn-success');
            btn.classList.remove('ss-btn-primary');
            setTimeout(() => {
                btn.innerHTML = originalBtnHTML;
                btn.classList.remove('ss-btn-success');
                btn.classList.add('ss-btn-primary');
                btn.disabled = false;
            }, 3000);
        } else {
            // Specifically handling "Not Found" vs "Server Busy"
            throw new Error('Book not found in OpenLibrary database.');
        }
    } catch (err) {
        let errorMsg = 'Not Found';
        if (err.name === 'AbortError') {
            errorMsg = 'Server Busy';
            alert('The OpenLibrary API is currently overloaded or too slow. Please try again or enter details manually.');
        } else if (err.message.includes('Book not found')) {
            alert('Could not find a book matching this ISBN in OpenLibrary. Please enter the details manually.');
        } else {
            errorMsg = 'Network Error';
            alert('Failed to connect to the metadata API. Check your connection.');
        }

        btn.innerHTML = `<i class="fas fa-times"></i> ${errorMsg}`;
        btn.classList.add('ss-btn-danger');
        btn.classList.remove('ss-btn-primary');
        setTimeout(() => { 
            btn.innerHTML = originalBtnHTML; 
            btn.disabled = false; 
            btn.classList.remove('ss-btn-danger');
            btn.classList.add('ss-btn-primary');
        }, 3000);
    }
}
</script>
</x-admin-layout>