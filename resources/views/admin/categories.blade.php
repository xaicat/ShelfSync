<x-admin-layout>

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;" class="anim-fade-up">
    <div>
        <div class="ss-section-label">Catalog</div>
        <h1 class="ss-page-title">Book Categories</h1>
        <p class="ss-page-subtitle">Organize your library collection by subject</p>
    </div>
    <button type="button" class="ss-btn ss-btn-primary" data-toggle="modal" data-target="#addCategoryModal">
        <i class="fas fa-plus"></i> New Category
    </button>
</div>

<div class="ss-card anim-fade-up-1" style="overflow:hidden;">
    <div class="table-responsive">
        <table class="table table-hover" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th width="8%">#</th>
                    <th>Category Name</th>
                    <th>Books</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td style="color:var(--ss-text-3);font-size:0.78rem;">{{ $loop->iteration }}</td>
                    <td>
                        <span style="font-weight:700;color:#fff;font-size:0.95rem;">{{ $category->name }}</span>
                    </td>
                    <td>
                        <span style="background:rgba(0,212,255,0.08);color:var(--ss-cyan);border:1px solid rgba(0,212,255,0.18);border-radius:var(--ss-r-pill);padding:3px 12px;font-size:0.74rem;font-weight:600;">
                            {{ $category->books_count ?? $category->books()->count() }} books
                        </span>
                    </td>
                    <td style="text-align:center;">
                        <div style="display:inline-flex;gap:8px;">
                            <button type="button" class="ss-btn ss-btn-ghost ss-btn-sm"
                                data-toggle="modal" data-target="#updateModal{{ $category->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" style="margin:0;"
                                onsubmit="return confirm('Delete this category? Books in this category may be affected.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="ss-btn ss-btn-danger ss-btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modals -->
@foreach($categories as $category)
<div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background:#0f0f14;border:1px solid var(--ss-border-strong);border-radius:var(--ss-r-lg);">
            <div class="modal-header" style="border-bottom:1px solid var(--ss-border);padding:20px 24px;">
                <h5 class="modal-title" style="color:#fff;font-family:var(--ss-font-display);font-weight:700;">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:var(--ss-text-2);font-size:1.4rem;">&times;</button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding:24px;">
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <label>Category Name</label>
                    <input type="text" name="name" class="ss-input" value="{{ $category->name }}" required>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--ss-border);padding:16px 24px;">
                    <button type="button" class="ss-btn ss-btn-ghost ss-btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="ss-btn ss-btn-primary ss-btn-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background:#0f0f14;border:1px solid var(--ss-border-strong);border-radius:var(--ss-r-lg);">
            <div class="modal-header" style="border-bottom:1px solid var(--ss-border);padding:20px 24px;">
                <h5 class="modal-title" style="color:#fff;font-family:var(--ss-font-display);font-weight:700;">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" style="color:var(--ss-text-2);font-size:1.4rem;">&times;</button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding:24px;">
                    <label>Category Name</label>
                    <input type="text" name="name" class="ss-input" placeholder="e.g. Computer Science" required>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--ss-border);padding:16px 24px;">
                    <button type="button" class="ss-btn ss-btn-ghost ss-btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="ss-btn ss-btn-primary ss-btn-sm"><i class="fas fa-plus"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-admin-layout>