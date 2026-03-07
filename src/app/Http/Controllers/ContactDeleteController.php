<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactDeleteController extends Controller
{
    public function deleteContact($id)
    {
        // 該当するお問い合わせを削除
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin');
    }
}