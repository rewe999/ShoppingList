<?php

namespace App\Http\Controllers;

use App\Models\ListContent;
use Illuminate\Http\Request;

class ListContentController extends Controller
{

    public function index()
    {
        $authUser = auth('api')->user()->id;
        $list = ListContent::with(['item.category','productList'])
            ->whereHas('productList',function ($q) use ($authUser) {
                $q->where('user_id',$authUser);
            })
            ->get();

        return response()->json($list->map(function ($content){
            return [
                "id" => $content->id,
                "item" => [
                    "id" => $content->item->id,
                    "name" => $content->item->name,
                ],
                "category" => [
                    "id" => $content->item->category->id,
                    "name" => $content->item->category->name,
                ],
                "list_name" => $content->productList->name
            ];
        }));
//        return $list;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $listContent = new ListContent();
        $listContent->product_list_id = $request->list_id;
        $listContent->item_id = $request->item_id;
        $listContent->save();

        if($listContent){
            return response()->json([
                "success" => "List contend added"
            ]);
        }

        return response()->json([
            "error" => "List contend error"
        ]);

    }
}
