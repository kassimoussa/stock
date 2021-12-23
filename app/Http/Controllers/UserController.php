<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direction;
use Mail;
use App\Mail\ResetPass;

class UserController extends Controller
{
    public function login(){
        return view('auth.connexion');
    }
    
    public function register(){
        $directions = Direction::all();
        return view('auth.register', compact('directions'));
    }

    public function create()
    {
        $directions = Direction::all();
        if (session('userLevel') == '2') {
            return view('2.sih.admin.addUser', compact('directions'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.addUser', compact('directions'));
        }
        
    }

    public function store(Request $request){
        //validate the input
        $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users',
            "password" => 'required|min:8|max:16',
            "level" => 'required',
            "direction" => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = $request->level;
        $user->direction = $request->direction;
        $query = $user->save();

        if($query){
            return back()->with('success', 'Ajout réussi !!!');
        }else{
            return back()->with('fail', 'Echec de l\'ajout !!!');
        }

        //return redirect()->route('register');

    }

    public function check(Request $request){
        //validate the input
        $request->validate([
            "email" => 'required|email',
            "password" => 'required|min:8|max:16',
            

        ]); 

        $user = User::where('email', '=', $request->email)->first();
        if($user){
            if($request->password = $user->password){
                $request->session()->put('Loggeduser', $user->id);
                $request->session()->put('userLevel', $user->level);
                $request->session()->put('username', $user->name);
                $request->session()->put('dir', $user->direction);
                $request->session()->put('service', $user->service);
                return redirect('index');
            }else{
                return back()->with('fail', 'Invalide password');
            }
        }else{
            return back()->with('fail', 'No account found for this email');
        }
    }

    public function index(){
        if(session()->has('Loggeduser')){
            $user = User::where('id', '=', session('Loggeduser'))->first();
          
        }
        if(session('userLevel') == '1'){
            return view('1.index', compact('user'));
        }elseif(session('userLevel') == '2'){ 
            if (session('service') == 'IT HelpDesk') {
                return view('2.sih.index', compact('user'));
            } else {
                return view('2.index', compact('user'));
            } 
            return view('2.index', compact('user'));
        }elseif(session('userLevel') == '3'){
            return view('3.index', compact('user'));
        }elseif(session('userLevel') == '4'){
            return view('4.index', compact('user'));
        }elseif(session('userLevel') == '5'){
            return view('admin.index', compact('user'));
        }        
    }
    public function logout(){
        
        session()->flush();
        return redirect('/');
    }
    public function profile()
    {
        $user = User::where('id', session('Loggeduser'))->first();

        if (session('userLevel') == '1') {
            return view('1.profile', compact('user'));
        } elseif (session('userLevel') == '2') {
            if (session('dir') == 'DSI') {
                return view('2.sih.profile', compact('user'));
            } else {
                return view('2.profile', compact('user'));
            } 
        } elseif (session('userLevel') == '3') {
            return view('3.profile', compact('user'));
        } elseif (session('userLevel') == '4') {
            return view('4.profile', compact('user'));
        } elseif (session('userLevel') == '5') {
            return view('5.profile', compact('user'));
        }
    }
    public function changeprofile(Request $request)
    {

        User::where('id', session('Loggeduser'))
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        return back()->with('success', 'Changement réussi avec succès');
    }

    public function forgot()
    {
        return view('auth.forgot');
    }

    public function resetpassword(Request $request)
    {

        $to_email = $request->email;
        $request->session()->put('reset', $to_email);
        $rand = rand(100000, 999999);
        User::where('email',  $to_email)
            ->update(['reset_pass' => $rand]);
            
        Mail::to($to_email)
            ->later(now()->addSeconds(1), new ResetPass($rand));
        return view('auth.reset', compact('rand'));
    }
    public function reset(Request $request)
    {
        $to_email = session('reset');
        $user = User::where('email', $to_email)->first();
        $rand =  $user->reset_pass;
        $pass1 = $request->password;
        $pass2 = $request->password2;
        if($pass1 == $pass2){
          User::where('email',  $to_email)
            ->update(['password' => $pass1]);  
            return redirect('/');
        }
        else{
            return back()->with('fail', 'Le mot de passe ne correspond pas à la verification');
        }
        
    }

    public function admin()
    {
        $user = User::where('id', session('Loggeduser'))->first();

        if (session('userLevel') == '2') {
            return view('2.sih.admin.index');
        } elseif (session('userLevel') == '3') {
            return view('3.admin.index');
        }
    }

    public function list(){
        $users = User::orderBy('level', 'asc')->paginate(10);

        if (session('userLevel') == '2') {
            return view('2.sih.admin.listusers', compact('users'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.listusers', compact('users'));
        }
    }

    public function edit(User $user)
    {
        $directions = Direction::all();
        if (session('userLevel') == '2') {
            return view('2.sih.admin.edituser', compact('user', 'directions'));
        } elseif (session('userLevel') == '3') {
            return view('3.admin.edituser', compact('user', 'directions'));
        }
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return back()->with('success', 'Modification réussie');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Suppression réussie');
    }
   
}
