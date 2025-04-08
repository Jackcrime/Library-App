<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Bookmark;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookActionController extends Controller
{
    public function favorite($bookId)
    {
        // Validate that the book exists
        $book = Buku::findOrFail($bookId); // Throws a 404 if not found

        $userId = Auth::id();
        $favorite = Favorite::where('user_id', $userId)->where('buku_id', $bookId)->first();

        if ($favorite) {
            // If already favorited, delete it
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // If not favorited, create it
            Favorite::create(['user_id' => $userId, 'buku_id' => $bookId]);
            return response()->json(['status' => 'added']);
        }
    }

    public function bookmark($bookId)
    {
        // Validate that the book exists
        $book = Buku::findOrFail($bookId); // Throws a 404 if not found

        $userId = Auth::id();
        $bookmark = Bookmark::where('user_id', $userId)->where('buku_id', $bookId)->first();

        if ($bookmark) {
            // If already bookmarked, delete it
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // If not bookmarked, create it
            Bookmark::create(['user_id' => $userId, 'buku_id' => $bookId]);
            return response()->json(['status' => 'added']);
        }
    }

    public function myFavorites()
    {
        // Get the user's favorite books
        $favorites = Favorite::where('user_id', Auth::id())->with('buku')->get();
        return view('guest.book.favorite', compact('favorites'));
    }

    public function myBookmarks()
    {
        // Get the user's bookmarked books
        $bookmarks = Bookmark::where('user_id', Auth::id())->with('buku')->get();
        return view('guest.book.bookmark', compact('bookmarks'));
    }
}