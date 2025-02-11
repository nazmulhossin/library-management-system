<?php

namespace App\Http\Controllers;

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
                'borrow_requests.request_date'
            )
            ->orderBy('borrow_requests.request_id', 'desc')
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
            ->whereNull('borrowed_books.return_date')
            ->select(
                'borrowed_books.*',
                'books.title as book_title',
                'books.author as book_author',
                'books.cover_image as book_cover'
            )
            ->orderBy('borrowed_books.borrow_id', 'desc')
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
            ->orderBy('borrowed_books.return_date', 'desc')
            ->paginate(10);

        return view('user/returned-book-list', compact('returnedBooks'));
    }

    public function showAllBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);

        // Pass the paginated books to the view
        return view('pages/all-books', compact('books'));
    }

    public function showCSEBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', 'CSE')
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);

        // Pass the paginated books to the view
        return view('pages/cse-books', compact('books'));
    }

    public function showEEEBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', 'EEE')
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);

        // Pass the paginated books to the view
        return view('pages/cse-books', compact('books'));
    }

    public function showProgrammingBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', 'Programming')
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);

        // Pass the paginated books to the view
        return view('pages/programming-books', compact('books'));
    }

    public function showMachineLearningBooks()
    {
        $user_id = session('user')->user_id;

        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', 'Machine Learning')
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);


        return view('pages/machine-learning-books', compact('books'));
    }

    public function showMathematicsBooks()
    {
        $user_id = session('user')->user_id;
    
        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', 'Mathematics')
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);
    
        return view('pages/mathematics-books', compact('books'));
    }
    
    public function showBookDetails($book_id)
    {
        $user_id = session('user')->user_id;

        // Fetch book details with requested/borrowed status
        $book = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('books.book_id', $book_id)
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                        IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->first();

        // If book not found, return 404
        if (!$book) {
            abort(404);
        }

        // Fetch books from the same category, excluding the current book
        $sameCategoryBooks = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('category', $book->category)
            ->where('books.book_id', '!=', $book_id)
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->limit(10)
            ->get();

        return view('pages/book', compact('book', 'sameCategoryBooks'));
    }

    public function searchBooks(Request $request)
    {
        $query = $request->input('query');
        $user_id = session('user')->user_id;
        
        // Fetch books matching title, author, category or description
        $books = DB::table('books')
            ->leftJoin('borrow_requests', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrow_requests.book_id')
                    ->where('borrow_requests.user_id', '=', $user_id);
            })
            ->leftJoin('borrowed_books', function ($join) use ($user_id) {
                $join->on('books.book_id', '=', 'borrowed_books.book_id')
                    ->where('borrowed_books.user_id', '=', $user_id);
            })
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('category', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->select(
                'books.*',
                DB::raw('IF(borrow_requests.request_id IS NOT NULL, "Requested", 
                         IF(borrowed_books.borrow_id IS NOT NULL AND borrowed_books.return_date IS NULL, "Borrowed", "Available")) AS status')
            )
            ->paginate(20);

        return view('pages/search-results', compact('books', 'query'));
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
