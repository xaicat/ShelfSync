<x-user-layout>
<style>
.books-page { padding: 50px 0 80px; }
.filter-bar { display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:28px; }
.search-wrap { position:relative;flex:1;min-width:240px;max-width:380px; }
.search-wrap i { position:absolute;left:16px;top:50%;transform:translateY(-50%);color:var(--ss-text-3);font-size:0.8rem;pointer-events:none; }
.search-wrap input { padding-left:42px !important; border-radius:var(--ss-r-pill) !important; }
.books-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(195px,1fr));gap:22px; }
.books-count { font-size:0.82rem;color:var(--ss-text-2);margin-left:auto;white-space:nowrap; }
#no-results { display:none;text-align:center;padding:80px 0; }
.bai-trigger {
    width: 26px; height: 26px; border-radius: 7px; flex-shrink: 0;
    background: rgba(0,212,255,0.08); border: 1px solid rgba(0,212,255,0.15);
    color: var(--ss-cyan); font-size: 0.72rem;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s; opacity: 0.6;
}
.book-card:hover .bai-trigger { opacity: 1; }
.bai-trigger:hover { background: rgba(0,212,255,0.18); transform: scale(1.1); opacity: 1; }
</style>

<div class="books-page">
<div class="container">

    <!-- Header -->
    <div class="page-header anim-fade-up" style="margin-bottom:32px;">
        <div class="ss-section-label">Catalog</div>
        <h1 class="ss-page-title">Book Collection</h1>
        <p class="ss-page-subtitle">Browse and rent from our library</p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar anim-fade-up-1">
        <form action="{{ route('user.books') }}" method="GET" style="display:contents;" id="filter-form">
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="book-search" name="search" value="{{ request('search') }}"
                    class="ss-input" placeholder="Search title, author, category…">
            </div>
            <select name="category" id="cat-filter" class="ss-input" style="flex:0 0 180px;" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="ss-btn ss-btn-primary ss-btn-sm"><i class="fas fa-filter"></i> Filter</button>
            @if(request('search') || request('category'))
            <a href="{{ route('user.books') }}" class="ss-btn ss-btn-ghost ss-btn-sm"><i class="fas fa-times"></i></a>
            @endif
        </form>
        <span class="books-count" id="result-count">{{ $books->count() }} books</span>
    </div>

    <!-- Books Grid -->
    <div class="books-grid anim-fade-up-2" id="books-grid">
        @forelse($books as $book)
        @php $wished = in_array($book->id, $wishlistIds ?? []); @endphp
        <div class="book-card" data-name="{{ strtolower($book->name) }}" data-author="{{ strtolower($book->author ?? '') }}" data-cat="{{ strtolower($book->category->name ?? '') }}" onmousemove="spotCard(event,this)">

            <!-- Cover -->
            <div class="book-card-cover">
                <img src="{{ $book->image ?? asset('img/no-cover.svg') }}" 
                     onerror="this.onerror=null;this.src='{{ asset('img/no-cover.svg') }}';"
                     alt="{{ $book->name }}">

                <!-- Wishlist toggle (auth only) -->
                @auth
                <button class="wish-toggle{{ $wished ? ' wishlisted' : '' }}"
                    data-book-id="{{ $book->id }}"
                    title="{{ $wished ? 'Remove from wishlist' : 'Add to wishlist' }}">
                    <i class="fas fa-heart"></i>
                </button>
                @endauth

                <!-- Qty badge -->
                @if($book->quantity <= 0)
                    <div class="book-qty-badge out">Out of Stock</div>
                @elseif($book->quantity <= 3)
                    <div class="book-qty-badge low">⚠ {{ $book->quantity }} left</div>
                @else
                    <div class="book-qty-badge">{{ $book->quantity }} left</div>
                @endif

                @if($book->created_at && $book->created_at->diffInDays() <= 14)
                <div style="position:absolute;bottom:10px;left:10px;">
                    <span class="ss-badge ss-badge-new" style="font-size:0.6rem;padding:2px 8px;">New</span>
                </div>
                @endif
            </div>

            <!-- Body -->
            <div class="book-card-body">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:6px;">
                    <div class="book-card-cat">{{ $book->category->name ?? 'General' }}</div>
                    <button class="bai-trigger" onclick="event.stopPropagation();BookAI.open({{ $book->id }}, '{{ addslashes($book->name) }}', '{{ addslashes($book->author ?? 'Unknown') }}', '{{ $book->image ?? asset('img/no-cover.svg') }}')" title="AI Book Info">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>
                <div class="book-card-title" title="{{ $book->name }}">{{ $book->name }}</div>
                <div class="book-card-author">{{ $book->author ?? 'Unknown Author' }}</div>
                <div class="book-card-footer">
                    <span class="book-card-price">৳{{ number_format($book->price, 0) }}</span>
                    @if($book->quantity > 0)
                        @auth
                            @if(Auth::user()->card_status === 'approved')
                                <a href="{{ route('user.rent', $book->id) }}" class="ss-btn ss-btn-primary ss-btn-sm">
                                    <i class="fas fa-bookmark"></i> Rent
                                </a>
                            @else
                                <a href="{{ route('profile.edit') }}" class="ss-btn ss-btn-ghost ss-btn-sm" style="color:var(--ss-amber);border-color:var(--ss-amber);">
                                    <i class="fas fa-id-card"></i> Card Req.
                                </a>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="ss-btn ss-btn-ghost ss-btn-sm">Login</a>
                        @endauth
                    @else
                        <button disabled class="ss-btn ss-btn-ghost ss-btn-sm" style="opacity:.4;cursor:not-allowed;">Unavailable</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1;text-align:center;padding:80px 0;">
            <div style="font-size:3rem;margin-bottom:16px;color:var(--ss-text-3);">📚</div>
            <p style="color:var(--ss-text-2);">No books found.</p>
        </div>
        @endforelse
    </div>

    <div id="no-results">
        <div style="font-size:3rem;margin-bottom:16px;color:var(--ss-text-3);">🔍</div>
        <p style="color:var(--ss-text-2);">No books match your search.</p>
        <button onclick="clearSearch()" class="ss-btn ss-btn-ghost ss-btn-sm mt-2">Clear search</button>
    </div>

</div>
</div>

<script>
// ── Spotlight card effect ──────────────────────────────
function spotCard(e, card) {
    const r = card.getBoundingClientRect();
    card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
    card.style.setProperty('--my', (e.clientY - r.top) + 'px');
}

// ── Real-time search filter ──────────────────────────
const searchInput = document.getElementById('book-search');
const grid = document.getElementById('books-grid');
const noResults = document.getElementById('no-results');
const countEl = document.getElementById('result-count');
const allCards = () => grid.querySelectorAll('.book-card');

function filterBooks() {
    const q = searchInput.value.toLowerCase().trim();
    let visible = 0;
    allCards().forEach(card => {
        const match = !q ||
            card.dataset.name.includes(q) ||
            card.dataset.author.includes(q) ||
            card.dataset.cat.includes(q);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    countEl.textContent = visible + ' books';
    noResults.style.display = visible === 0 && q ? 'block' : 'none';
    grid.style.display = visible === 0 && q ? 'none' : 'grid';
}
function clearSearch() {
    searchInput.value = '';
    filterBooks();
}
if (searchInput) {
    searchInput.addEventListener('input', filterBooks);
}

// ── Wishlist AJAX toggle ────────────────────────────
@auth
const csrfToken = '{{ csrf_token() }}';
document.querySelectorAll('.wish-toggle').forEach(btn => {
    btn.addEventListener('click', async function(e) {
        e.preventDefault();
        const bookId = this.dataset.bookId;
        this.classList.add('pop');
        this.addEventListener('animationend', () => this.classList.remove('pop'), {once: true});

        try {
            const res = await fetch(`/wishlist/toggle/${bookId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });
            const data = await res.json();
            this.classList.toggle('wishlisted', data.wishlisted);
            this.title = data.wishlisted ? 'Remove from wishlist' : 'Add to wishlist';
        } catch(err) {
            console.error('Wishlist toggle failed:', err);
        }
    });
});
@endauth
</script>
</x-user-layout>