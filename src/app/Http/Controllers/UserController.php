<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    public function showRegister() {
        return view(view: 'register');
    }

    public function showLogin(){
        return view(view: 'login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('profile');
        }

        return back();
    }

    public function register(Request $request){
        $user = User::query()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        Auth::login($user);

        return redirect()->route(route: 'profile');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function profile(){
        return view(view: 'profile');
    }

    // コントローラーの1メソッドとして実装
    public function download()
    {
        // コールバック関数に１行ずつ書き込んでいく処理を記述
        $callback = function () use ($引数) {
            // 出力バッファをopen
            $stream = fopen('php://output', 'w');
            // 文字コードをShift-JISに変換
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // ヘッダー行
            fputcsv($stream, [
            'ID',
            ]);
            // データ
            $companies = User::orderBy('id', 'desc');
            // ２行目以降の出力
        // cursor()メソッドで１レコードずつストリームに流す処理を実現できる。
            foreach ($companies->cursor() as $company) {
                fputcsv($stream, [
                    $company->id,
                ]);
            }
            fclose($stream);
        };
        
        // 保存するファイル名
        $filename = sprintf('company-%s.txt', date('Ymd'));
        
        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];
        
        return response()->streamDownload($callback, $filename, $header);
    }
}
