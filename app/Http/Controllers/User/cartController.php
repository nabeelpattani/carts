<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->get();
        return view('user.cart.index', compact('cartItems'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        CartItem::create($request->all());
        return response()->json(['success' => true]);
    }
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $cartItem->update($request->all());
        return response()->json(['success' => true]);
    }
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return response()->json(['success' => true]);
    }
}
