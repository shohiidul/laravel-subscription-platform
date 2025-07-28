<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Validation\ValidationException;
use App\Services\SubscriptionService;

class SubscriptionsController extends Controller
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
    public function index(Request $request)
    {
        try {
            // validate input
            $valid_request_data = $request->validate([
                'email' => 'required|string|email|max:120|unique:subscriptions,email',
            ]);

            // add/save email address
            $data = $this->subscriptionService->addEmail($valid_request_data['email']);

            // return response
            return $this->success([
                    'email' => $valid_request_data['email'],
                    'email_verify_link' => route('subscribe.verify_email', $data->email_verify_token),
                    'email_verify_secure_string' => $data->email_verify_token,
                ], 
                'Subscriptions email added successfully! Please verify email.', 
                201
            );

        } catch (ValidationException $e) {            
            $errors = $e->errors();
            return $this->validationError($errors, 'Validation failed');
        }
    }

    public function verify_email(string $secure_string, Request $request)
    {
        try {
            // check secure_string is exist or not with time limit
            $isExist = $this->subscriptionService->checkSecureString($secure_string);

            if( ! $isExist){
                $errors = [];
                $errors[] = 'Invalid secure key';
                return $this->validationError($errors, 'Validation failed');
            }

            // active the subscriptin email, change the status to 1
            $this->subscriptionService->activeSubscriptionEmail($secure_string);

            // return response
            return $this->success(
                [], 
                'Subscriptions email successfully verified!', 
                201
            );

        } catch (ValidationException $e) {            
            $errors = $e->errors();
            return $this->validationError($errors, 'Validation failed');
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriptions $subscriptions)
    {
        //
    }
}
