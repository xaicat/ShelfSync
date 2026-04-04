<x-user-layout>
<style>
.books-page { padding: 50px 0 80px; }
.page-header { margin-bottom: 36px; }
.filter-bar {
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    margin-bottom: 28px;
}
.filter-bar .ss-input { border-radius: var(--ss-r-pill) !important; padding: 10px 18px 10px 42px !important; }
.search-wrap { position: relative; flex: 1; min-width: 240px; max-width: 360px; }
.search-wrap i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--ss-text-3); font-size: 0.8rem; pointer-events: none; }
.filter-select { flex: 0 0 180px; }

.books-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 22px;
}
.books-count { font-size: 0.82rem; color: var(--ss-text-2); margin-left: auto; }
</style>

<div class="books-page">
    <div class="container">
        <!-- Header -->
        <div class="page-header anim-fade-up">
            <div class="ss-section-label">Catalog</div>
            <h1 class="ss-page-title">Book Collection</h1>
            <p class="ss-page-subtitle">Browse and rent from our library of {{ $books->count() }} books</p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar anim-fade-up-1">
            <form action="{{ route('user.books') }}" method="GET" style="display:contents;">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="ss-input" placeholder="Search title, author…"
                        style="border-radius:var(--ss-r-pill)!important;padding-left:42px!important;">
                </div>
                <select name="category" class="ss-input filter-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ss-btn ss-btn-primary ss-btn-sm"><i class="fas fa-filter"></i> Filter</button>
                @if(request('search') || request('category'))
                    <a href="{{ route('user.books') }}" class="ss-btn ss-btn-ghost ss-btn-sm"><i class="fas fa-times"></i> Clear</a>
                @endif
                <span class="books-count">{{ $books->count() }} results</span>
            </form>
        </div>

        <!-- Books Grid -->
        @if($books->isEmpty())
            <div style="text-align:center;padding:80px 0;">
                <div style="font-size:3rem;margin-bottom:16px;color:var(--ss-text-3);">📚</div>
                <p style="color:var(--ss-text-2);font-size:1rem;">No books found matching your search.</p>
                <a href="{{ route('user.books') }}" class="ss-btn ss-btn-ghost ss-btn-sm mt-3">Clear filters</a>
            </div>
        @else
        <div class="books-grid anim-fade-up-2">
            @foreach($books as $book)
            <div class="book-card" onmousemove="spotlightCard(event,this)">
                <!-- Cover -->
                <div class="book-card-cover">
                    @if($book->image)
                        <img src="{{ asset('products/' . $book->image) }}" alt="{{ $book->name }}">
                    @else
                        <i class="fas fa-book no-cover"></i>
                    @endif

                    <!-- Qty badge -->
                    @if($book->quantity <= 0)
                        <div class="book-qty-badge out">Out of Stock</div>
                    @elseif($book->quantity <= 3)
                        <div class="book-qty-badge low">⚠ {{ $book->quantity }} left</div>
                    @else
                        <div class="book-qty-badge">{{ $book->quantity }} left</div>
                    @endif

                    <!-- New badge if recent -->
                    @if($book->created_at && $book->created_at->diffInDays() <= 14)
                        <div style="position:absolute;top:10px;left:10px;">
                            <span class="ss-badge ss-badge-new" style="padding:2px 8px;font-size:0.62rem;">New</span>
                        </div>
                    @endif
                </div>

                <!-- Body -->
                <div class="book-card-body">
                    <div class="book-card-cat">{{ $book->category->name ?? 'General' }}</div>
                    <div class="book-card-title" title="{{ $book->name }}">{{ $book->name }}</div>
                    <div class="book-card-author">{{ $book->author ?? 'Unknown Author' }}</div>
                    <div class="book-card-footer">
                        <span class="book-card-price">৳{{ number_format($book->price, 0) }}</span>
                        @if($book->quantity > 0)
                            @auth
                            <a href="{{ route('user.rent', $book->id) }}" class="ss-btn ss-btn-primary ss-btn-sm">
                                <i class="fas fa-bookmark"></i> Rent
                            </a>
                            @else
                            <a href="{{ route('login') }}" class="ss-btn ss-btn-ghost ss-btn-sm">Login</a>
                            @endauth
                        @else
                            <button disabled class="ss-btn ss-btn-ghost ss-btn-sm" style="opacity:0.4;cursor:not-allowed;">
                                Unavailable
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
function spotlightCard(e, card) {
    const r = card.getBoundingClientRect();
    card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
    card.style.setProperty('--my', (e.clientY - r.top) + 'px');
}
</script>
</x-user-layout>