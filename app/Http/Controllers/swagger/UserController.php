<?php

namespace App\Http\Controllers\swagger;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    #[OA\Get(
        path: '/api/users',
        operationId: 'users.index',
        description: 'Get a list of all users.',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'List of all users in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    public function index()
    {
        //
    }

    #[OA\Get(
        path: '/api/users/{user}',
        operationId: 'users.show',
        description: 'Get information of user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Information of user in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user', description: 'Write id of user', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function show(User $user)
    {
        //
    }

    #[OA\Post(
        path: '/api/users',
        operationId: 'users.store',
        description: 'Create a new user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success created user', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'first_name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'last_name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'surname', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'date_of_birth', description: 'Date format: YYYY-MM-DD [2020-12-29]', in: 'query', required: true,
        schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'role', description: 'User role [1=>ADMIN | 2=>TEACHER | 3=>STUDENT]', in: 'query', required: true,
        allowEmptyValue: true,
        schema: new OA\Schema(type: 'string', enum: UserRole::class, default: UserRole::STUDENT))]
    #[OA\Parameter(name: 'email', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'password', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[city]', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[street]', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[house]', in: 'query', required: false, schema: new OA\Schema(type: 'integer'))]
    public function store(CreateStudentRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: '/api/users/{user}',
        operationId: 'users.update',
        description: 'Update information of user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success updated user', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'first_name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'last_name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'surname', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'birthday', description: 'Date format: YYYY-MM-DD [2020-12-29]', in: 'query', required: true,
        schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'role', description: 'User role [1=>Admin | 2=>Teacher | 3=>Student]', in: 'query', required: true,
        allowEmptyValue: true,
        schema: new OA\Schema(type: 'string', default: UserRole::STUDENT, enum: UserRole::class))]
    #[OA\Parameter(name: 'email', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'password', description: 'If you want change password, when input, else empty', in: 'query', required: false,
        schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[city]', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[street]', in: 'query', required: false, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'address[house]', in: 'query', required: false, schema: new OA\Schema(type: 'integer'))]
    public function update(UpdateStudentRequest $request, User $user)
    {
        //
    }

    #[OA\Delete(
        path: '/api/users/{user}',
        operationId: 'users.delete',
        description: 'Soft delete user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success soft delete user', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user', description: 'Input id of user', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function destroy(User $user)
    {
        //
    }

    #[OA\Post(
        path: '/api/users/{user}/restore',
        operationId: 'users.restore',
        description: 'Restore user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success restore user', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user', description: 'Input id of user', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function restore(User $user)
    {
        //
    }

    #[OA\Delete(
        path: '/api/users/{user}/forceDelete',
        operationId: 'users.forceDelete',
        description: 'Hard delete user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success hard delete user', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user', description: 'Input id of user', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function forceDelete(User $user)
    {
        //
    }

    #[OA\Get(
        path: '/api/users/{user}/export',
        operationId: 'users.export',
        description: 'Create Pdf doc for marks of user',
        security: [['passport' => []]],
        tags: ['User'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Url on docs', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user', description: 'Input id of user', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function exportPdf(User $user, FileService $service)
    {
        //
    }
}
