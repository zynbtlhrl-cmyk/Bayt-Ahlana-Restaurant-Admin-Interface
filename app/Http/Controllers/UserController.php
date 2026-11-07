<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = User::where('id', '!=', 1);

    // البحث
    if ($request->filled('search')) {

        $query->where(function ($q) use ($request) {

            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');

        });
    }

    $users = $query->get();

    return view('users.index', compact('users'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return redirect()->back()->with('success', 'تم حذف المستخدم');
}


public function apiRegister(Request $request)
{
    $request->merge([
        'email' => strtolower(trim($request->email ?? '')),
    ]);

    $validator = \Illuminate\Support\Facades\Validator::make(
        $request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:login,email',
            'password' => 'required|string|min:6',
        ]
    );

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'تأكد من صحة البيانات',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('flutter-app')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'تم إنشاء الحساب بنجاح',
        'user' => $user->only(['id', 'name', 'email']),
        'token' => $token,
    ], 201);
}

public function apiLogin(Request $request)
{
    $request->merge([
        'email' => strtolower(trim($request->email ?? '')),
    ]);

    $validator = \Illuminate\Support\Facades\Validator::make(
        $request->all(),
        [
            'email' => 'required|email',
            'password' => 'required|string',
        ]
    );

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'يرجى إدخال Gmail وكلمة المرور',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Gmail أو كلمة المرور غير صحيحة',
        ], 401);
    }

    $token = $user->createToken('flutter-app')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'تم تسجيل الدخول بنجاح',
        'user' => $user->only(['id', 'name', 'email']),
        'token' => $token,
    ], 200);
}

}
