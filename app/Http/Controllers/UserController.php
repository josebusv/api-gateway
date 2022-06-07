<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return an instance of User
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }
    /**
     * Return an specific User
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'  => 'required|max:255',
            'email'  => 'required|max:255|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
        ];
        
        $this->validate($request, $rules);

        $fields = $request->all();

        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);

    }
    /**
     * Return an instance of User
     * @return Illuminate\Http\Response
     */
    public function show($user)
    {
        
        $user = User::findOrFail($user);

        return $this->validResponse($user);
    }
    /**
     * Update the information of an existing User
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {
        $rules = [
            'name'  => 'max:255',
            'email'  => 'max:255|email|unique:users,email,' .$user,
            'password'  => 'min:8|confirmed',
        ];
        
        $this->validate($request, $rules);
        $user = User::findOrFail($user);
        if($request->has('password'))
        {
            $user->password = Hash::make($request->password);
        }

        $user->fill($request->all());

        if ($user->isClean()){
            return $this->errorResponse('At least one vlue must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();

        return $this->validResponse($user, Response::HTTP_CREATED);
    }
    /**
     * Remove an instance of User
     * @return Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::findOrFail($user);

        $user->delete();

        return $this->validResponse($user);
    }
    /**
     * Identifies the curren User
     * @return Illuminate\Http\Response
     */
    public function me(Request $request)
    {
    
        return $this->validResponse($request->user());
    }
}
