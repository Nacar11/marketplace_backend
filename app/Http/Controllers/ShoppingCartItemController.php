<?php

namespace App\Http\Controllers;
use App\Http\Requests\ShoppingCartItemRequest;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;

class ShoppingCartItemController extends Controller
{

    public function getCartItemByID($id)
    {
        return ShoppingCartItem::with('variationOptions')->find($id);
    }
    public function __invoke()
    {
        return ShoppingCartItem::with('variationOptions')->get();
    }
    public function addToCart(ShoppingCartItemRequest $request)
{
    $user = auth()->user();
    $cart = $user->shoppingCart;
    $cartId = $cart->id;

    $validatedData = $request->validated();

    $shoppingCartItem = new ShoppingCartItem([
        'cart_id' => $cartId,    
        'qty' => $validatedData['qty'],
        'product_item_id' => $validatedData['product_item_id'],
    ]);
    $shoppingCartItem->save();

    $variationOptionIds = $validatedData['variation_options'] ?? [];
    $shoppingCartItem->variationOptions()->attach($variationOptionIds);

    $shoppingCartItem->load('variationOptions');
    return $shoppingCartItem;
}
    }
        