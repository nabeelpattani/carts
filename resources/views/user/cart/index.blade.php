@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shopping Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>item Name</th>
                    <th>Item Price</th>
                    <th>Item Quantity</th>
                </tr>
            </thead>
            <tbody id="cart-item">
                @foreach ($cartitems as $cartitem)
                    <tr data-id="{{ $cartItem->id }}">
                        <td>{{ $cartitem->product->productName }}</td>
                        <td>{{ $cartitem->product->price }}</td>
                        <td>{{ $cartitem->quantity }}</td>

                        <td>
                            <button class="btn btn-warning update-item" data-id="{{ $cartItem->id }}">Update</button>
                            <button class="btn btn-warning delete-item" data-id="{{ $cartItem->id }}">Delete</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Add Item</h2>
        <form id="add-item-form">
            <div class="form-group">
                <label for="product">Product</label>

                <select name="product_id" id="product" class="form-control">
                    @foreach (App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="form-group">
                <label for ="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Add to cart</button>
        </form>

    </div>

    <script>
        document.getElementById('add-item-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let formdata = new FormData(this);
            fetch('{{ route('cart.store') }}' {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formdata
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    location.reload
                }
            });
        });

        document.querySelectorAll('.update-item').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getattribute('data-id');
                let quantity = prompt('Enter new quantity:');
                if (quantity) {
                    fetch('{{ route('cart.update', '') }}/' + id, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': application / json
                        },
                        body: json.stringify({
                            quantity
                        })
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            location.reload();
                        }

                    });
                }
            });
        });
    </script>
