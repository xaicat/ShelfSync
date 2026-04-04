<x-user-layout>

<div style="padding:50px 0 80px;">
<div class="container" style="max-width:640px;">

    <div class="anim-fade-up" style="margin-bottom:28px;">
        <div class="ss-section-label">Borrow</div>
        <h1 class="ss-page-title">Rental Request</h1>
        <p class="ss-page-subtitle">Confirming rental for: <span style="color:var(--ss-cyan);font-weight:600;">{{ $book->name }}</span></p>
    </div>

    <!-- Book preview -->
    <div class="ss-card anim-fade-up-1" style="padding:18px;display:flex;gap:16px;align-items:center;margin-bottom:22px;">
        <div style="width:56px;height:74px;border-radius:10px;overflow:hidden;flex-shrink:0;border:1px solid var(--ss-border);background:linear-gradient(135deg,rgba(37,99,235,0.15),rgba(124,58,237,0.12));display:flex;align-items:center;justify-content:center;">
            @if($book->image)
                <img src="{{ asset('products/'.$book->image) }}" style="width:100%;height:100%;object-fit:cover;">
            @else
                <i class="fas fa-book" style="color:var(--ss-text-3);"></i>
            @endif
        </div>
        <div style="flex:1;">
            <div style="font-family:var(--ss-font-display);font-weight:700;color:#fff;font-size:1rem;">{{ $book->name }}</div>
            @if($book->author)
            <div style="font-size:0.8rem;color:var(--ss-text-2);">by {{ $book->author }}</div>
            @endif
            <div style="display:flex;gap:14px;margin-top:8px;">
                <span style="font-size:0.78rem;color:var(--ss-electric);">৳{{ number_format($book->price, 0) }}</span>
                <span style="font-size:0.78rem;color:{{ $book->quantity <= 3 ? 'var(--ss-amber)' : 'var(--ss-text-2)' }};">{{ $book->quantity }} copies available</span>
            </div>
        </div>
        <span class="ss-badge ss-badge-new">Available</span>
    </div>

    <!-- Rental Form -->
    <div class="ss-card anim-fade-up-2" style="padding:32px;">
        <form action="{{ route('user.rent.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            @if($errors->any())
            <div class="alert alert-danger mb-4"><i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}</div>
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>First Name <span style="color:var(--ss-rose)">*</span></label>
                    <input type="text" name="first-name" placeholder="First name"
                        value="{{ explode(' ', Auth::user()->name)[0] ?? '' }}"
                        required class="ss-input">
                </div>
                <div class="col-md-6">
                    <label>Surname <span style="color:var(--ss-rose)">*</span></label>
                    <input type="text" name="last-name" placeholder="Surname" required class="ss-input">
                </div>
            </div>

            <div class="mb-3">
                <label>Student ID <span style="color:var(--ss-rose)">*</span></label>
                <input type="text" name="student_number" placeholder="Enter your student ID" required class="ss-input">
            </div>

            <div class="row mb-3">
                <div class="col-md-7">
                    <label>Return Date <span style="color:var(--ss-rose)">*</span></label>
                    <input type="date" name="return_date" required class="ss-input"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>
                <div class="col-md-5">
                    <label>Quantity <span style="color:var(--ss-rose)">*</span></label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $book->quantity }}" required class="ss-input">
                </div>
            </div>

            <div class="mb-4">
                <label>Request Type</label>
                <select name="status" class="ss-input">
                    <option value="Online">Online Request</option>
                    <option value="Offline">Offline / In-person Pickup</option>
                </select>
            </div>

            <div style="background:rgba(245,158,11,0.08);border:1px solid rgba(245,158,11,0.2);border-radius:10px;padding:14px;margin-bottom:20px;font-size:0.82rem;color:var(--ss-amber);">
                <i class="fas fa-info-circle mr-2"></i>
                Your request will be sent as <strong>Pending</strong>. Stock is reserved only after admin approval.
            </div>

            <button type="submit" class="ss-btn ss-btn-primary ss-btn-block ss-btn-lg">
                <i class="fas fa-paper-plane"></i> Submit Rental Request
            </button>
        </form>
    </div>
</div>
</div>

</x-user-layout>