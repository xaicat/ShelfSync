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
                    <th>#</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td style="color:var(--ss-text-3);font-size:0.78rem;">{{ $loop->iteration }}</td>
                    <td>
                        <div style="width:44px;height:58px;border-radius:7px;overflow:hidden;border:1px solid var(--ss-border);background:rgba(37,99,235,0.1);display:flex;align-items:center;justify-content:center;">
                            @if($book->image)
                                <img src="{{ asset('products/' . $book->image) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <i class="fas fa-image" style="color:var(--ss-text-3);font-size:0.9rem;"></i>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:700;color:#fff;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $book->name }}">
                            {{ $book->name }}
                        </div>
                        @if($book->description)
                        <div style="font-size:0.74rem;color:var(--ss-text-3);max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $book->description }}">
                            {{ $book->description }}
                        </div>
                        @endif
                    </td>
                    <td style="color:var(--ss-text-2);font-size:0.84rem;">{{ $book->author ?? '—' }}</td>
                    <td>
                        <span style="background:rgba(0,212,255,0.08);color:var(--ss-cyan);border:1px solid rgba(0,212,255,0.2);border-radius:var(--ss-r-pill);padding:3px 12px;font-size:0.74rem;font-weight:600;white-space:nowrap;">
                            {{ $book->category->name ?? 'N/A' }}
                        </span>
                    </td>
                    <td>
                        <span style="font-weight:700;color:{{ $book->quantity <= 0 ? 'var(--ss-rose)' : ($book->quantity <= 3 ? 'var(--ss-amber)' : 'var(--ss-electric)') }};">
                            {{ $book->quantity }}
                        </span>
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