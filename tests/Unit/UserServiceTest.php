<?php
uses(Tests\TestCase::class)->in(__DIR__);
// uses(Tests\TestCase::class);

use App\Services\UserService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

# vendor/bin/pest tests/Unit/UserServiceTest.php

it('performs createUser and returns expected result', function () {

    $string = null;

    $data = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'remember_token' => $string,
            'password' => '123456',
            'email_verified_at' => null
    ];

    $service = new UserService();
    $user = $service->createUser($data);

    expect(value: $user)->toBeInstanceOf(User::class)
                 ->and($user->name)->toBe('Admin User')
                 ->and($user->email)->toBe('admin@example.com')
                 ->and($user->remember_token)->toBe($string)
                 ->and($user->email_verified_at)->toBe(null)
                 ;

    $this->assertDatabaseHas('users', [
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'remember_token' => $string,
        'email_verified_at' => null,
    ]);
});

