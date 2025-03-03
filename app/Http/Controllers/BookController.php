<?php
namespace App\Http\Controllers;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Requests\BookSearchRequest;
class BookController extends Controller
{  
    public function index()
    {
        $perPage=request()->per_page ?? 1;
        $books=Book::paginate( $perPage);
        return response()->json([
            'data'=>BookResource::collection($books),
            'meta'=>[
                'total'=>$books->total(),
                'current_page'=>$books->currentPage(),
                 'per_page'=>$books->perPage(),
                'last_page'=>$books->lastPage(),
            ],
            'links' => [
                'first' => $books->url(1),
                'last' => $books->url($books->lastPage()),
                'prev' => $books->previousPageUrl(),
                'next' => $books->nextPageUrl(),
            ]
        ]);     
    }
    public function search(BookSearchRequest $request)
    {
    $searchTerm = $request->get('query', '');
    $perPage = $request->get('per_page', 2);
    $books = Book::where('title', 'like', "%$searchTerm%")
        ->orWhere('description', 'like', "%$searchTerm%")
        ->orWhere('price', 'like', "%$searchTerm%")
        ->paginate($perPage);
    return response()->json($books);
    } 
}
