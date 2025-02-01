<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
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

    public function showRequestedBookList()
    {
        $requestedBooks = DB::table('borrow_requests')
            ->join('books', 'borrow_requests.book_id', '=', 'books.book_id')
            ->where('borrow_requests.user_id', session('user')->user_id)
            ->select(
                'books.book_id', 
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover',
                'borrow_requests.request_date')
            ->paginate(5);

        return view('user/requested-book-list', compact('requestedBooks'));
    }

    public function showBorrowedBookList()
    {
        $user_id = session('user')->user_id;
        $user = DB::table('users')->where('user_id', $user_id)->first();

        $borrowedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
            ->where('borrowed_books.user_id', session('user')->user_id)
            ->select(
                'borrowed_books.*',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover'
            )
            ->orderBy('borrowed_books.borrow_date', 'desc')
            ->paginate(10);

        return view('user/borrowed-book-list', compact('borrowedBooks'));
    }

    public function showReturnedBookList()
    {
        $returnedBooks = DB::table('borrowed_books')
            ->join('books', 'borrowed_books.book_id', '=', 'books.book_id')
            ->where('borrowed_books.user_id', session('user')->user_id)
            ->whereNotNull('borrowed_books.return_date') // Book is returned
            ->select(
                'borrowed_books.*',
                'books.book_id as bookID',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover'
            )
            ->paginate(10);

        return view('user/returned-book-list', compact('returnedBooks'));
    }

    public function showAllBooks()
    {
        $user_id = session('user')->user_id;

        // Fetch books with pagination (10 books per page)
        $books = DB::table('books')
            ->leftJoin('borrow_requests', function($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->select('books.*', DB::raw('IF(borrow_requests.request_id IS NOT NULL, 1, 0) AS has_requested'))
            ->paginate(10);

        // Pass the paginated books to the view
        return view('pages/all-books', compact('books'));
    }

    public function showProgrammingBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->where('books.category', 'Programming')
            ->select('books.*', DB::raw('IF(borrow_requests.request_id IS NOT NULL, 1, 0) AS has_requested'))
            ->paginate(10);

        // Pass the paginated books to the view
        return view('pages/programming-books', compact('books'));
    }

    public function showMachineLearningBooks()
    {
        $user_id = session('user')->user_id;
        
        $books = DB::table('books')
            ->leftJoin('borrow_requests', function($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->where('category', 'Machine Learning')
            ->select('books.*', DB::raw('IF(borrow_requests.request_id IS NOT NULL, 1, 0) AS has_requested'))
            ->paginate(10);

        return view('pages/machine-learning-books', compact('books'));
    }

    public function showMathematicsBooks()
    {
        $user_id = session('user')->user_id;
        
        $books = DB::table('books')
            ->leftJoin('borrow_requests', function($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->where('category', 'Mathematics')
            ->select('books.*', DB::raw('IF(borrow_requests.request_id IS NOT NULL, 1, 0) AS has_requested'))
            ->paginate(10);

        return view('pages/mathematics-books', compact('books'));
    }

    public function showBookDetails($book_id)
    {
        $book = DB::table('books')->where('book_id', $book_id)->first();

        // If book not found, return 404
        if (!$book) {
            abort(404);
        }

        return view('pages/book', compact('book'));
    }

    public function borrowRequest(Request $request)
    {
        // Validate the request
        $request->validate([
            'book_id' => 'required|exists:books,book_id|unique:borrow_requests,book_id,NULL,NULL,user_id,' . session('user')->user_id
        ]);
        
        // Insert the borrow request
        DB::table('borrow_requests')->insert([
            'user_id' => session('user')->user_id,
            'book_id' => $request->book_id,
            'request_date' => now(),
            'is_notified' => false,
        ]);
    
        return response()->json(['status' => 'success']); 
    }

    // Method to handle the borrow request cancellation
    public function cancelRequest(Request $request)
    {
        // Check if the user has an existing borrow request for this book
        $existingRequest = DB::table('borrow_requests')
            ->where('user_id', session('user')->user_id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($existingRequest) {
            // Remove the request from the table
            DB::table('borrow_requests')
                ->where('user_id', session('user')->user_id)
                ->where('book_id', $request->book_id)
                ->delete();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }

    public function cancelRequestWithID($book_id)
    {
        // Check if the user has an existing borrow request for this book
        $existingRequest = DB::table('borrow_requests')
            ->where('user_id', session('user')->user_id)
            ->where('book_id', $book_id)
            ->first();

        // Remove the request from the table
        if ($existingRequest) {
            DB::table('borrow_requests')
                ->where('user_id', session('user')->user_id)
                ->where('book_id', $book_id)
                ->delete();

                return redirect()->back()->with('success', 'Borrow request canceled successfully.');
        }
    }
}
