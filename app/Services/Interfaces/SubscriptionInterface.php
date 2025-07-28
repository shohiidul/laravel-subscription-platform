<?php

namespace App\Services\Interfaces;
use App\Models\User;

interface SubscriptionInterface
{
    public function setPostToSubscriber($post_id);
    public function addEmail(string $email);
    public function checkSecureString(string $secure_string);
    public function activeSubscriptionEmail(string $secure_string);
}
