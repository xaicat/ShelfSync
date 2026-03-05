<x-admin-layout>
    <style>
        .member-section h2 {
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Glassmorphism Card for Table */
        .member-card {
            background: rgba(8, 22, 39, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .table {
            color: #d3d3d3;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid rgba(30, 144, 255, 0.3);
            color: #fff;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
            padding: 15px 10px;
        }

        /* User Icon Styling - Switched to Icon */
        .user-avatar {
            width: 48px;
            height: 48px;
            background: rgba(30, 144, 255, 0.2);
            color: var(--primary-blue);
            border: 1px solid rgba(30, 144, 255, 0.4);
            border-radius: 12px; /* Square-ish rounded look */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .member-name-cell {
            display: flex;
            align-items: center;
        }

        /* Improved Info Stack */
        .member-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .status-badge {
            background: rgba(40, 167, 69, 0.1);
            color: #2ecc71;
            border: 1px solid rgba(46, 204, 113, 0.3);
            padding: 1px 8px;
            border-radius: 4px; /* Matches the new avatar style */
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            width: fit-content;
            letter-spacing: 0.5px;
        }
    </style>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-10">
            <div class="member-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-users-cog mr-2"></i>Registered Members</h2>
                    <span class="badge badge-info px-3 py-2 shadow-sm" style="border-radius: 20px; background: var(--primary-blue);">
                        Total Students: {{ $users->count() }}
                    </span>
                </div>
                
                <div class="member-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="35%">Member Details</th>
                                    <th width="25%">Email Address</th>
                                    <th width="30%">Residential Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td class="text-white-50 font-weight-bold">#{{ $user->id }}</td>
                                    <td>
                                        <div class="member-name-cell">
                                            <div class="user-avatar shadow-sm">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                            <div class="member-info">
                                                <div class="text-white font-weight-bold" style="font-size: 1.05rem;">
                                                    {{ $user->name }}
                                                </div>
                                                <span class="status-badge">Student Member</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-info">
                                            <i class="fas fa-envelope mr-2 small opacity-50"></i>{{ $user->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="max-width: 250px; color: #bbb; line-height: 1.4; font-size: 0.9rem;">
                                            <i class="fas fa-map-marker-alt mr-2 small text-danger opacity-75"></i>
                                            {{ $user->address ?? 'No Address Provided' }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-25"></i>
                                        No registered members found in the library database.
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
</x-admin-layout>