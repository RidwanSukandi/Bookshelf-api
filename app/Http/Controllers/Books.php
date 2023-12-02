<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksUpdateRequest;
use App\Http\Requests\RequestBooks;
use App\Http\Resources\BooksByIdResource;
use App\Http\Resources\BooksCollection;
use App\Http\Resources\GetBooksResource;
use App\Http\Resources\ResponseBooks;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\isEmpty;

class Books extends Controller
{

    public function index()
    {
        $data = DB::table('books')->get();

        if (empty($data)) {
            throw new HttpResponseException(response([
                'status' => "success",
                'data' => [
                    'books' => []
                ]
            ], 200));
        }

        return GetBooksResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestBooks $request)
    {
        $data = $request->validated();

        if ($data['read_page'] > $data['page_count']) {
            throw new HttpResponseException(response([
                'errors' => [
                    'status' =>  'fail',
                    'message' => "Gagal menambahkan buku. read_page tidak boleh lebih besar dari page_ount"
                ]
            ], 400));
        }

        $data['finished'] = ($data['page_count'] === $data['read_page']);

        $data['reading'] = $data['finished'];

        $id = DB::table('books')->insertGetId($data);

        $result = DB::table('books')->where('idbooks', '=', $id)->first();

        return (new ResponseBooks($result))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::table('books')->where('idbooks', $id)->get();

        if ($data->isEmpty()) {
            throw new HttpResponseException(response([
                'errors' => [
                    'status' =>  'fail',
                    'message' => "Buku tidak ditemukan"
                ]
            ], 404));
        }

        return BooksByIdResource::collection($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksUpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $data = DB::table('books')->where('idbooks', '=', $id)->first();

        if (!$data) {
            throw new HttpResponseException(response([
                'errors' => [
                    'status' =>  'fail',
                    'message' => "Gagal memperbarui buku. Id tidak ditemukan"
                ]
            ], 404));
        }

        if ($validated['read_page'] > $validated['page_count']) {
            throw new HttpResponseException(response([
                'errors' => [
                    'status' =>  'fail',
                    'message' => "Gagal menambahkan buku. read_page tidak boleh lebih besar dari page_ount"
                ]
            ], 400));
        }

        $data->finished = ($data->page_count === $data->read_page);

        $data->reading = $data->finished;


        $validated = Arr::add($validated, 'finished', $data->finished === true ? 1 : 0);
        $validated = Arr::add($validated, 'reading', $data->reading === true ? 1 : 0);


        $data = DB::table('books')->where('idbooks', $id)->update($validated);


        return response()->json([
            'status' => "success",
            'message' => "Buku berhasil diperbarui"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DB::table('books')->where('idbooks', $id)->first();

        if (!$data) {
            throw new HttpResponseException(response([
                'errors' => [
                    'status' =>  'fail',
                    'message' => "Buku gagal dihapus. Id tidak ditemukan"
                ]
            ], 400));
        }

        $data = DB::table('books')->where('idbooks', '=', $id)->dumpRawSql();

        return response()->json([
            'status' => "success",
            'message' => "Buku berhasil dihapus"
        ], 200);
    }
}
