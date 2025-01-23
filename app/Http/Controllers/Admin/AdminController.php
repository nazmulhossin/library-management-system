<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function addBook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'author' => 'required|max:255',
            'publisher' => 'nullable|max:255',
            'publication_date' => 'nullable|date|before_or_equal:today',
            'edition' => 'nullable|max:5',
            'isbn' => 'nullable|max:13',
            'pages' => 'nullable|integer',
            'category' => 'required|max:100',
            'total_copies' => 'required|integer|min:1',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            // Handle file upload for cover_image
            $file = $request->file('cover_image');
            $filePath = $file->store('books', 'public'); // Store the file in the 'storage/app/public/books' directory

            // Insert book into the database
            DB::table('books')->insert([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'publication_date' => $validated['publication_date'],
                'edition' => $validated['edition'],
                'isbn' => $validated['isbn'],
                'pages' => $validated['pages'],
                'category' => $validated['category'],
                'total_copies' => $validated['total_copies'],
                'available_copies' => $validated['total_copies'],
                'cover_image' => $filePath,
                'uploaded_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin/book-list');
    }


    public function showBooks()
    {
        $books = DB::table('books') ->get();

        return view('admin/books', compact('books'));
    }


    public function showPendingUsers()
    {
        $pendingUsers = DB::table('users')
            ->select('user_id', 'name', 'registration_number', 'session', 'email', 'phone_number', 'image')
            ->where('status', 'Pending')
            ->get();

        return view('admin/pending-members', compact('pendingUsers'));
    }

    public function approveMember($id)
    {
        DB::table('users')
            ->where('user_id', $id)
            ->update(['status' => 'Approved']);
    
        return redirect()->back();
    }
    
    public function declineMember($id)
    {
        DB::table('users')
            ->where('user_id', $id)
            ->delete();
    
        return redirect()->back();
    }


    public function showMembers()
    {
        $members = DB::table('users')
            ->select('user_id', 'name', 'registration_number', 'session', 'email', 'phone_number', 'image')
            ->where('status', 'Approved')
            ->where('user_type', '!=', 'Admin')
            ->get();

        return view('admin/members', compact('members'));
    }
}
