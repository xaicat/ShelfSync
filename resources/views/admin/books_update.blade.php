<x-admin-layout>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2>Update Existing Product</h2>
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Id</label>
                                <input type="number" readonly class="form-control" value="{{ $book->id }}">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $book->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $book->price }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Weight (gm)</label>
                                <input type="number" class="form-control" name="weight" value="{{ $book->weight }}">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="{{ $book->quantity }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="description">{{ $book->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Update Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="productImage" id="productImage" onchange="loadFile(event)">
                                    <label class="custom-file-label">Choose new file</label>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <img src="{{ $book->image ? asset('products/'.$book->image) : 'https://via.placeholder.com/100' }}" id="imgPreview" height="80px" width="80px">
                            </div>
                            <button type="submit" class="btn btn-modern btn-block">Update Details</button>
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
        }
    </script>
</x-admin-layout>