<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Post;
use App\Models\EmailJob;
use Illuminate\Validation\ValidationException;
use App\Services\SubscriptionService;
use App\Events\PostCreated;

class PostController extends Controller
{
    use ApiResponse;

    protected $subscriptionService; // declare service class property

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService; // assign service class
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // validate input data
            $valid_request_data = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            // crate new post
            $post = Post::create($valid_request_data);

            // create event
            // event(new PostCreated($post)); 
            PostCreated::dispatch($post);

            // send success response
            return $this->success(
                $post, 
                'Post created successfully! Email job for subscriber is added.', 
                201
            );

        } catch (ValidationException $e) {
            
            $errors = $e->errors();

            // send error response
            return $this->validationError(
                $errors, 
                'Validation failed'
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // send succes response
        return $this->success(
            $post->toArray() , 
            'Success', 
            201
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
