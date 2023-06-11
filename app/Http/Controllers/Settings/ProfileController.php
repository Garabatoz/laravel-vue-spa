<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     */
    public function update(Request $request){
        try {
            $user = $request->user();            
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'birthday' => 'required',
                'address' => 'required'

            ]);
    
            $user->update($request->only('name','email','birthday','address'));    
            return response()->json($user);
            
        } catch (\Exception $e) {
            echo "Se produjo un error: " . $e->getMessage();
        }
    }
}