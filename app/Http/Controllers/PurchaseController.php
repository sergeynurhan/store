<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AdminMail;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function purchase(Product $product, Purchase $purchase)
    {
        $user = auth()->user();

        if (!$product)
        {
            return response()->json('Product not found');
        }

        if ($product->stock_balance > 0)
        {
            $product->stock_balance--;
            $product->save();
        }
        
        if ($product->stock_balance <= 0)
        {
            return response()->json('Product is out of stock');
        }

        $product->users()->attach($user->id);

        $admin = User::where('role', 'admin')->first();
        Mail::to($admin->email)->send(new AdminMail($product, $user));

        return response()->json('Purchase successful');
    }
}
