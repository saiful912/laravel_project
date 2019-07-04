<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function showCart()
    {
        $data = [];
        //page a data include addToCart class ar coding
        $data['cart'] = $cart = session()->has('cart') ? session()->get('cart') : [];
        //sum selected all products by cart
        $data['total'] = array_sum(array_column($data['cart'], 'total_price'));

        return view('frontend.cart', $data);
    }

    public function addToCart(Request $request)
    {
//cart validation
        try {
            $this->validate($request, [
                'product_id' => 'required|numeric',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back();
        }
//product id catch
        $product = Product::findOrFail($request->input('product_id'));

        $unit_price = ($product->sale_price != null && $product->sale_price > 0) ? $product->sale_price : $product->price;
//session a product add kora
        $cart = session()->has('cart') ? session()->get('cart') : [];
//product quantity plus
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $cart[$product->id]['unit_price'];
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'quantity' => 1,
                'unit_price' => $unit_price,
                'total_price' => $unit_price,
            ];

        }

        session(['cart' => $cart]);
        session()->flash('message', $product->title . ' Added to Cart.');

        return redirect()->route('cart.show');
    }

    public function removeToCart(Request $request)
    {
        try {
            $this->validate($request, [
                'product_id' => 'required|numeric',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back();
        }
        $cart = session()->has('cart') ? session()->get('cart') : [];
        unset($cart[$request->input('product_id')]);
        session(['cart' => $cart]);

        session()->flash('message', ' Product remove from your Cart.');

        return redirect()->back();
    }

    public function clearCart()
    {
        session(['cart' => []]);

        return redirect()->back();
    }

    public function checkout()
    {
        $data=[];
        $data['cart'] = $cart = session()->has('cart') ? session()->get('cart') : [];
        //sum selected all products by cart
        $data['total'] = array_sum(array_column($data['cart'], 'total_price'));
        return view('frontend.checkout',$data);
    }
}
