<x-admin-layout>

<div style="margin-bottom:24px;" class="anim-fade-up">
    <div class="ss-section-label">Operations</div>
    <h1 class="ss-page-title">Quick Return Scanner</h1>
    <p class="ss-page-subtitle">Scan rental QR codes or manually enter Rental ID</p>
</div>

<div class="row anim-fade-up-1">
    <div class="col-md-6 offset-md-3">
        <div class="ss-card" style="padding:40px 30px;text-align:center;">
            
            <div style="width:80px;height:80px;border-radius:50%;background:rgba(0,212,255,0.06);color:var(--ss-cyan);font-size:2rem;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;border:1px solid rgba(0,212,255,0.2);box-shadow:0 0 20px rgba(0,212,255,0.1);">
                <i class="fas fa-barcode"></i>
            </div>
            
            <h3 style="font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:8px;">Ready to Scan</h3>
            <p style="font-size:0.85rem;color:var(--ss-text-2);margin-bottom:32px;">Input field is focused. Scan a code or type 'RENTAL-14'</p>
            
            <form action="{{ route('admin.returns.processScan') }}" method="POST">
                @csrf
                <div style="position:relative;max-width:300px;margin:0 auto;">
                    <i class="fas fa-keyboard" style="position:absolute;left:18px;top:50%;transform:translateY(-50%);color:var(--ss-text-3);"></i>
                    <input type="text" name="scan_id" id="scanInput" class="ss-input" placeholder="Scan or type ID..." required autofocus autocomplete="off" style="padding-left:46px !important;font-family:monospace;font-size:1.1rem;letter-spacing:1px;text-align:center;">
                </div>
                
                <button type="submit" class="ss-btn ss-btn-primary mt-4" style="width:100%;max-width:300px;">
                    Process Return
                </button>
            </form>

        </div>
    </div>
</div>

<script>
// Auto-focus scanner input
document.addEventListener('click', function(e) {
    if (e.target.tagName !== 'INPUT' && e.target.tagName !== 'BUTTON' && e.target.tagName !== 'A') {
        document.getElementById('scanInput').focus();
    }
});
</script>

</x-admin-layout>
