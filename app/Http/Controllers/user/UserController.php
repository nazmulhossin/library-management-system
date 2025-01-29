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
    public function showUser($id)
    {
        $user = DB::table('users')->where('username', $id)->first();
        return view('user/my-account', compact('user'));
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
}
