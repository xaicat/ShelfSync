<x-user-layout>
    <style>
        .books-section h2 {
            color: #fff;
            font-weight: 700;
        }

        /* Consistent Glassmorphism for the table body */
        .table-responsive {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            padding: 10px;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid rgba(30, 144, 255, 0.3) !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: #fff;
        }

        /* FIXED PREVIEW BOX - Matching Admin Style */
        .book-preview-box {
            width: 60px;  /* Fixed Width */
            height: 80px; /* Fixed Height (Portrait) */
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .book-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Prevents ugly stretching */
        }

        .book-preview-box:hover {
            transform: scale(1.1);
            border-color: var(--primary-blue);
        }

        .btn-modern {
            background: var(--primary-blue);
            color: white;
            border-radius: 30px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        .btn-modern:hover {
            background: #187bcd;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 144, 255, 0.4);
            color: white;
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
</x-user-layout>