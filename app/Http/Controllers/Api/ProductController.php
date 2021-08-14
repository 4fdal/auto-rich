<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartOrder;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Utils\Response\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function browse(Request $request)
    {
        try {

            $request->validate([
                'q' => ['nullable'],
                'category' => ['nullable', 'numeric', 'exists:category_products,id'],
                'my_product' => ['nullable']
            ]);

            $product = new ProductDetail();

            if ($request->q) {
                $product = $product->where("name", "like", "%{$request->q}%");
            }

            if ($request->category) {
                $product = $product->join("products", "products.id", "=", "product_details.id")->where('products.category_id', $request->category);
            }


            if ($request->my_product) {
                $user = User::getAuth();
                if (isset($user)) {
                    $user_id = $user->id;
                    $product = $product->where('product_details.user_id', $user_id);
                }
            }


            $product = $product->paginate(10)->toArray();

            $new_data = [];
            $tag_list = [];
            foreach ($product['data'] as $index => $value) {
                $value['tag'] = json_decode($value['tag']);
                $value['photo'] = json_decode($value['photo']);

                $value['user'] = User::where('id', $value['user_id'])->first();
                $value['discount'] = null;
                $value['discounted'] = 0;
                if (isset($value['discount_id'])) {
                    $value['discount'] = Discount::where('id', $value['discount_id'])->first();
                    switch ($value['discount']['type']) {
                        case 'fixed':
                            $value['discounted'] = $value['price'] - $value['discount']['value'];
                            break;

                        default:
                            $value['discounted'] = $value['price'] - ($value['price'] * $value['discount']['value'] / 100);
                            break;
                    }
                }

                $tag_list = [...$tag_list, ...$value['tag']];

                $new_data[$index] = $value;
            }

            $product['data'] = $new_data;

            return ResponseFormatter::success("Success", [
                'product' => $product,
                'tag_list' => $tag_list,
            ]);
        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }

    public function read($id)
    {
        try {

            $product = ProductDetail::where('id', $id)->first();
            if ($product) {
                $product->product;
                $product->user;

                if (isset($product->discount_id)) {
                    $product->discount;
                }
            }

            return ResponseFormatter::success("Success", [
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return ResponseFormatter::failed($e);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'name' => ['required', 'string'],
                'nameDetail' => ['required', 'string'],
                'discount_id' => ['nullable'],
                'description' => ['required'],
                'tag' => ['required', function ($att, $val, $fail) {
                    if (json_decode($val) == null) {
                        $fail('format array not found');
                    }
                }],
                'photo' => ['required', 'image'],
                'price' => ['required', 'numeric'],
                'quantity' => ['required', 'numeric'],
                'length' => ['required', 'numeric'],
                'width' => ['required', 'numeric'],
                'height' => ['required', 'numeric'],
            ]);

            $user = User::getAuth();
            $user_id = $user->id;

            $product_save = [
                'name' => $request->name,
                'user_id' => $user_id,
            ];

            $product = Product::create($product_save);

            $product_detail_save = [
                'name' => $request->nameDetail,
                'discount_id' => $request->discount_id,
                'user_id' => $user_id,
                'product_id' => $product->id,
                'description' => $request->description,
                'tag' => $request->tag,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ];

            if ($request->hasFile('photo')) {
                $photo = [];
                if (is_array($request->file('photo'))) {
                    foreach ($request->file('photo') as $key => $file_photo) {
                        $photo[$key] = $file_photo->store("/product/{$user_id}");
                    }
                } else {
                    $photo[] = $request->file('photo')->store("/product/{$user_id}");
                }
                $photo = json_encode($photo);
                $product_detail_save['photo'] = $photo;
            }

            $product_detail = ProductDetail::create($product_detail_save);
            $product_detail->tag = json_decode($product_detail->tag);
            $product_detail->photo = collect(json_decode($product_detail->photo))->map(function ($item) {
                return env("APP_URL") . "/storage/" . $item;
            });

            DB::commit();

            return ResponseFormatter::success("Success", [
                'product' => $product,
                'product_detail' => $product_detail,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::failed($e);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'detail_product_id' => ['required', 'numeric', 'exists:product_details,id'],
                'name' => ['required', 'string'],
                'nameDetail' => ['required', 'string'],
                'discount_id' => ['nullable'],
                'description' => ['required'],
                'tag' => ['required', function ($att, $val, $fail) {
                    if (json_decode($val) == null) {
                        $fail('format array not found');
                    }
                }],
                'photo' => ['nullable', 'image'],
                'price' => ['required', 'numeric'],
                'quantity' => ['required', 'numeric'],
                'length' => ['required', 'numeric'],
                'width' => ['required', 'numeric'],
                'height' => ['required', 'numeric'],
            ]);

            $user = User::getAuth();
            $user_id = $user->id;

            $product_detail = ProductDetail::where('user_id', $user_id)->where('id', $request->detail_product_id)->first();
            $product_id = $product_detail->product_id;

            $product_detail->tag = json_decode($product_detail->tag);
            $product_detail->photo = collect(json_decode($product_detail->photo))->map(function ($item) {
                return env("APP_URL") . "/storage/" . $item;
            });

            $product_save = [
                'name' => $request->name,
            ];

            $product = Product::where('id', $product_id)->first();
            $product->update($product_save);

            $product_detail_save = [
                'name' => $request->nameDetail,
                'discount_id' => $request->discount_id,
                'description' => $request->description,
                'tag' => $request->tag,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ];

            if ($request->hasFile('photo')) {

                Storage::delete($product_detail->photo);

                $photo = [];
                if (is_array($request->file('photo'))) {
                    foreach ($request->file('photo') as $key => $file_photo) {
                        $photo[$key] = $file_photo->store("/product/{$user_id}");
                    }
                } else {
                    $photo[] = $request->file('photo')->store("/product/{$user_id}");
                }
                $photo = json_encode($photo);
                $product_detail_save['photo'] = $photo;
            }

            $product_detail->update($product_detail_save);


            DB::commit();

            return ResponseFormatter::success("Success", [
                'product' => $product,
                'product_detail' => $product_detail,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::failed($e);
        }
    }

    public function delete(Request $request)
    {

        DB::beginTransaction();
        try {

            $request->validate([
                'detail_product_id' => ['required', 'numeric', 'exists:product_details,id'],
            ]);

            $user = User::getAuth();
            $user_id = $user->id;

            $product_detail = ProductDetail::where('id', $request->detail_product_id)->where('user_id', $user_id)->delete();

            DB::commit();

            return ResponseFormatter::success("Success");
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::failed($e);
        }
    }
}
