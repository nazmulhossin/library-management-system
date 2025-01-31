<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Count of users
        $totalUsers = DB::table('users')
            ->where('status', 'Approved')
            ->where('user_type', '!=', 'Admin')
            ->count();

        // Count of pending users
        $pendingUsers = DB::table('users')
            ->where('status', 'Pending')
            ->count();

        // Count of books
        $totalBooks = DB::table('books')->count();

        // Count of borrow requests
        $totalRequests = DB::table('borrow_requests')->count();

        // Count of books not returned
        $notReturnedBooks = DB::table('borrowed_books')
            ->whereNull('return_date')
            ->where('due_date', '<', now()) // Overdue books
            ->count();

        return view('admin/dashboard', compact('totalUsers', 'pendingUsers', 'totalBooks', 'totalRequests', 'notReturnedBooks'));
    }

    public function showRequestList()
    {
        $borrowRequests = DB::table('borrow_requests')
            ->join('users', 'borrow_requests.user_id', '=', 'users.user_id')
            ->join('books', 'borrow_requests.book_id', '=', 'books.book_id')
            ->select(
                'borrow_requests.*',
                'users.name as user_name',
                'users.registration_number as user_reg_number',
                'users.image as user_image',
                'books.book_id as book_id',
                'books.title as book_title',
                'books.author as book_author',
                'books.available_copies as books_available_copies',
                'books.cover_image as book_cover_image'
            )
            ->orderBy('borrow_requests.request_date', 'DESC')
            ->get();

        return view('admin/request-list', compact('borrowRequests'));
    }

    public function approveRequest(Request $request, $request_id)
    {
        // Validate the input
        $request->validate([
            'days' => 'required|integer|min:1'
        ]);

        // Fetch the borrow request
        $borrowRequest = DB::table('borrow_requests')
            ->where('request_id', $request_id)
            ->first();

        if (!$borrowRequest) {
            return redirect()->back()->with('error', 'Borrow request not found.');
        }

        // Check if the book is available
        $book = DB::table('books')->where('book_id', $borrowRequest->book_id)->first();
        if (!$book || $book->available_copies < 1) {
            return redirect()->back()->with('error', 'Book is not available.');
        }

        // Calculate the due date based on user input
        $dueDate = Carbon::now()->addDays((int) $request->days);

        // Insert into borrowed_books table
        DB::table('borrowed_books')->insert([
            'user_id' => $borrowRequest->user_id,
            'book_id' => $borrowRequest->book_id,
            'borrow_date' => Carbon::now(),
            'due_date' => $dueDate,
            'return_date' => null,
            'notify_date' => null,
        ]);

        // Decrease available copies of the book
        DB::table('books')
            ->where('book_id', $borrowRequest->book_id)
            ->decrement('available_copies');

        // Delete the borrow request after approval
        DB::table('borrow_requests')->where('request_id', $request_id)->delete();

        return redirect()->back()->with('success', 'Book borrowed successfully.');
    }

    public function getBookAndUserInfo(Request $request)
    {
        $bookId = $request->book_id;
        $regNo = $request->reg_no;

        // Fetch book details
        $book = DB::table('books')->where('book_id', $bookId)->first();
        
        // Fetch user details
        $user = DB::table('users')->where('registration_number', $regNo)->where('status', 'Approved')->first();

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return book and user details
        return response()->json([
            'book' => [
                'book_id' => $book->book_id,
                'title' => $book->title,
                'author' => $book->author,
                'cover_image' => asset('storage/' . $book->cover_image),
                'available_copies' => $book->available_copies
            ],
            'user' => [
                'name' => $user->name,
                'reg_no' => $user->registration_number,
                'image' => asset('storage/' . $user->image)
            ]
        ]);
    }

    public function assignBookManually($book_id, $reg_no, Request $request)
    {
        // Validate the input
        $request->validate([
            'days' => 'required|integer|min:1'
        ]);        

        // Check if the book exists and is available
        $book = DB::table('books')->where('book_id', $book_id)->first();
        if (!$book || $book->available_copies < 1) {
            return redirect()->back()->with('error', 'Book is not available.');
        }

        // Check if the user exists
        $user = DB::table('users')->where('registration_number', $reg_no)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Calculate the due date based on user input
        $dueDate = Carbon::now()->addDays((int) $request->days);

        // Insert into borrowed_books table
        DB::table('borrowed_books')->insert([
            'book_id' => $book_id,
            'user_id' => $user->user_id,
            'borrow_date' => Carbon::now(),
            'due_date' => $dueDate,
            'return_date' => null,
            'notify_date' => null,
        ]);

        // Update available copies in books table
        DB::table('books')->where('book_id', $book_id)->decrement('available_copies');

        // Redirect to issued book list with success message
        return redirect()->route('admin/issued-list');
    }

    public function showIssuedList()
    {
        $issuedBooks = DB::table('borrowed_books')
        ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
        ->join('users', 'borrowed_books.user_id', '=', 'users.user_id')
        ->whereNull('borrowed_books.return_date')
        ->select(
            'borrowed_books.*',            
            'users.name as user_name',
            'users.registration_number as user_reg_number',
            'books.book_id as book_id',
            'books.title as book_title',
            'books.author as book_author',
            'books.cover_image as book_cover_image'
        )
        ->orderBy('borrowed_books.borrow_date', 'desc') // Show latest issued books first
        ->get();

        return view('admin/issued-list', compact('issuedBooks'));
    }

    public function receiveReturnedBook($borrow_id)
    {
        // Update return_date to current timestamp
        DB::table('borrowed_books')
            ->where('borrow_id', $borrow_id)
            ->update([
                'return_date' => Carbon::now(),
            ]);

        // Increase available copies in books table
        DB::table('books')
            ->where('book_id', function ($query) use ($borrow_id) {
                $query->select('book_id')->from('borrowed_books')->where('borrow_id', $borrow_id);
            })
            ->increment('available_copies');

        return redirect()->back()->with('success', 'Book return accepted successfully.');
    }

    public function showNotReturnedBooks()
    {
        $today = Carbon::today();

        $notReturnedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
            ->join('users', 'borrowed_books.user_id', '=', 'users.user_id')
            ->whereNull('borrowed_books.return_date')
            ->where('borrowed_books.due_date', '<', $today)
            ->select(
                'borrowed_books.*',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover',
                'users.name as user_name',
                'users.registration_number as user_reg_number'
            )
            ->orderBy('borrowed_books.due_date', 'asc') // Oldest due date first
            ->get();

        return view('admin/not-returned-list', compact('notReturnedBooks'));
    }

    public function showReturnedBooks()
    {
        $returnedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
            ->join('users', 'borrowed_books.user_id', '=', 'users.user_id')
            ->whereNotNull('borrowed_books.return_date') // Book is returned
            ->select(
                'borrowed_books.*',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover_image',
                'users.name as user_name',
                'users.registration_number as user_reg_number'
            )
            ->orderBy('borrowed_books.return_date', 'desc') // Latest returned books first
            ->get();

        return view('admin/returned-list', compact('returnedBooks'));
    }
    
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

    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed', // Confirmed checks if new_password == confirm_password
        ]);

        $user = DB::table('users')->where('user_id', session('user')->user_id)->first();

        // Check if the old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The old password is incorrect.']);
        }

        // Update the password
        DB::table('users')
            ->where('user_id', $user->user_id)
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
