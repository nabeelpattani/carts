@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ProductName</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->ProductName }}</td>
                        <td>{{ $product->Price }}</td>
                        <td>{{ $product->Stock }}</td>
                    </tr>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                            style="dispaly:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
