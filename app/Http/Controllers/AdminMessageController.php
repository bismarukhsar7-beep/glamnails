<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    private function ensureAuthenticated()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $messages = ContactMessage::orderByDesc('created_at')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        $message = ContactMessage::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        if ($redirect = $this->ensureAuthenticated()) {
            return $redirect;
        }

        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.messages')->with('success', 'Message deleted.');
    }
}















