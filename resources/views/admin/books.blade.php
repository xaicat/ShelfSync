<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Catalog</div>
        <h1 class="ss-page-title">Books / Journals</h1>
        <p class="ss-page-subtitle">Manage all books in the system</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="ss-btn ss-btn-primary">
        <i class="fas fa-plus"></i> Add New Book
    </a>
</div>

<div class="ss-card anim-fade-up-1" style="overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th style="width:50px;">QR</th>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td style="padding:10px;">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=48x48&color=00d4ff&bgcolor=0a0a0b&data=BOOK-{{ $book->id }}" 
                             alt="QR" title="Scan ID: BOOK-{{ $book->id }}"
                             style="border-radius:6px;border:1px solid rgba(0,212,255,0.2);cursor:pointer;"
                             onclick="window.open(this.src.replace('48x48','300x300'),'_blank')">
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:54px;border-radius:6px;overflow:hidden;flex-shrink:0;background:rgba(255,255,255,0.02);display:flex;align-items:center;justify-content:center;border:1px solid var(--ss-border);">
                                <img src="{{ $book->image ?? asset('img/no-cover.svg') }}" 
                                     onerror="this.onerror=null;this.src='{{ asset('img/no-cover.svg') }}';"
                                     style="width:100%;height:100%;object-fit:cover;">
                            </div>
                            <div>
                                <div style="font-weight:700;color:#fff;font-size:0.9rem;">{{ $book->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="color:var(--ss-text-2);">{{ $book->author ?? '—' }}</td>
                    <td>
                        <span style="background:rgba(255,255,255,0.06);padding:4px 10px;border-radius:6px;font-size:0.75rem;color:var(--ss-text-2);">
                            {{ $book->category->name ?? 'None' }}
                        </span>
                    </td>
                    <td>
                        @if($book->quantity <= 0)
                            <span style="color:var(--ss-rose);font-weight:700;font-size:0.85rem;">Out of Stock</span>
                        @elseif($book->quantity <= 3)
                            <span style="color:var(--ss-amber);font-weight:700;font-size:0.85rem;">{{ $book->quantity }} Left</span>
                        @else
                            <span style="color:#fff;font-weight:700;font-size:0.85rem;">{{ $book->quantity }}</span>
                        @endif
                    </td>
                    <td style="font-weight:700;color:var(--ss-electric);">৳{{ number_format($book->price, 0) }}</td>
                    <td style="text-align:center;white-space:nowrap;">
                        <div style="display:inline-flex;gap:8px;">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="ss-btn ss-btn-ghost ss-btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" style="margin:0;" onsubmit="return confirm('Delete this book?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="ss-btn ss-btn-danger ss-btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:60px;color:var(--ss-text-3);">
                        <i class="fas fa-book" style="font-size:2rem;display:block;margin-bottom:12px;"></i>
                        No books found. <a href="{{ route('admin.books.create') }}" style="color:var(--ss-cyan);">Add the first one.</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</x-admin-layout>