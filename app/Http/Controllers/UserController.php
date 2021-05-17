<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;
use App\Product;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();

        return view('users.mypage' , compact('user'));
    }

    //ユーザー情報編集操作のコントローラー-----------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

                $user->name = $request->input('name') ? $request->input('name') : $user->name;
                $user->email = $request->input('email') ? $request->input('email') : $user->email;
                $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
                $user->address = $request->input('address') ? $request->input('address') : $user->address;
                $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
                $user->update();

                return redirect()->route('mypage');
    }

    public function edit_address()
    {
        $user = Auth::user();

        return view('users.edit_address' , compact('user'));
    }

    public function edit_password()
    {
        return view('users.edit_password');
    }

    public function update_password(Request $request)
    {
        $user = Auth::user();

        if ($request->input('password') ===$request->input('confirm_password')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else {
            return redirect()->route('mypage.edit_password');
        }

        return redirect()->route('mypage');
    }


    public function favorite()
    {
        $user = Auth::user();

        $favorites = $user->favorites((Product::class))->get();

        return view('users.favorite', compact('favorites'));
    }
}
