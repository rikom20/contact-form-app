<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせ入力画面の表示
     */
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    /**
     * お問い合わせ確認画面の表示（バリデーション通過後）
     */
    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();
        
        // 電話番号を結合して保持
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];
        
        // カテゴリ名を取得
        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }

    /**
     * お問い合わせデータの保存とサンクスページ遷移
     */
    public function store(Request $request)
    {
        // 修正ボタンが押された場合、入力画面へ戻る
        if ($request->has('back')) {
            return redirect()->route('contact.index')->withInput();
        }

        // DBに保存
        Contact::create([
            'category_id' => $request->category_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'building' => $request->building,
            'detail' => $request->detail,
        ]);

        return redirect()->route('contact.thanks');
    }

    /**
     * サンクスページの表示
     */
    public function thanks()
    {
        return view('thanks');
    }
}