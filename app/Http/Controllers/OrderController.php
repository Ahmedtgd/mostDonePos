<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name')
        ->get();

       
        $orders = Order::with('products')->get();
        $orders = Order::with(['products', 'user'])->paginate(5);
/* 
       $user = auth()->user();
        $user_name = auth()->user()->name;
        $orders = auth()->user()->name;
*/
        $products =Product::all();
        $users =User::all();

return view('orders.index', compact('orders','products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();
    $products = Product::with('categories')->get();
    $products2 = Product::all();

    return view('orders.create', compact('products', 'products2', 'categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_ids' => 'required|array',
            'product_quantities' => 'required|array',
            'product_quantities.*' => 'numeric|min:1',
        ]);
    
        $userId = auth()->user()->id;
    
        $order = new Order([
            'deliveryStatus' => $request->deliveryStatus,
            'vehicle' => $request->vehicle,
            'customer_id' => $request->customer_id,
            'user_id' => $userId, // Associate the authenticated user with the order
        ]);
    
        $order->save();
    
        $productIds = $request->input('product_ids');
        $productQuantities = $request->input('product_quantities');
    
        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $productQuantities[$index];
    
            // Associate product with order
            $order->products()->attach($product, ['quantity' => $quantity]);
    
            // Update product quantity
            $product->quantity -= $quantity;
            $product->save();
        }
    
        return redirect()->route('orders.index');
    }
    /**  
     * Display the specified resource.
     */
    public function show(Order $order)
    {
       return view('orders.index', compact('order'));     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
{
    $products = Product::all();
    return view('orders.edit', compact('order', 'products'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            // Validate other fields
        ]);
    
        $order->deliveryStatus = $request->deliveryStatus;
        $order->vehicle = $request->vehicle;
        $order->customer_id = $request->customer_id;
        $order->user_id = $request->user_id;
    
        $productIds = $request->input('product_ids');
        $productQuantities = $request->input('product_quantities');
    
        // Detach all existing products from the order
        $order->products()->detach();
    
        foreach ($productIds as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $productQuantities[$index];
    
            if ($product && $quantity > 0) {
                // If the quantity is greater than 0, check if it's within the available quantity
                if ($product->quantity >= $quantity) {
                    // Attach the product to the order with the specified quantity
                    $order->products()->attach($product, ['quantity' => $quantity]);
                    $product->quantity -= $quantity;
                    $product->save();
                } else {
                    // Handle insufficient quantity scenario
                    // You can show an error message or take appropriate action
                }
            }
        }
    
        $order->save();
    
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }



}
