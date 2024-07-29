<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Cabang;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            sprintf('role:%s|%s', RoleEnum::Administrator->value, RoleEnum::CentralHead->value)
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::with('jabatan');

        if (auth()->user()->jabatan?->role_name != RoleEnum::CentralHead->value) {
            $query->where('id_cabang', auth()->user()->id_cabang);
        }

        $users = $query->latest()->paginate();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userRole = auth()->user()->jabatan?->role_name;
        $cabang = [];
        $jabatanKepala = Jabatan::firstWhere('role_name', RoleEnum::CentralHead->value);

        if ($userRole == RoleEnum::Administrator->value) {
            $jabatan = Jabatan::whereNot('role_name', RoleEnum::CentralHead->value)->get();
        } else {
            $cabang = Cabang::all();
            $jabatan = Jabatan::all();
        }

        return view('user.create', compact('jabatan', 'cabang', 'jabatanKepala'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_jabatan' => 'required|exists:tb_jabatan,id_jabatan',
            'id_cabang' => 'nullable|exists:tb_cabang,id_cabang',
        ]);

        $jabatan = Jabatan::findOrFail($request->id_jabatan);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_jabatan' => $request->id_jabatan,
        ]);

        if (
            auth()->user()->jabatan?->role_name != RoleEnum::CentralHead->value
        ) {
            $user->id_cabang = auth()->user()->id_cabang;
        } elseif ($jabatan?->role_name != RoleEnum::CentralHead->value) {
            if (! $request->filled('id_cabang')) {
                return redirect()->route('users.index')->with('error', 'Cabang wajib diisi.');
            }

            $user->id_cabang = $request->id_cabang;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userRole = auth()->user()->jabatan?->role_name;
        $cabang = [];
        $jabatanKepala = Jabatan::firstWhere('role_name', RoleEnum::CentralHead->value);

        if ($userRole == RoleEnum::Administrator->value) {
            $jabatan = Jabatan::whereNot('role_name', RoleEnum::CentralHead->value)->get();
        } else {
            $cabang = Cabang::all();
            $jabatan = Jabatan::all();
        }

        return view('user.edit', compact('user', 'jabatan', 'cabang', 'jabatanKepala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::CentralHead->value &&
            auth()->user()->id_cabang != $user->id_cabang
        ) {
            abort('403');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'id_jabatan' => 'required|exists:tb_jabatan,id_jabatan',
            'id_cabang' => 'nullable|exists:tb_cabang,id_cabang',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_jabatan = $request->id_jabatan;

        $jabatan = Jabatan::findOrFail($request->id_jabatan);

        if (
            auth()->user()->jabatan?->role_name != RoleEnum::CentralHead->value
        ) {
            $user->id_cabang = auth()->user()->id_cabang;
        } elseif ($jabatan?->role_name != RoleEnum::CentralHead->value) {
            if (! $request->filled('id_cabang')) {
                return redirect()->route('users.index')->with('error', 'Cabang wajib diisi.');
            }

            $user->id_cabang = $request->id_cabang;
        } else {
            $user->id_cabang = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (
            auth()->user()->jabatan?->role_name != RoleEnum::CentralHead->value &&
            auth()->user()->id_cabang != $user->id_cabang
        ) {
            abort('403');
        }

        if ($user->id == auth()->user()->id) {
            return redirect()->route('users.index')->with('error', 'Cannot delete self account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
