<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
// LOGIN
public function login(Request $request)
{
$admin = Admin::where('email', $request->email)
->where('password', $request->password)
->first();

if ($admin) {
session(['admin_id' => $admin->id]); // store session
return redirect('/admin/dashboard');
}

return back()->with('error', 'Invalid login details');
}

// DASHBOARD PAGE
public function dashboard()
{
if (!session()->has('admin_id')) {
return redirect('/admin/login');
}

return view('admin.dashboard');
}
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');

        return redirect('/'); // redirect to main website homepage
    }

}
