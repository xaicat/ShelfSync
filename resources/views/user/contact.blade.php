<x-user-layout>

<div style="padding:50px 0 80px;">
<div class="container" style="max-width:700px;">

    <div class="anim-fade-up" style="margin-bottom:28px;">
        <div class="ss-section-label">Support</div>
        <h1 class="ss-page-title">Contact Us</h1>
        <p class="ss-page-subtitle">Send us a message and we'll get back to you promptly</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success anim-fade-up" style="margin-bottom:20px;">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="ss-card anim-fade-up-1" style="padding:36px;">
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            @if($errors->any())
            <div class="alert alert-danger mb-4"><i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first() }}</div>
            @endif

            <div class="row mb-3">
                <div class="col-md-8">
                    <label>Subject / Topic <span style="color:var(--ss-rose);">*</span></label>
                    <input type="text" name="productName" value="{{ old('productName') }}" required
                        class="ss-input" placeholder="e.g. Book Availability Query">
                </div>
                <div class="col-md-4">
                    <label>Category</label>
                    <select name="category" class="ss-input">
                        <option value="">Select…</option>
                        <option>Rental Query</option>
                        <option>Book Request</option>
                        <option>Technical Issue</option>
                        <option>Other</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-7">
                    <label>Email Address <span style="color:var(--ss-rose);">*</span></label>
                    <input type="email" name="Email" value="{{ old('Email', Auth::user()->email ?? '') }}" required
                        class="ss-input" placeholder="you@example.com">
                </div>
                <div class="col-md-5">
                    <label>Phone Number <span style="color:var(--ss-rose);">*</span></label>
                    <input type="tel" name="Number" value="{{ old('Number') }}" required
                        class="ss-input" placeholder="+880 …">
                </div>
            </div>

            <div class="mb-4">
                <label>Message <span style="color:var(--ss-rose);">*</span></label>
                <textarea name="Message" rows="5" required class="ss-input"
                    placeholder="Describe your question or request in detail…">{{ old('Message') }}</textarea>
            </div>

            <button type="submit" class="ss-btn ss-btn-primary ss-btn-block ss-btn-lg">
                <i class="fas fa-paper-plane"></i> Send Message
            </button>
        </form>
    </div>

    <!-- Contact Info -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:22px;" class="anim-fade-up-2">
        <div class="ss-card" style="padding:20px;text-align:center;">
            <div style="width:38px;height:38px;border-radius:10px;background:rgba(0,212,255,0.12);color:var(--ss-cyan);display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:0.9rem;"><i class="fas fa-envelope"></i></div>
            <div style="font-size:0.78rem;color:var(--ss-text-2);">Email Us</div>
            <div style="font-size:0.84rem;color:#fff;font-weight:600;margin-top:4px;">library@shelfsync.io</div>
        </div>
        <div class="ss-card" style="padding:20px;text-align:center;">
            <div style="width:38px;height:38px;border-radius:10px;background:rgba(6,214,160,0.12);color:var(--ss-electric);display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:0.9rem;"><i class="fas fa-clock"></i></div>
            <div style="font-size:0.78rem;color:var(--ss-text-2);">Library Hours</div>
            <div style="font-size:0.84rem;color:#fff;font-weight:600;margin-top:4px;">Sat–Thu, 9AM–5PM</div>
        </div>
    </div>
</div>
</div>

</x-user-layout>