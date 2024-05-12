<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Product Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #8e44ad !important;
            z-index: 1000; /* Higher z-index */
        }
        .navbar-brand {
            color: #ffffff !important;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .main-content {
            padding: 20px;
            margin-top: 80px;
        }
        .form-container {
            max-width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        .invalid-feedback {
            color: red;
        }
        #newCategoryInput {
            display: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Seller: {{ Auth::user()->name }}</a>
    <!-- Add more Navbar content here -->
</nav>

<div class="main-content">
    <div class="container">
        <div class="form-container">
            <h2>Add Product</h2>
            <form action="{{ route('addProd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control @error('productName') is-invalid @enderror" id="productName" name="productName" value="{{ old('productName') }}" placeholder="Enter product name">
                    @error('productName')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <select class="form-control @error('productCategory') is-invalid @enderror" id="productCategory" name="productCategory">
                        <option value="">Select or Add New Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category }}">{{ $category->category }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control mt-2" id="newCategoryInput" name="newCategory" placeholder="Enter New Category">
                    @error('productCategory')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="productPrice">Price</label>
                    <input type="number" class="form-control @error('productPrice') is-invalid @enderror" id="productPrice" name="productPrice" value="{{ old('productPrice') }}" placeholder="Enter product price">
                    @error('productPrice')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="productStock">Stock</label>
                    <input type="number" class="form-control @error('productStock') is-invalid @enderror" id="productStock" name="productStock" value="{{ old('productStock') }}" placeholder="Enter product stock">
                    @error('productStock')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea class="form-control @error('productDescription') is-invalid @enderror" id="productDescription" name="productDescription" rows="3" placeholder="Enter product description">{{ old('productDescription') }}</textarea>
                    @error('productDescription')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="productImage">Image</label>
                    <input type="file" class="form-control-file @error('productImage') is-invalid @enderror" id="productImage" name="productImage">
                    @error('productImage')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('productCategory').addEventListener('change', function () {
            var newCategoryInput = document.getElementById('newCategoryInput');
            if (this.value === '') {
                newCategoryInput.style.display = 'block';
            } else {
                newCategoryInput.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
