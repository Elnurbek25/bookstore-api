<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    
    public function index()
    {
        $perPage=request()->per_page ?? 10;
        $books=Book::paginate( $perPage);
        return BookResource::collection($books);
        
    }

    public function search(Request $request)
    {
    $searchTerm = $request->get('query', '');
    $perPage = $request->get('per_page', 20);
    $books=Book::paginate( $perPage);
    $books = Book::where('title', 'like', "%$searchTerm%")
        ->orWhere('description', 'like', "%$searchTerm%")
        ->orWhere('price', 'like', "%$searchTerm%")
        ->paginate($perPage);
    return response()->json($books);
    }

    
    
}
