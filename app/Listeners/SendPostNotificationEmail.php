<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Events\PostCreated;
use App\Services\SubscriptionService;
use App\Mail\PostNotificationEmail;
use App\Models\User;

// class SendPostNotificationEmail implements ShouldQueue
class SendPostNotificationEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $postCreated): void
    {
        $post = $postCreated->post;

        // $subscribedUsers = User::limit(100)->get();
        // foreach ($subscribedUsers as $user) {
        //     Mail::to($user->email)->queue(new PostNotificationEmail($post, $user));
        //     Log::info("Email is send to {$user->email}");
        // } 

        $subscriptionService = new SubscriptionService();
        $subscriptionService->setPostToSubscriber($post->id);
    }
}
