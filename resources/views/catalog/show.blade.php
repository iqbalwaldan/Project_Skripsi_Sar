<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama_produk }} - Product Detail</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>{{ $product->nama_produk }}</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $product->gambar) }}" class="img-fluid" alt="{{ $product->nama_produk }}">
            </div>
            <div class="col-md-6">
                <p><strong>Price:</strong> {{ $product->harga }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="topping">Topping:</label>
                        <select name="topping" id="topping" class="form-control">
                            @foreach($topings as $topping)
                                <option value="{{ $topping->id }}">{{ $topping->nama_toping }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
