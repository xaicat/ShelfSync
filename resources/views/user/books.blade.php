<x-user-layout>
    <style>
        /* ─────────────────────────────────────────────────
           FONTS
        ───────────────────────────────────────────────── */
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap');

        /* ─────────────────────────────────────────────────
           DESIGN TOKENS
        ───────────────────────────────────────────────── */
        :root {
            --deep:           #050c18;
            --surface:        rgba(255,255,255,0.032);
            --surface-hover:  rgba(255,255,255,0.055);
            --rim:            rgba(255,255,255,0.07);
            --rim-hot:        rgba(30,127,255,0.5);
            --azure:          #1e7fff;
            --azure-glow:     rgba(30,127,255,0.28);
            --electric:       #00e5ff;
            --electric-glow:  rgba(0,229,255,0.2);
            --success-col:    #00e6b3;
            --danger-col:     #ff5566;
            --gold:           #f5c842;
            --white-dim:      rgba(255,255,255,0.52);
            --white-ghost:    rgba(255,255,255,0.07);
            --font-display:   'Bebas Neue', sans-serif;
            --font-body:      'Outfit', sans-serif;
            --r-section:      24px;
            --r-row:          14px;
        }

        /* ─────────────────────────────────────────────────
           AMBIENT BLOBS  (fixed, behind everything)
        ───────────────────────────────────────────────── */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }
        .blob-a {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(30,127,255,0.12) 0%, transparent 65%);
            top: -180px; left: -120px;
            animation: bA 24s ease-in-out infinite;
        }
        .blob-b {
            width: 440px; height: 440px;
            background: radial-gradient(circle, rgba(0,229,255,0.08) 0%, transparent 65%);
            bottom: 0; right: -80px;
            animation: bB 30s ease-in-out infinite;
        }
        @keyframes bA {
            0%,100% { transform: translate(0,0); }
            50%     { transform: translate(50px,-40px) scale(1.06); }
        }
        @keyframes bB {
            0%,100% { transform: translate(0,0); }
            50%     { transform: translate(-40px,30px) scale(1.04); }
        }

        /* ─────────────────────────────────────────────────
           SCAN-LINE TEXTURE
        ───────────────────────────────────────────────── */
        .container-fostrap::before {
            content: '';
            position: fixed; inset: 0;
            background: repeating-linear-gradient(
                0deg, transparent, transparent 2px,
                rgba(0,0,0,0.025) 2px, rgba(0,0,0,0.025) 4px
            );
            pointer-events: none;
            z-index: 9000;
        }

        /* ─────────────────────────────────────────────────
           SECTION SHELL
        ───────────────────────────────────────────────── */
        .books-section {
            background: rgba(5,12,24,0.75) !important;
            border-radius: var(--r-section) !important;
            padding: 36px 32px !important;
            border: 1px solid var(--rim) !important;
            box-shadow:
                0 0 0 1px rgba(30,127,255,0.04),
                0 40px 80px rgba(0,0,0,0.6),
                inset 0 1px 0 rgba(255,255,255,0.05) !important;
            backdrop-filter: blur(24px) saturate(1.6);
            position: relative;
            z-index: 1;
            animation: sectionIn 0.75s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes sectionIn {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Spinning corner accent */
        .books-section::before {
            content: '';
            position: absolute;
            top: -1px; left: -1px; right: -1px; bottom: -1px;
            border-radius: calc(var(--r-section) + 1px);
            background: conic-gradient(
                from var(--spin, 0deg),
                transparent 0deg,
                var(--azure) 50deg,
                var(--electric) 100deg,
                transparent 150deg,
                transparent 360deg
            );
            animation: spinGlow 7s linear infinite;
            z-index: -1;
            pointer-events: none;
        }
        .books-section::after {
            content: '';
            position: absolute; inset: 1px;
            border-radius: calc(var(--r-section) - 1px);
            background: rgba(5,12,24,0.98);
            z-index: -1;
        }
        @property --spin {
            syntax: '<angle>';
            initial-value: 0deg;
            inherits: false;
        }
        @keyframes spinGlow { to { --spin: 360deg; } }

        /* ─────────────────────────────────────────────────
           PAGE TITLE
        ───────────────────────────────────────────────── */
        .books-section h2 {
            font-family: var(--font-display) !important;
            font-size: clamp(2.2rem, 4vw, 3.4rem) !important;
            font-weight: 400 !important;
            letter-spacing: 0.06em !important;
            background: linear-gradient(160deg, #ffffff 30%, rgba(30,127,255,0.9) 65%, var(--electric));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            display: inline-block;
            margin-bottom: 28px !important;
        }
        /* Underline accent */
        .books-section h2::after {
            content: '';
            position: absolute;
            left: 0; bottom: -6px;
            width: 56px; height: 2px;
            background: linear-gradient(90deg, var(--azure), var(--electric));
            border-radius: 2px;
            box-shadow: 0 0 10px var(--azure-glow);
        }

        /* ─────────────────────────────────────────────────
           ALERT
        ───────────────────────────────────────────────── */
        .alert-success {
            background: rgba(0,230,179,0.1) !important;
            border: 1px solid rgba(0,230,179,0.3) !important;
            color: #00e6b3 !important;
            border-radius: 12px !important;
            font-family: var(--font-body);
            font-size: 0.9rem;
            backdrop-filter: blur(8px);
        }
        .alert-success .close { color: #00e6b3 !important; opacity: 0.7; }

        /* ─────────────────────────────────────────────────
           TABLE WRAPPER
        ───────────────────────────────────────────────── */
        .table-responsive {
            background: transparent !important;
            border-radius: 16px !important;
            padding: 0 !important;
            overflow: hidden;
            border: 1px solid var(--rim);
        }

        /* ─────────────────────────────────────────────────
           TABLE BASE
        ───────────────────────────────────────────────── */
        .table {
            margin-bottom: 0 !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }

        /* ─────────────────────────────────────────────────
           THEAD
        ───────────────────────────────────────────────── */
        .table thead {
            background: rgba(30,127,255,0.07);
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(16px);
        }
        .table thead th {
            font-family: var(--font-body) !important;
            font-size: 0.72rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.14em !important;
            text-transform: uppercase !important;
            color: rgba(255,255,255,0.5) !important;
            border-top: none !important;
            border-bottom: 1px solid rgba(30,127,255,0.2) !important;
            padding: 16px 18px !important;
            white-space: nowrap;
        }
        .table thead th:first-child { padding-left: 24px !important; border-radius: 0 !important; }
        .table thead th:last-child  { padding-right: 24px !important; }

        /* ─────────────────────────────────────────────────
           TBODY ROWS  — glass card style
        ───────────────────────────────────────────────── */
        .table tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.04) !important;
            transition: background 0.25s, transform 0.25s !important;
            animation: rowIn 0.5s cubic-bezier(0.16,1,0.3,1) both;
            position: relative;
        }
        /* Stagger each row */
        .table tbody tr:nth-child(1)  { animation-delay: 0.05s; }
        .table tbody tr:nth-child(2)  { animation-delay: 0.10s; }
        .table tbody tr:nth-child(3)  { animation-delay: 0.15s; }
        .table tbody tr:nth-child(4)  { animation-delay: 0.20s; }
        .table tbody tr:nth-child(5)  { animation-delay: 0.25s; }
        .table tbody tr:nth-child(6)  { animation-delay: 0.30s; }
        .table tbody tr:nth-child(7)  { animation-delay: 0.35s; }
        .table tbody tr:nth-child(8)  { animation-delay: 0.40s; }
        .table tbody tr:nth-child(9)  { animation-delay: 0.45s; }
        .table tbody tr:nth-child(10) { animation-delay: 0.50s; }

        @keyframes rowIn {
            from { opacity: 0; transform: translateX(-16px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* Override inline onmouseover — use pure CSS */
        .table tbody tr:hover {
            background: var(--surface-hover) !important;
        }
        /* Left-edge accent bar on hover */
        .table tbody tr td:first-child {
            position: relative;
        }
        .table tbody tr td:first-child::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 2px;
            background: linear-gradient(180deg, var(--azure), var(--electric));
            border-radius: 2px;
            opacity: 0;
            transform: scaleY(0);
            transition: opacity 0.25s, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 0 8px var(--azure-glow);
        }
        .table tbody tr:hover td:first-child::before {
            opacity: 1;
            transform: scaleY(1);
        }

        /* TD shared */
        .table tbody td {
            font-family: var(--font-body) !important;
            font-size: 0.9rem !important;
            font-weight: 300 !important;
            padding: 16px 18px !important;
            vertical-align: middle !important;
            border: none !important;
            color: rgba(210,225,245,0.75) !important;
        }
        .table tbody td:first-child { padding-left: 24px !important; }
        .table tbody td:last-child  { padding-right: 24px !important; }

        /* Serial number */
        .text-white-50 {
            font-family: var(--font-body) !important;
            font-size: 0.78rem !important;
            color: rgba(255,255,255,0.3) !important;
            letter-spacing: 0.06em;
        }

        /* Book name */
        .table tbody td.font-weight-bold.text-white {
            font-family: var(--font-body) !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            color: #e8f0ff !important;
            letter-spacing: -0.01em;
        }

        /* Category */
        .text-info {
            font-family: var(--font-body) !important;
            font-size: 0.78rem !important;
            font-weight: 500 !important;
            color: var(--electric) !important;
            letter-spacing: 0.06em;
            background: rgba(0,229,255,0.08);
            border: 1px solid rgba(0,229,255,0.2);
            border-radius: 100px;
            padding: 3px 12px;
            display: inline-block;
            white-space: nowrap;
        }

        /* ─────────────────────────────────────────────────
           BOOK PREVIEW BOX
        ───────────────────────────────────────────────── */
        .book-preview-box {
            width: 52px !important;
            height: 70px !important;
            border-radius: 8px !important;
            overflow: hidden;
            border: 1px solid var(--rim) !important;
            background: rgba(0,0,0,0.4) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.3s, border-color 0.3s !important;
            position: relative;
            box-shadow: 0 4px 16px rgba(0,0,0,0.4);
        }
        .book-preview-box img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
        }
        .book-preview-box:hover {
            transform: scale(1.18) rotateY(-8deg) !important;
            border-color: rgba(30,127,255,0.5) !important;
            box-shadow: 0 8px 28px rgba(30,127,255,0.3), 0 0 0 1px rgba(30,127,255,0.15) !important;
        }
        /* Shine overlay on cover */
        .book-preview-box::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        /* ─────────────────────────────────────────────────
           QUANTITY BADGES
        ───────────────────────────────────────────────── */
        .badge-success {
            font-family: var(--font-body) !important;
            font-size: 0.72rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.06em;
            background: rgba(0,230,179,0.12) !important;
            color: var(--success-col) !important;
            border: 1px solid rgba(0,230,179,0.3) !important;
            border-radius: 100px !important;
            padding: 5px 14px !important;
            box-shadow: 0 0 10px rgba(0,230,179,0.15);
        }
        .badge-danger {
            font-family: var(--font-body) !important;
            font-size: 0.72rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.06em;
            background: rgba(255,85,102,0.1) !important;
            color: var(--danger-col) !important;
            border: 1px solid rgba(255,85,102,0.3) !important;
            border-radius: 100px !important;
            padding: 5px 14px !important;
            box-shadow: 0 0 10px rgba(255,85,102,0.12);
        }

        /* ─────────────────────────────────────────────────
           PRICE
        ───────────────────────────────────────────────── */
        .text-success.font-weight-bold {
            font-family: var(--font-body) !important;
            font-weight: 600 !important;
            font-size: 0.9rem !important;
            color: var(--success-col) !important;
            text-shadow: 0 0 14px rgba(0,230,179,0.3) !important;
        }

        /* Weight */
        .table tbody td.small {
            font-family: var(--font-body) !important;
            font-size: 0.8rem !important;
            color: rgba(200,215,240,0.4) !important;
        }

        /* Description truncation */
        .table tbody td[style*="text-overflow"] {
            font-family: var(--font-body) !important;
            font-size: 0.82rem !important;
            color: rgba(190,205,235,0.45) !important;
            max-width: 180px !important;
        }

        /* ─────────────────────────────────────────────────
           BTN MODERN  — RENT button
        ───────────────────────────────────────────────── */
        .btn-modern {
            font-family: var(--font-body) !important;
            font-size: 0.78rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.1em !important;
            text-transform: uppercase;
            color: #fff !important;
            background: linear-gradient(135deg, var(--azure), #0a5fd4) !important;
            border: none !important;
            border-radius: 100px !important;
            padding: 8px 22px !important;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            transition:
                transform 0.3s cubic-bezier(0.34,1.56,0.64,1),
                box-shadow 0.3s !important;
            box-shadow: 0 4px 18px rgba(30,127,255,0.3), inset 0 1px 0 rgba(255,255,255,0.12) !important;
        }
        /* Shimmer sweep */
        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0; left: -110%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: skewX(-18deg);
            transition: left 0.5s;
        }
        .btn-modern:hover::before { left: 110%; }
        /* Outer glow ring */
        .btn-modern::after {
            content: '';
            position: absolute; inset: -2px;
            border-radius: 100px;
            background: conic-gradient(from 0deg, var(--azure), var(--electric), var(--azure));
            opacity: 0; z-index: -1;
            filter: blur(5px);
            transition: opacity 0.3s;
        }
        .btn-modern:hover::after { opacity: 0.8; }
        .btn-modern:hover {
            transform: translateY(-3px) scale(1.05) !important;
            box-shadow: 0 12px 36px rgba(30,127,255,0.5) !important;
            color: #fff !important;
        }
        .btn-modern:active {
            transform: translateY(0) scale(0.97) !important;
        }

        /* Out of stock button */
        .btn-secondary.disabled {
            font-family: var(--font-body) !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            letter-spacing: 0.08em;
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: rgba(255,255,255,0.25) !important;
            border-radius: 100px !important;
            padding: 7px 18px !important;
        }

        /* ─────────────────────────────────────────────────
           EMPTY STATE  (forelse empty row)
        ───────────────────────────────────────────────── */
        .table tbody td.text-muted {
            font-family: var(--font-body) !important;
            font-size: 0.9rem !important;
            color: rgba(190,210,240,0.3) !important;
            padding: 64px 24px !important;
            letter-spacing: 0.04em;
        }

        /* ─────────────────────────────────────────────────
           SEARCH BAR  (injected by JS)
        ───────────────────────────────────────────────── */
        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }
        .search-wrap {
            position: relative;
            flex: 0 0 280px;
        }
        .search-wrap i {
            position: absolute;
            left: 16px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.25);
            font-size: 0.82rem;
            pointer-events: none;
        }
        .search-input {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--rim);
            border-radius: 100px;
            padding: 10px 18px 10px 40px;
            color: #e8f0ff;
            font-family: var(--font-body);
            font-size: 0.85rem;
            font-weight: 300;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
            backdrop-filter: blur(12px);
        }
        .search-input::placeholder { color: rgba(255,255,255,0.2); }
        .search-input:focus {
            border-color: rgba(30,127,255,0.5);
            box-shadow: 0 0 0 3px rgba(30,127,255,0.1);
            background: var(--surface-hover);
        }

        /* Row count badge */
        .row-count {
            font-family: var(--font-body);
            font-size: 0.78rem;
            font-weight: 500;
            color: rgba(255,255,255,0.3);
            letter-spacing: 0.06em;
            background: var(--surface);
            border: 1px solid var(--rim);
            border-radius: 100px;
            padding: 7px 16px;
            white-space: nowrap;
        }
        .row-count span {
            color: var(--electric);
            font-weight: 600;
        }

        /* ─────────────────────────────────────────────────
           HIGHLIGHT on search match
        ───────────────────────────────────────────────── */
        .search-highlight {
            background: rgba(30,127,255,0.22);
            border-radius: 3px;
            padding: 0 2px;
            color: #fff;
        }

        /* Row fade when filtered out */
        .table tbody tr.hidden-row {
            display: none;
        }

        /* ─────────────────────────────────────────────────
           CUSTOM CURSOR
        ───────────────────────────────────────────────── */
        * { cursor: none !important; }
        #cur-dot, #cur-ring {
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 99999;
            mix-blend-mode: difference;
        }
        #cur-dot {
            width: 7px; height: 7px; background: #fff;
            transform: translate(-50%,-50%);
        }
        #cur-ring {
            width: 34px; height: 34px;
            border: 1px solid rgba(255,255,255,0.55);
            transform: translate(-50%,-50%);
            transition: width 0.3s, height 0.3s, border-color 0.3s;
        }

        /* ─────────────────────────────────────────────────
           SORTABLE COLUMN HEADER INDICATOR
        ───────────────────────────────────────────────── */
        th.sortable {
            cursor: pointer !important;
            user-select: none;
            transition: color 0.2s;
        }
        th.sortable:hover { color: rgba(255,255,255,0.85) !important; }
        th.sortable .sort-icon {
            display: inline-block;
            margin-left: 5px;
            font-size: 0.6rem;
            opacity: 0.35;
            vertical-align: middle;
            transition: opacity 0.2s, color 0.2s;
        }
        th.sortable:hover .sort-icon,
        th.sort-asc .sort-icon,
        th.sort-desc .sort-icon {
            opacity: 1;
            color: var(--electric);
        }

    </style>

    <div class="container-fostrap mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="books-section" style="background: rgba(8, 22, 39, 0.7); border-radius: 15px; padding: 30px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <h2 class="text-white mb-4 font-weight-bold">Available Books</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-borderless" style="color: #d3d3d3;">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">Serial No.</th>
                                        <th scope="col">Books/Journals</th>
                                        <th scope="col">Category</th>
                                        <th scope="col" class="text-center d-none d-lg-table-cell">Preview</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-light">
                                    @forelse($books as $book)
                                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                        <td class="align-middle text-white-50">#{{ $loop->iteration }}</td>
                                        <td class="align-middle font-weight-bold text-white" style="font-size: 1.1rem;">{{ $book->name }}</td>
                                        <td class="align-middle"><span class="text-info">{{ $book->category->name ?? 'Uncategorized' }}</span></td>
                                        <td class="align-middle d-none d-lg-table-cell">
                                            <div class="book-preview-box mx-auto shadow-sm">
                                                @if($book->image)
                                                    <img src="{{ asset('products/' . $book->image) }}" alt="Book Cover">
                                                @else
                                                    <i class="fas fa-image text-white-50"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge {{ $book->quantity > 0 ? 'badge-success' : 'badge-danger' }} px-3 py-2">
                                                {{ $book->quantity }} Left
                                            </span>
                                        </td>
                                        <td class="align-middle text-success font-weight-bold">BDT {{ number_format($book->price, 2) }}</td>
                                        <td class="align-middle small">{{ $book->weight }} gm</td>
                                        <td class="align-middle" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #bbb;">
                                            {{ $book->description }}
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($book->quantity > 0)
                                            <a href="{{ route('user.rent', $book->id) }}" class="btn btn-modern px-4 py-2">
                                                <i class="fas fa-shopping-cart mr-2"></i> Rent
                                            </a>
                                            @else
                                            <button class="btn btn-secondary btn-sm disabled px-3" disabled>Out of Stock</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">No books are currently available in the library portal.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {

        /* ── BLOBS ─────────────────────────────────────── */
        ['blob-a','blob-b'].forEach(c => {
            const el = document.createElement('div');
            el.className = 'blob ' + c;
            document.body.appendChild(el);
        });

        /* ── CUSTOM CURSOR ─────────────────────────────── */
        const dot  = document.createElement('div'); dot.id  = 'cur-dot';
        const ring = document.createElement('div'); ring.id = 'cur-ring';
        document.body.append(dot, ring);
        let mx=0, my=0, rx=0, ry=0;
        document.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
        (function tick() {
            rx += (mx-rx)*0.14; ry += (my-ry)*0.14;
            dot.style.cssText  = `left:${mx}px;top:${my}px`;
            ring.style.cssText = `left:${rx}px;top:${ry}px`;
            requestAnimationFrame(tick);
        })();

        /* ── INJECT TOOLBAR above table ───────────────── */
        const section = document.querySelector('.books-section');
        const tableWrap = section.querySelector('.table-responsive');
        const rows = Array.from(document.querySelectorAll('.table tbody tr'));
        const totalRows = rows.filter(r => r.querySelectorAll('td').length > 1).length;

        const toolbar = document.createElement('div');
        toolbar.className = 'table-toolbar';
        toolbar.innerHTML = `
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Search books, category…" id="bookSearch">
            </div>
            <div class="row-count" id="rowCount">Showing <span>${totalRows}</span> books</div>
        `;
        section.insertBefore(toolbar, tableWrap);

        /* ── LIVE SEARCH + HIGHLIGHT ───────────────────── */
        const searchInput = document.getElementById('bookSearch');
        const rowCountEl  = document.getElementById('rowCount').querySelector('span');

        // Store original text of searchable cells (name, category, desc)
        const searchCols = [1, 2, 7]; // col indices: name, category, description
        rows.forEach(row => {
            row._origCells = {};
            searchCols.forEach(i => {
                const td = row.querySelectorAll('td')[i];
                if (td) row._origCells[i] = td.innerHTML;
            });
        });

        searchInput.addEventListener('input', () => {
            const q = searchInput.value.trim().toLowerCase();
            let visible = 0;

            rows.forEach(row => {
                const tds = row.querySelectorAll('td');
                if (tds.length <= 1) return; // empty state row

                // Restore original HTML first
                searchCols.forEach(i => {
                    if (tds[i] && row._origCells[i] !== undefined) {
                        tds[i].innerHTML = row._origCells[i];
                    }
                });

                if (!q) {
                    row.classList.remove('hidden-row');
                    visible++;
                    return;
                }

                // Check match
                let matched = false;
                searchCols.forEach(i => {
                    if (tds[i] && tds[i].textContent.toLowerCase().includes(q)) matched = true;
                });

                if (matched) {
                    row.classList.remove('hidden-row');
                    visible++;
                    // Highlight matches
                    searchCols.forEach(i => {
                        if (!tds[i]) return;
                        const txt = tds[i].textContent;
                        const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')})`, 'gi');
                        // Only highlight in text nodes, not inside HTML tags
                        const inner = tds[i].innerHTML;
                        // Simple approach: highlight only plain text containers
                        if (!tds[i].querySelector('span, a, i, div')) {
                            tds[i].innerHTML = txt.replace(re, '<mark class="search-highlight">$1</mark>');
                        }
                    });
                } else {
                    row.classList.add('hidden-row');
                }
            });

            rowCountEl.textContent = q ? visible : totalRows;
        });

        /* ── SORTABLE COLUMNS ──────────────────────────── */
        const thead = document.querySelector('.table thead tr');
        const headers = thead.querySelectorAll('th');
        const sortableCols = [0,1,2,4,5]; // serial, name, category, qty, price
        let sortState = { col: -1, dir: 1 };

        sortableCols.forEach(idx => {
            const th = headers[idx];
            if (!th) return;
            th.classList.add('sortable');
            const icon = document.createElement('span');
            icon.className = 'sort-icon';
            icon.innerHTML = '&#8597;';
            th.appendChild(icon);

            th.addEventListener('click', () => {
                const isActive = sortState.col === idx;
                sortState.dir  = isActive ? -sortState.dir : 1;
                sortState.col  = idx;

                // Update icons
                headers.forEach(h => {
                    h.classList.remove('sort-asc','sort-desc');
                    const ic = h.querySelector('.sort-icon');
                    if (ic) ic.innerHTML = '&#8597;';
                });
                th.classList.add(sortState.dir === 1 ? 'sort-asc' : 'sort-desc');
                th.querySelector('.sort-icon').innerHTML = sortState.dir === 1 ? '&#8593;' : '&#8595;';

                const tbody = document.querySelector('.table tbody');
                const sortedRows = Array.from(tbody.querySelectorAll('tr')).sort((a, b) => {
                    const ta = a.querySelectorAll('td')[idx]?.textContent.trim() || '';
                    const tb = b.querySelectorAll('td')[idx]?.textContent.trim() || '';
                    // Numeric sort for price/qty/serial
                    const na = parseFloat(ta.replace(/[^0-9.]/g,''));
                    const nb = parseFloat(tb.replace(/[^0-9.]/g,''));
                    if (!isNaN(na) && !isNaN(nb)) return (na - nb) * sortState.dir;
                    return ta.localeCompare(tb) * sortState.dir;
                });
                sortedRows.forEach(r => tbody.appendChild(r));
            });
        });

        /* ── BOOK COVER 3D TILT ───────────────────────── */
        document.querySelectorAll('.book-preview-box').forEach(box => {
            box.addEventListener('mousemove', e => {
                const r = box.getBoundingClientRect();
                const x = (e.clientX - r.left) / r.width  - 0.5;
                const y = (e.clientY - r.top)  / r.height - 0.5;
                box.style.transform = `scale(1.18) rotateY(${x*22}deg) rotateX(${-y*16}deg)`;
            });
            box.addEventListener('mouseleave', () => {
                box.style.transform = '';
            });
        });

        /* ── RENT BUTTON RIPPLE ───────────────────────── */
        document.querySelectorAll('.btn-modern').forEach(btn => {
            btn.addEventListener('click', e => {
                const r = btn.getBoundingClientRect();
                const rp = document.createElement('span');
                rp.style.cssText = `
                    position:absolute; border-radius:50%;
                    background:rgba(255,255,255,0.22);
                    transform:scale(0);
                    animation:ripOut 0.55s ease forwards;
                    left:${e.clientX-r.left-18}px;
                    top:${e.clientY-r.top-18}px;
                    width:36px; height:36px;
                    pointer-events:none;
                `;
                btn.appendChild(rp);
                setTimeout(() => rp.remove(), 600);
            });
        });

        /* ── ROW ENTRANCE observer ─────────────────────── */
        // Re-trigger animation on sort (add/remove class)
        const tbodyObserver = new MutationObserver(() => {
            document.querySelectorAll('.table tbody tr').forEach((tr, i) => {
                tr.style.animationDelay = (i * 0.04) + 's';
                tr.style.animation = 'none';
                tr.offsetHeight; // reflow
                tr.style.animation = '';
            });
        });
        tbodyObserver.observe(document.querySelector('.table tbody'), { childList: true });

        /* One-time keyframe injection */
        const s = document.createElement('style');
        s.textContent = `@keyframes ripOut { to { transform:scale(6); opacity:0; } }`;
        document.head.appendChild(s);

    });
    </script>
</x-user-layout>