<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Str;
use App\Mail\AuthMail;

class UserControlController extends Controller
{
    public function index(Request $request)
{
    $katakunci = $request->katakunci;

    // Buat query dasar dengan join.
    $query = User::join('roles', 'users.roles_id', '=', 'roles.id')
                 ->select('users.*', 'roles.name as role_name');

    // Jika kata kunci disediakan, tambahkan sebagai filter.
    if(strlen($katakunci)) {
        $query->where('users.email', 'like', "%$katakunci%");
    }

    // Urutkan dan ambil semua hasil query.
    $uc = $query->orderBy('users.roles_id', 'asc')->get();

    return view('user.user', compact('uc'));
}




    // public function create()
    // {
    //     return view('user.create');
    // }

    // public function store(Request $request)
    // {
    //     $str = Str::random(100);

    //     $request->validate([
    //         'name' => 'required|min:4',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //     ], [
    //         'name.required' => 'Full Name Wajib Di isi',
    //         'name.min' => 'Bidang Full Name minimal harus 4 karakter.',
    //         'email.required' => 'Email Wajib Di isi',
    //         'email.email' => 'Format Email Invalid',
    //         'email.unique' => 'Email sudah digunakan',
    //         'password.required' => 'Password Wajib Di isi',
    //         'password.min' => 'Password minimal harus 6 karakter.',
    //     ]);

    //     if ($request->hasFile('gambar')) {
    //         $gambar_file = $request->file('gambar');
    //         $nama_foto = date('ymdhis') . "." . $gambar_file->getClientOriginalExtension();
    //         $gambar_file->move(public_path('picture/accounts'), $nama_foto);
    //         $gambar = $nama_foto;
    //     } else {
    //         $gambar = "user.jpeg";
    //     }

    //     $accounts = User::create([
    //         'name' => $request->fullname,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'verify_key' => $str,
    //     ]);

    //     $details = [
    //         'nama' => $accounts->fullname,
    //         'role' => 'user',
    //         'datetime' => now()->format('Y-m-d H:i:s'),
    //         'website' => 'Laravel10 - Pendaftaran melalui SMTP + Multiuser + CRUD + Sweetalert',
    //         'url' => 'http://' . request()->getHttpHost() . "/" . "verify/" . $accounts->verify_key,
    //     ];

    //     Mail::to($request->email)->send(new AuthMail($details));

    //     Session::flash('success', 'User berhasil ditambahkan, Harap verifikasi akun sebelum digunakan.');

    //     return redirect('/usercontrol');
    // }

    public function edit($id) 
    {
        $uc = User::where('email', $id)->first();
        return view('user.edit')->with('uc', $uc);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required'=>'Nama wajib diisi',
            'role.required'=>'Role wajib diisi',
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);
        $uc = [
            'name'=>$request->name,
            'role'=>$request->role,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ];
        User::where('email', $id)->update($uc);
       return redirect()->to('user')->with('success', 'Berhasil melakukan update data akun');
    }

    public function destroy($id)
    {
        User::where('email', $id)->delete();
        return redirect()->to('user')->with('success', 'Berhasil menghapus data akun');
    }
}