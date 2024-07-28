<?php

namespace App\Http\Controllers\swagger;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class MarkController extends Controller
{
    #[OA\Get(
        path: '/api/users/{user}/subjects',
        operationId: 'marks.index',
        description: 'Get list marks of user',
        security: [['passport' => []]],
        tags: ['Marks'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'List of marks', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'student', description: 'Write id of user for get marks', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function index(User $user)
    {
        //
    }

    #[OA\Post(
        path: '/api/users/{user}/subjects',
        operationId: 'marks.store',
        description: 'Create mark for user of subject',
        security: [['passport' => []]],
        tags: ['Marks'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success created mark', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'user_id', description: 'Write id of user for create mark', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    #[OA\Parameter(name: 'subject_id', description: 'Write id of subject of user for create mark', in: 'query', required: true,
        schema: new OA\Schema(type: 'integer'))]
    #[OA\Parameter(name: 'mark', description: 'New mark (2-5)', in: 'query', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function store(MarkRequest $request, User $user)
    {
        //
    }

    #[OA\Patch(
        path: '/api/users/{user}/subjects/{subject}',
        operationId: 'marks.update',
        description: 'Update mark from user of subject',
        security: [['passport' => []]],
        tags: ['Marks'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success updated mark', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'student', description: 'Write id of user for update mark', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    #[OA\Parameter(name: 'subject', description: 'Write id of subject of user for update mark', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    #[OA\Parameter(name: 'mark', description: 'New mark (2-5)', in: 'query', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function update(MarkRequest $request, User $user, Subject $subject)
    {
        //
    }

    #[OA\Delete(
        path: '/api/users/{user}/subjects/{subject}',
        operationId: 'marks.delete',
        description: 'Delete mark from user of subject',
        security: [['passport' => []]],
        tags: ['Marks'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success deleted mark', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'student', description: 'Write id of user for delete mark', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    #[OA\Parameter(name: 'subject', description: 'Write id of subject of user for delete mark', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function destroy(User $user, Subject $subject)
    {
        //
    }
}
