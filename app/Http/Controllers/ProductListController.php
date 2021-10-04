<?php

namespace App\Http\Controllers;

use App\Models\ProductList;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index(){
        $authUser = auth('api')->user()->id;
        $productList =  ProductList::with(['user','listContent.item.category'])
            ->where('user_id',$authUser)
            ->get();

        return response()->json($productList->map(function ($products){
            return [
                "id" => $products->id,
                "name" => $products->name,
                "user" => [
                    "name" => $products->user->name,
                    "email" => $products->user->email
                ],
                "list_content" => $products->listContent->map(function ($item) {
                    return [
                        "id" => $item->id,
                        "name" => $item->item->name,
                        "category_name" => $item->item->category->name
                    ];
                })
            ];
        }));
    }

    public function store(Request $request){
        $listContent = new ProductList();
        $listContent->name = $request->name;
        $listContent->user_id = auth('api')->id();
        $result = $listContent->save();

        if ($result) {
            return response()->json([
                "success" => "Product List added"
            ]);
        } else {
            return response()->json([
                "error" => "Error"
            ]);
        }
    }
}
