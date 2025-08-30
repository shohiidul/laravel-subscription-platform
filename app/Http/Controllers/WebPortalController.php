<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Traits\ApiResponse;
use App\Services\WebPortalService;

class WebPortalController extends Controller
{
    use ApiResponse;

    private $webPortalService;

    public function __construct(WebPortalService $webPortalService)
    {
        $this->webPortalService = $webPortalService;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // validate input data
            $valid_request_data = $request->validate([
                'portal_name' => 'required|string|max:255',
            ]);

            $webPortal = $this->webPortalService->create($valid_request_data);

            // send success response
            return $this->success(
                $webPortal, 
                'Web portal created successfully!', 
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
    public function show(string $secretKey)
    {
        try {        
            $webPortal = $this->webPortalService->getActivePortalByKey($secretKey);

            if($webPortal===null)
                throw new ModelNotFoundException("Data not found.");             

            // send success response
            return $this->success(
                $webPortal, 
                'Success', 
                201
            );

        } catch (ModelNotFoundException $e) {

            // send error response
            return $this->error(
                $e->getMessage()
            );
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
