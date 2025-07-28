<?php
namespace App\Services;

use App\Models\Subscription;
use App\Services\Interfaces\SubscriptionInterface;
use Illuminate\Support\Str;
use DB;

class SubscriptionService implements SubscriptionInterface
{
    // Set email list to job table to send email
    public function setPostToSubscriber($post_id)
    {
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `email_jobs` ( `subscription_id`, `post_id`, `status`, `created_at`, `updated_at` )
                SELECT `id`, 
                        '{$post_id}' AS `post_id`, 
                        '0' AS `status`, 
                        '{$timestamp}' AS `created_at`, 
                        '{$timestamp}' AS `updated_at` 
                    FROM subscriptions WHERE `status`='1';";

        return DB::statement($sql);
    }

    // Add/save new email address to subscription table
    public function addEmail(string $email): Subscription
    {
        $data['email']              = $email;
        $data['status']             = '0';
        $data['email_verify_token'] = Str::random(64);

        return Subscription::create($data);
    }

    // Check email verify link secure string on subscription table
    // It applies 10 minute time limit
    // If exists then returns true
    public function checkSecureString(string $secure_string): bool
    {
        $timestamp = date('Y-m-d H:i:s', strtotime('-10 minute'));        
        $row = Subscription::where('email_verify_token', $secure_string)
                ->where('created_at', '>=', $timestamp)
                ->first();
        if($row===null){
            return false;
        }
        return true;
    }

    // After checking done subscription table email gets activated
    public function activeSubscriptionEmail(string $secure_string): bool
    {
        $timestamp = date('Y-m-d H:i:s', strtotime('-11 minute'));        

        return Subscription::where('email_verify_token', $secure_string)
                ->where('created_at', '>=', $timestamp)
                ->limit(1)
                ->update(['status' => 1, 'email_verify_token' => '', 'email_verified_at' => date('Y-m-d H:i:s')]);
    }
}
