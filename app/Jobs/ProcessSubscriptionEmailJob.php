<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\EmailJob;
use Log;
use Illuminate\Support\Facades\Mail;

class ProcessSubscriptionEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ProcessSubscriptionEmailJob is working.');

        // Select any pending jobs from email_job table
        $emailJobs = EmailJob::where('status', '0')->limit(env('JOB_SUBSCRIBER_SEND_EMAIL_LIMIT', 10))->get();

        if(count($emailJobs)>0) {

            $emailJobId     = [];
            $postIds        = [];
            $receivers      = [];

            foreach ($emailJobs as $email) {

                $emailJobId[] = $email->id;

                $postIds[$email->post_id] = $email->post_id;

                if( ! array_key_exists($email->post_id, $receivers)){
                    $receivers[$email->post_id] = [];
                }
                $receivers[$email->post_id][] = $email->subscription_id;
            }

            // Select posts by email_job table post_id
            $posts = Post::select('id', 'title', 'body')->whereIn('id', $postIds)->get();

            if(count($posts)>0 && count($receivers)>0) {

                $posts_array = [];

                foreach ($posts as $post) {
                    $posts_array[$post->id] = $post;
                }

                if(count($posts_array)>0) {

                    foreach ($receivers as $post_id => $subscription_id) {

                        // Select email addredss by subscription_id to finally send email
                        $subscriptionEmail = Subscription::select('email')->whereIn('id', $subscription_id)->get()->toArray();

                        $subject = $posts_array[$post_id]['title'];
                        $message = $posts_array[$post_id]['body'];

                        if(count($subscriptionEmail)>0){
                            // Send email 
                            foreach ($subscriptionEmail as $index => $toEmail) {
                                
                                $email_address = $toEmail['email'];

                                if (filter_var($email_address, FILTER_VALIDATE_EMAIL)){

                                    Mail::raw($message, function ($mail) use ($email_address, $subject) {
                                        $mail->to($email_address)->subject($subject);
                                    });
                                }
                            }

                            Log::info("ProcessSubscriptionEmailJob email send is done");                            
                        }                        
                    }
                }

                Log::info("ProcessSubscriptionEmailJob - deleting completed jobs");                            
                EmailJob::whereIn('id', $emailJobId)->delete();
            }
        }
    }
}
