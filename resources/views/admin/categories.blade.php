<x-admin-layout>
    <style>
        .categories-section h2 {
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .categories-card {
            background: rgba(8, 22, 39, 0.8);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .table { color: #d3d3d3; }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        .modal-content {
            background: #0a1a2e !important;
            border: 1px solid rgba(30, 144, 255, 0.3) !important;
            border-radius: 15px !important;
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
        }

        .modal-header { border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .modal-footer { border-top: 1px solid rgba(255, 255, 255, 0.1); }

        .modal-body .form-control {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
            height: 50px;
        }

        .btn-modern {
            background: var(--primary-blue);
            color: #fff;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-modern:hover {
            background: #187bcd;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.4);
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="categories-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Book Categories</h2>
                    <button type="button" class="btn btn-modern shadow-sm" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus-circle mr-2"></i> Add New Category
                    </button>
                </div>
                
                <div class="categories-card">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="10%"># SN</th>
                                    <th width="60%">Category Name</th>
                                    <th width="15%" class="text-center">Action</th>
                                    <th width="15%" class="text-center">Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="font-weight-bold text-white-50">{{ $loop->iteration }}</td>
                                    <td class="text-white font-weight-bold" style="font-size: 1.1rem;">{{ $category->name }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Careful! Deleting this might affect books in this category. Continue?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3" style="border-radius: 20px;">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-warning px-3" style="border-radius: 20px;" data-toggle="modal" data-target="#updateModal{{ $category->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
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

    @foreach($categories as $category)
    <div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">Update Category Name</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <label class="text-white-50 small">New Category Title</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-modern">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-white">Create New Category</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="text-white-50 small">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Science Fiction" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Dismiss</button>
                        <button type="submit" class="btn btn-modern">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>