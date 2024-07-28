<?php

namespace App\Http\Controllers\swagger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

#[OA\Info(version: '1.0.1', description: 'help app api', title: 'API Docummentation')]
#[OA\SecurityScheme(securityScheme: 'passport', type: 'apiKey')]
class AuthController extends Controller
{
    #[OA\Post(path: '/api/login', operationId: 'login', description: 'Authenticate user and get token', tags: ['Auth'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success login', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'email', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'kostya_200@mail.ru')]
    #[OA\Parameter(name: 'password', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'password123')]
    public function login(LoginRequest $request)
    {
        //
    }

    #[OA\Post(path: '/api/logout', operationId: 'logout',
        description: 'Logout from app api',
        security: [['passport' => []]], tags: ['Auth'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success logout', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    public function logout()
    {
        //
    }

    #[OA\Post(path: '/api/reset-password',
        operationId: 'resetPassword',
        description: 'Reset password for authenticated user',
        security: [['passport' => []]],
        tags: ['Auth']
    )]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success reset password', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'error validation data')]
    public function resetPassword(Request $request)
    {
        //
    }
}
