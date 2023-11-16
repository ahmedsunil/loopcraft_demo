<?php

namespace Tests\Unit;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use PHPUnit\Framework\TestCase;


class AuthControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_should_login_a_user()
    {
        $request = new LoginUserRequest([
            'email' => 'sunil@gmail.com',
            'password' => 'Root@123!',
        ]);

        $response = (new AuthController())->login($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertTrue($response->getData()->success);
        $this->assertEquals('Logged In Successfully', $response->getData()->message);
    }

}
