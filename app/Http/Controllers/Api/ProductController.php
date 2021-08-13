<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\ProductDetail;
use App\Models\User;
use App\Utils\Response\ResponseFormatter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function browse(Request $request){
        try {

            if($request->q){
                $product = ProductDetail::where("name", "like", "%{$request->q}%")->paginate(10)->toArray() ;
            } else {
                $product = ProductDetail::paginate(10)->toArray();
            }

            $new_data = [] ;
            $tag_list = [] ;
            foreach ($product['data'] as $index => $value) {
                $value['tag'] = json_decode($value['tag']) ;
                $value['photo'] = json_decode($value['photo']) ;

                $value['user'] = User::where('id', $value['user_id'])->first();
                $value['discount'] = null ;
                $value['discounted'] = 0 ;
                if(isset($value['discount_id'])){
                    $value['discount'] = Discount::where('id', $value['discount_id'])->first();
                    switch ($value['discount']['type']) {
                        case 'fixed':
                            $value['discounted'] = $value['price'] - $value['discount']['value'] ;
                            break;

                        default:
                            $value['discounted'] = $value['price'] - ( $value['price'] * $value['discount']['value'] / 100);
                            break;
                    }
                }

                $tag_list = [...$tag_list, ...$value['tag']] ;

                $new_data[$index] = $value;
            }

            $product['data'] = $new_data ;

            return ResponseFormatter::success("Success", [
                'product' => $product,
                'tag_list' => $tag_list,
            ]);
        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }
}
