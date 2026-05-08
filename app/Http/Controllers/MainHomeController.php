<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MainHomeController extends Controller
{
    public function welcome()
    {
        $sliderproducts = DB::table('test')
            ->orderBy('price', 'DESC')
            ->limit(4)
            ->get();
            
        return view('welcome', [
            'sliderproducts' => $sliderproducts
        ]);
    }
    
    public function catalog(Request $request)
    {
    $query = DB::table('test');
    
    if ($request->has('sort_year')) {
        if ($request->sort_year == 'new') {
            $query->orderBy('year', 'DESC');
        } elseif ($request->sort_year == 'old') {
            $query->orderBy('year', 'ASC');
        }
    }
    
    if ($request->has('sort_rating')) {
        if ($request->sort_rating == 'high') {
            $query->orderBy('price', 'DESC');
        } elseif ($request->sort_rating == 'low') {
            $query->orderBy('price', 'ASC');
        }
    }
    
    
    if (!$request->has('sort_year') && !$request->has('sort_rating')) {
        $query->orderBy('name', 'ASC');
    }
    
    $myproducts = $query->get();
    
    return view('catalog', [
        'myproducts' => $myproducts
    ]);
    } 

    public function where()
    {
        return view('where');
    }
    
    public function product($id)
    {
        $product = DB::table('test')->where('id', $id)->limit(1)->get();
        
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.product_id', $id)
            ->orderBy('comments.created_at', 'DESC')
            ->select('comments.*', 'users.name as user_name')
            ->get();
        
        return view('product', [
            'myproducts' => $product,
            'comments' => $comments
        ]);
    }
    
    public function review($id)
    {
        $product = DB::table('test')->where('id', $id)->first();
        
        if (!$product) {
            abort(404);
        }
        
        return view('review', ['product' => $product]);
    }
    
    public function panel(){
        $yy = DB::table('test')->get();
        $tt = DB::table('test')->orderBy('id', 'DESC')->first();
        return view('panel', ['yy'=> $yy, 'tt'=> $tt]);
    }
    
    public function del(Request $gg){
        DB::table('test')->where('id', $gg->id)->delete();
        return redirect()->back();
    }
    
    public function redact(Request $gg){
        DB::table('test')->where('id', $gg->id)->update(['name' => $gg->name]);
        return redirect()->back();
    }

    public function add_img(Request $request){
        $img = $request->file('image');
        $typeImg = $img->extension();
        $uniqName = Str::uuid();
        $nameImg = $uniqName.'.'.$typeImg;
        $path = 'images';
        $img->move(public_path($path), $nameImg);

        DB::table('test')->insert([
            'name' => $request->name_product,
            'price' => $request->price_product,
            'about' => $request->about_product,
            'year' => $request->year_product,
            'review' => $request->review_product,
            'img' => $nameImg,
        ]);

        return redirect(url()->previous())->with(['msg' => 'Фильм добавлен!']);
    }

    public function add_comment(Request $request)
    {
    $request->validate([
        'product_id' => 'required|integer',
        'comment_text' => 'required|string|min:3|max:1000',
    ]);
    
    $exists = DB::table('comments')
        ->where('user_id', auth()->id())
        ->where('product_id', $request->product_id)
        ->exists();
    
    if ($exists) {
        return redirect()->back()->with('comment_msg', 'Вы уже оставили отзыв на этот фильм!');
    }
    
    DB::table('comments')->insert([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'comment_text' => $request->comment_text,
    ]);
    
    return redirect()->back()->with('comment_msg', 'Отзыв добавлен!');
    }
    public function edit_comment(Request $request)
    {
    $request->validate([
        'comment_id' => 'required|integer',
        'comment_text' => 'required|string|min:3|max:1000',
    ]);
    
    DB::table('comments')
        ->where('id', $request->comment_id)
        ->where('user_id', auth()->id())
        ->update(['comment_text' => $request->comment_text]);
    
    return redirect()->back()->with('comment_msg', 'Отзыв обновлён!');
    }
    public function profile()
{
    $user = DB::table('users')->where('id', auth()->id())->first();
    
    $comments = DB::table('comments')
        ->join('test', 'comments.product_id', '=', 'test.id')
        ->where('comments.user_id', auth()->id())
        ->orderBy('comments.created_at', 'DESC')
        ->select('comments.*', 'test.name as product_name', 'test.id as product_id')
        ->get();
    
    return view('profile', [
        'user' => $user,
        'comments' => $comments
    ]);
}

    public function profile_update(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'nullable|string|max:255',
    ]);
    
    DB::table('users')
        ->where('id', auth()->id())
        ->update([
            'name' => $request->name,
            'surname' => $request->surname,
        ]);
    
    return redirect()->back()->with('profile_msg', 'Профиль обновлён!');
    }
    public function top()
    {
    $topProducts = DB::table('test')
        ->orderBy('price', 'DESC')
        ->limit(5)
        ->get();
    
    return view('top', [
        'topProducts' => $topProducts
    ]);
    }
    public function delete_comment(Request $request)
    {
    DB::table('comments')
        ->where('id', $request->comment_id)
        ->where('user_id', auth()->id())
        ->delete();
    
    return redirect()->back()->with('comment_msg', 'Отзыв удалён!');
    }   
    public function edit($id)
{
    $product = DB::table('test')->where('id', $id)->first();
    
    if (!$product) {
        abort(404);
    }
    
    $products = DB::table('test')->orderBy('name', 'ASC')->get();
    
    return view('edit', [
        'product' => $product,
        'products' => $products
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:1|max:10',
        'year' => 'nullable|integer',
        'about' => 'required|string',
        'review' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
    ]);
    
    $data = [
        'name' => $request->name,
        'price' => $request->price,
        'year' => $request->year,
        'about' => $request->about,
        'review' => $request->review,
    ];
    
    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $nameImg = Str::uuid() . '.' . $img->extension();
        $img->move(public_path('images'), $nameImg);
        $data['img'] = $nameImg;
    }
    
    DB::table('test')->where('id', $id)->update($data);
    
    return redirect()->route('panel')->with('msg', 'Фильм отредактирован!');
}
}

