<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
            ->where('due_date', '<', Carbon::today()) // Overdue books
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

        // Check if the user has already borrowed 5 books
        $borrowedCount = DB::table('borrowed_books')
            ->where('user_id', $borrowRequest->user_id)
            ->whereNull('return_date')
            ->count();

        if ($borrowedCount >= 5) {
            return redirect()->back()->with('error', 'User cannot borrow more than 5 books at a time.');
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
        
        // Get the user ID from the registration number
        $user = DB::table('users')->where('registration_number', $reg_no)->first();

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Check if the user has already borrowed 5 books
        $borrowedCount = DB::table('borrowed_books')
            ->where('user_id', $user->user_id)
            ->whereNull('return_date')
            ->count();

        if ($borrowedCount >= 5) {
            return redirect()->back()->with('error', 'User cannot borrow more than 5 books at a time.');
        }

        // Check if the user has already borrowed the same book
        $alreadyBorrowed = DB::table('borrowed_books')
            ->where('user_id', $user->user_id)
            ->where('book_id', $book_id)
            ->whereNull('return_date') // Ensures it checks only active borrowings
            ->exists();

        if ($alreadyBorrowed) {
            return redirect()->back()->with('error', 'User has already borrowed this book.');
        }

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
        $notReturnedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
            ->join('users', 'borrowed_books.user_id', '=', 'users.user_id')
            ->whereNull('borrowed_books.return_date')
            ->where('borrowed_books.due_date', '<', Carbon::today())
            ->select(
                'borrowed_books.*',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover',
                'users.name as user_name',
                'users.registration_number as user_reg_number',
                'users.phone_number as phone_number'
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
        $books = DB::table('books')->orderBy('book_id', 'desc')->get();
        return view('admin/books', compact('books'));
    }

    public function editBook($book_id)
    {
        $book = DB::table('books')->where('book_id', $book_id)->first();
        
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }
    
        return view('admin/edit-book', compact('book'));
    }
    
    public function updateBook(Request $request, $book_id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'edition' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'pages' => 'nullable|integer|min:1',
            'category' => 'required|string',
            'total_copies' => 'required|integer|min:1',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB file
        ]);

        // Retrieve existing book data
        $book = DB::table('books')->where('book_id', $book_id)->first();

        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        // Prepare data for update
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_date' => $request->publication_date,
            'edition' => $request->edition,
            'isbn' => $request->isbn,
            'pages' => $request->pages,
            'category' => $request->category,
            'total_copies' => $request->total_copies,
            'updated_at' => now(),
        ];

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }

            // Store new cover image
            $filePath = $request->file('cover_image')->store('books', 'public');
            $updateData['cover_image'] = $filePath;
        }

        // Update book in the database using Query Builder
        DB::table('books')->where('book_id', $book_id)->update($updateData);

        // Redirect with success message
        return redirect()->route('admin/book-list')->with('success', 'Book updated successfully.');
    }
    
    public function deleteBook($book_id)
    {
        // Check if the book is borrowed
        $isBorrowed = DB::table('borrowed_books')->where('book_id', $book_id)->whereNull('return_date')->exists();
    
        if ($isBorrowed) {
            return redirect()->back()->with('error', 'This book cannot be deleted as it is currently borrowed.');
        }
    
        // Delete the book if it's not borrowed
        $deleted = DB::table('books')->where('book_id', $book_id)->delete();
    
        if (!$deleted) {
            return redirect()->back()->with('error', 'Failed to delete book.');
        }
    
        return redirect()->back()->with('success', 'Book deleted successfully.');
    }

    public function showPendingUsers()
    {
        $pendingUsers = DB::table('users')
            ->select('user_id', 'name', 'registration_number', 'session', 'email', 'phone_number', 'image')
            ->where('status', 'Pending')
            ->get();

        return view('admin/pending-members', compact('pendingUsers'));
    }

    public function approveMember($user_id)
    {
        $member = DB::table('users')->where('user_id', $user_id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        DB::table('users')->where('user_id', $user_id)->update(['status' => 'Approved']);
    
        return redirect()->back()->with('success', 'Member approved successfully.');
    }
    
    public function declineMember($user_id)
    {
        $member = DB::table('users')->where('user_id', $user_id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        if ($member->image) {
            $imagePath = storage_path('app/public/' . $member->image);

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        DB::table('users')->where('user_id', $user_id)->delete();
    
        return redirect()->back()->with('success', 'Member declined successfully.');
    }

    public function showMembers()
    {
        $members = DB::table('users')
            ->select('user_id', 'name', 'title', 'registration_number', 'session', 'email', 'phone_number', 'image')
            ->where('status', 'Approved')
            ->where('user_type', '!=', 'Admin')
            ->get();

        return view('admin/members', compact('members'));
    }

    // Show edit form
    public function editMember($user_id)
    {
        $member = DB::table('users')->where('user_id', $user_id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        return view('admin/edit-member', compact('member'));
    }

    // Update member
    public function updateMember(Request $request, $user_id)
    {
        // Validate input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user_id . ',user_id',
            'phone_number' => 'required|string|regex:/^(1[3-9]\d{8})$/',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max size 2MB
        ]);

        // Get the member details
        $member = DB::table('users')->where('user_id', $user_id)->first();
        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        // Additional validation for students and teachers
        if ($member->user_type === 'Student') {
            $request->validate([
                'reg_number' => 'required|string|max:20',
                'session' => 'required|string',
            ]);
        } else {
            $request->validate([
                'title' => 'required|string|max:30',
                'reg_number' => 'required|string|max:20',
            ]);
        }

        // Prepare updated data
        $updateData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => '0' . $request->input('phone_number'),
        ];

        // Check if member is a Student or Teacher
        if ($member->user_type === 'Student') {
            $updateData['registration_number'] = $request->input('reg_number');
            $updateData['session'] = $request->input('session');
        } else {
            $updateData['title'] = $request->input('title');
            $updateData['registration_number'] = $request->input('teacher_id');
        }

        // Handle Profile Image Upload
        if ($request->hasFile('photo')) {
            // Delete old image if exists
            if ($member->image) {
                Storage::delete('public/' . $member->image);
            }

            // Store new image
            $imagePath = $request->file('photo')->store('photos', 'public');
            $updateData['image'] = $imagePath;
        }

        // Update the member record
        $updated = DB::table('users')->where('user_id', $user_id)->update($updateData);

        if ($updated) {
            return redirect()->route('admin/member-list')->with('success', 'Member updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update member.');
        }
    }

    // Delete member (Prevent deletion if they have borrowed books)
    public function deleteMember($user_id)
    {
        // Check if user has borrowed books
        $borrowedBooks = DB::table('borrowed_books')->where('user_id', $user_id)->whereNull('return_date')->exists();

        if ($borrowedBooks) {
            return redirect()->back()->with('error', 'Cannot delete member. They have borrowed books.');
        }

        // Get member's image path before deleting the record
        $member = DB::table('users')->where('user_id', $user_id)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Member not found.');
        }

        if ($member->image) {
            $imagePath = storage_path('app/public/' . $member->image);

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete member if they have no borrowed books
        $deleted = DB::table('users')->where('user_id', $user_id)->delete();

        if (!$deleted) {
            return redirect()->back()->with('error', 'Failed to delete member.');
        }

        return redirect()->back()->with('success', 'Member deleted successfully.');
    }

    public function changePassword(Request $request)
    {
            // Manually check old password
        if (!$request->has('old_password') || empty($request->old_password)) {
            return response()->json(['errors' => ['The old password is required.']], 422);
        }

        // Manually check new password (min length 8)
        if (!$request->has('new_password') || empty($request->new_password)) {
            return response()->json(['errors' => ['The new password is required.']], 422);
        }

        if (strlen($request->new_password) < 8) {
            return response()->json(['errors' => ['The new password must be at least 8 characters.']], 422);
        }

        // Manually check if the new passwords match (confirmed)
        if (!$request->has('new_password_confirmation') || $request->new_password !== $request->new_password_confirmation) {
            return response()->json(['errors' => ['The new password confirmation does not match.']], 422);
        }

        $user = DB::table('users')->where('user_id', session('user')->user_id)->first();

        // Check if the old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['errors' => ['The old password is incorrect.']], 422);
        }

        // Update the password
        DB::table('users')
            ->where('user_id', $user->user_id)
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_at' => now()
            ]);

        return response()->json(['success' => 'Password changed successfully.']);
    }
}
