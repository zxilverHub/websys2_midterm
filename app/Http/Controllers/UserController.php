<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|min:2|max:15',
            'email' => 'required',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        if ($validate) {
            $username = $request->input('username');
            $email = $request->input('email');
            $password = $request->input('password');
            $role = $request->input('role');
            DB::insert("INSERT INTO users VALUES(null, ?, ?, ?, ?, now())", [$username, $email, $password, $role]);
            $users = DB::select("SELECT * FROM users WHERE email = ? and password = ?", [$email, $password]);
            Session::put("id", $users[0]->id);
            return $this->home();
        }

        return back();
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validate) {
            $email = $request->input('email');
            $password = $request->input('password');
            $users = DB::select("SELECT * FROM users WHERE email = ? and password = ?", [$email, $password]);

            if (count($users) > 0) {
                Session::put("id", $users[0]->id);
                return $this->home();
            } else {
                return back()->with('failed', 'Incorrect email or password');
            }
        }

        return back();
    }

    public function delete($id)
    {
        $user_id = session('id');
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        $users = DB::select("SELECT * FROM users WHERE id = ?", [$user_id]);
        Session::put("id", $users[0]->id);
        return $this->home();
    }

    public function editpage($id)
    {
        $users = DB::select("SELECT * FROM users WHERE id = ?", [$id]);
        return view('edit', ['user' => $users[0]]);
    }

    public function edit(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|min:2|max:15',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validate) {
            $id = $request->input('id');
            $username = $request->input('username');
            $email = $request->input('email');
            $password = $request->input('password');
            DB::update("UPDATE users SET username = ?, password = ?, email = ? WHERE id = ?", [$username, $password, $email, $id]);

            return $this->home();
        }
    }

    public function home($username = null)
    {
        $user_id = session('id');

        $query = "SELECT * FROM users";
        $params = [];

        if ($username !== null) {
            $query .= " WHERE username LIKE ?";
            $params[] = "%{$username}%";
        }

        $query .= " LIMIT 5";
        $allusers = DB::select($query, $params);

        $users = DB::select("SELECT * FROM users WHERE id = ?", [$user_id]);

        if (!empty($users)) {
            Session::put("id", $users[0]->id);
            return view('home', ['users' => $allusers, 'user' => $users[0]]);
        } else {
            return redirect()->route('login')->with('error', 'User not found. Please log in again.');
        }
    }

    public function homesearch(Request $request)
    {
        $username = $request->input('search');
        return $this->home($username);
    }
}
