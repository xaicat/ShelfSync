<x-admin-layout>
    <style>
        .books-section h2 {
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Glassmorphism Table Container */
        .table-container {
            background: rgba(8, 22, 39, 0.8);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .table { color: #d3d3d3; margin-bottom: 0; }
        .table thead th {
            border-top: none;
            border-bottom: 2px solid rgba(30, 144, 255, 0.3);
            color: #fff;
            text-transform: uppercase;
            font-size: 0.8rem;
            white-space: nowrap;
        }

        .table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
            padding: 12px 8px;
        }

        /* FIXED PREVIEW BOX */
        .book-preview-box {
            width: 60px;  /* Fixed Width */
            height: 80px; /* Fixed Height (Book Aspect Ratio) */
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* This crops the image to fill the box without stretching */
            transition: transform 0.3s ease;
        }

        .book-preview-box:hover img {
            transform: scale(1.1);
        }

        /* Badge Styling */
        .qty-badge {
            background: rgba(30, 144, 255, 0.1);
            color: var(--primary-blue);
            border: 1px solid rgba(30, 144, 255, 0.3);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .btn-action {
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 15px;
            text-transform: uppercase;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="books-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-book-open mr-2 text-primary"></i>Books / Journals</h2>
                    <a href="{{ route('admin.books.create') }}" class="btn btn-modern">
                        <i class="fas fa-plus mr-2"></i>Add New Book
                    </a>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th class="text-center">Preview</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Weight</th>
                                    <th>Description</th>
                                    <th class="text-center">Delete</th>
                                    <th class="text-center">Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td class="text-white-50">#{{ $loop->iteration }}</td>
                                    <td class="text-white font-weight-bold">{{ $book->name }}</td>
                                    <td><span class="text-info small">{{ $book->category->name ?? 'N/A' }}</span></td>
                                    <td class="text-center">
                                        <div class="book-preview-box mx-auto shadow-sm">
                                            @if($book->image)
                                                <img src="{{ asset('products/' . $book->image) }}" alt="Cover">
                                            @else
                                                <i class="fas fa-image text-white-50"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td><span class="qty-badge">{{ $book->quantity }}</span></td>
                                    <td class="text-success font-weight-bold">৳{{ number_format($book->price, 0) }}</td>
                                    <td class="small">{{ $book->weight }}g</td>
                                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.85rem;" title="{{ $book->description }}">
                                        {{ $book->description }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-action">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-outline-warning btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>