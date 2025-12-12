<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
    /**
     * Ensure admin is logged in before rendering a page.
     */
    private function ensureAuthenticated()
    {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        return null;
    }

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
if ($redirect = $this->ensureAuthenticated()) {
return $redirect;
}

return view('admin.dashboard');
}
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');

        return redirect('/'); // redirect to main website homepage
    }

    // MANAGE CATEGORIES
    public function categories()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        return view('admin.categories');
    }

    // MANAGE ORDERS
    public function orders()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        return view('admin.orders');
    }

    // CONTACT MESSAGES
    public function messages()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }
        return redirect()->route('admin.messages');
    }

}
