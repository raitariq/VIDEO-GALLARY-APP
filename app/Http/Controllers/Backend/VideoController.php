<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;



class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.modal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'producer' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'age_rating' => 'required|string|max:10',
        'video' => 'required|mimes:mp4,mov,avi,webm|max:5120', // max 50MB
        ]);
    
        $path = $request->file('video')->store('videos', 'public');

        // Save all data to DB
        Video::create([
            'title' => $request->title,
            'publisher' => $request->publisher,
            'producer' => $request->producer,
            'genre' => $request->genre,
            'age_rating' => $request->age_rating,
            'file_path' => $path,
            'user_id' => auth()->user()->id
        ]);
    
        return redirect()->route('video.index')->with('success', 'Video uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::find($id);
        return view('videos.modal',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'producer' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'age_rating' => 'required|string|max:10',
           // 'video' => 'required|mimes:mp4,mov,avi,webm|max:5120', // max 50MB
            ]);
        if($request->hasFile('video')){
            $path = $request->file('video')->store('videos', 'public');
        }
            // Save all data to DB
            $video = Video::find($request->id);
            $video->update([
                'title' => $request->title,
                'publisher' => $request->publisher,
                'producer' => $request->producer,
                'genre' => $request->genre,
                'age_rating' => $request->age_rating,
                'file_path' => $request->hasFile('video') ? $path : $video->file_path,
            ]);
        
            return redirect()->route('video.index')->with('success', 'Video Detail Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
                
            Video::where(['id' => $id])->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => "Successfully Deleated.."
            ], JsonResponse::HTTP_OK);   
        }catch(Exception $e){
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   
        } 
    }
    public function datatable(){
        $videos = Video::query()->where('user_id',auth()->user()->id)->latest()->get();
        return Datatables::of($videos)
            ->addColumn('date', function ($videos) {
                return Carbon::parse($videos->created_at)->format('d M Y');
            })
            ->addColumn('actions', function ($video) {
                $actions = '';

                    $actions .= '<a href="' . route('video.edit', $video->id) . '"  ><em class="icon ni ni-edit"></em><span>Edit</span></a>';
                    $actions .= '<a href="javascript:void(0)" class="delete " data-table="video-table" data-url="' . route('video.destroy', $video->id) . '"><em class="icon ni ni-trash text-danger"></em><span>Delete</span> </a>';

                ;
                return $actions;
            })
            ->rawColumns(['date','actions'])
            ->addIndexColumn()->make(true);
    }
}
