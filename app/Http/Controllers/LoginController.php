<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoginRequest;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;

class LoginController extends Controller
{

    /** @var  UsersRepository */
    private $usersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function store(CreateLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $this->usersRepository->pushCriteria(new RequestCriteria($request));
        $user = $this->usersRepository->findWhere([
            'email' => $email,
        ])->first();

        $checked = Hash::check($password, $user['password']);
        if (isset($user) && $checked) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return view('auth.login', compact('email'))
            ->withErrors(['email' => 'username or password invalid']);
    }

    /**
     * Store a newly created Roles in storage.
     *
     * @param CreateRolesRequest $request
     *
     * @return Response
     */
    public function destroy(Request $requst)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('index');
    }
}
