<x-user-layout>
    <div class="container-fostrap mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="books-section" style="background: rgba(8, 22, 39, 0.7); border-radius: 15px; padding: 30px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <h2 class="text-white mb-4 font-weight-bold">My Rented Books</h2>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead style="border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                                    <tr class="text-white text-uppercase" style="font-size: 0.85rem; letter-spacing: 1px;">
                                        <th scope="col">#</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Rent Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-light">
                                    @forelse($rentals as $rental)
                                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle text-white font-weight-bold" style="font-size: 1.1rem;">
                                            {{ $rental->book->name ?? 'Deleted Book' }}
                                        </td>
                                        <td class="align-middle">{{ $rental->created_at->format('d M, Y') }}</td>
                                        <td class="align-middle {{ \Carbon\Carbon::parse($rental->return_date)->isPast() ? 'text-danger font-weight-bold' : 'text-info' }}">
                                            {{ \Carbon\Carbon::parse($rental->return_date)->format('d M, Y') }}
                                        </td>
                                        <td class="align-middle text-center">{{ $rental->quantity }}</td>
                                        <td class="align-middle text-center">
                                            @php
                                                $isOverdue = \Carbon\Carbon::parse($rental->return_date)->isPast();
                                            @endphp
                                            <span class="badge {{ $isOverdue ? 'badge-danger' : 'badge-primary' }} px-3 py-2 shadow-sm" style="border-radius: 20px; font-weight: 600;">
                                                <i class="fas {{ $isOverdue ? 'fa-exclamation-circle' : 'fa-check-circle' }} mr-1"></i>
                                                {{ $isOverdue ? 'Overdue' : 'Active' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-book-open fa-3x mb-3 d-block"></i>
                                            You haven't rented any books yet.
                                        </td>
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

    <style>
        /* Modern hover effect for table rows */
        tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
            transition: 0.3s ease;
        }
        
        .badge-primary {
            background-color: var(--primary-blue) !important;
        }
    </style>
</x-user-layout>