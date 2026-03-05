<x-admin-layout>
    <style>
        .form-section h2 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Themed Input Fields */
        .form-section .form-control {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: #fff !important;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            height: auto;
        }

        /* Fix for Select dropdown */
        .form-section select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            line-height: 1.5;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            padding-right: 2.5rem;
        }

        /* CLEANER BROWSE BUTTON & FILE INPUT */
        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            margin-bottom: 0;
        }

        .custom-file-label {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            color: rgba(255, 255, 255, 0.6) !important;
            border-radius: 8px !important;
            padding: 10px 15px !important;
            height: auto !important;
            cursor: pointer;
        }

        .custom-file-label::after {
            content: "Browse" !important;
            background-color: var(--primary-blue) !important;
            color: white !important;
            border-left: none !important;
            border-radius: 0 8px 8px 0 !important;
            padding: 10px 20px !important;
            height: auto !important;
            display: flex;
            align-items: center;
        }

        .form-section .form-control:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: var(--primary-blue) !important;
            box-shadow: 0 0 10px rgba(30, 144, 255, 0.3) !important;
            outline: none;
        }

        /* Label Styling */
        .form-section label {
            color: #e0e0e0;
            font-weight: 500;
            margin-bottom: 8px;
        }

        /* CLEANER IMAGE PREVIEW BOX */
        .preview-container {
            margin-top: 15px;
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 10px;
            display: inline-block;
            background: rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        #imgPreview {
            border-radius: 8px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            max-width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
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
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.4);
        }
    </style>

    <div class="row justify-content-center mt-4">
        <div class="col-lg-10">
            <div class="form-section" style="background: rgba(8, 22, 39, 0.8); border-radius: 15px; padding: 40px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                <h2>Add a New Book</h2>
                
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-left">
                                <label><i class="fas fa-book-open mr-2"></i>Name</label>
                                <input type="text" class="form-control" name="name" required placeholder="Enter book name">
                            </div>
                            
                            <div class="form-group text-left">
                                <label><i class="fas fa-tags mr-2"></i>Select Category</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="" disabled selected>Choose a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-money-bill-wave mr-2"></i>Price (BDT)</label>
                                        <input type="number" class="form-control" name="price" step="0.01" required placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group text-left">
                                        <label><i class="fas fa-weight-hanging mr-2"></i>Weight (g)</label>
                                        <input type="number" class="form-control" name="weight" required placeholder="Weight">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label><i class="fas fa-layer-group mr-2"></i>Available Quantity</label>
                                <input type="number" class="form-control" name="quantity" required placeholder="Quantity">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group text-left">
                                <label><i class="fas fa-align-left mr-2"></i>Book Description</label>
                                <textarea class="form-control" rows="5" name="description" placeholder="Provide details about the book..."></textarea>
                            </div>

                            <div class="form-group text-left">
                                <label><i class="fas fa-image mr-2"></i>Book Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" accept="image/*" id="productImage" onchange="loadFile(event)">
                                    <label class="custom-file-label" for="productImage">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="preview-container">
                                    <p class="text-white-50 small mb-2">Image Preview</p>
                                    <img src="https://via.placeholder.com/120x150?text=Cover+Preview" id="imgPreview" height="150px" width="120px">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-modern btn-block py-3">
                                <i class="fas fa-plus-circle mr-2"></i> Add Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function loadFile(event) {
            var image = document.getElementById('imgPreview');
            image.src = URL.createObjectURL(event.target.files[0]);
            var fileName = event.target.files[0].name;
            var label = event.target.nextElementSibling;
            label.innerText = fileName;
        }
    </script>
</x-admin-layout>