<?php

namespace App\Http\Controllers\swagger;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class SubjectController extends Controller
{
    #[OA\Get(
        path: '/api/subjects',
        operationId: 'subjects.index',
        description: 'Get a list of all subjects.',
        security: [['passport' => []]],
        tags: ['Subject'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'List of all subjects in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    public function index()
    {
        //
    }

    #[OA\Get(
        path: '/api/subjects/{subject}',
        operationId: 'subjects.show',
        description: 'Get information of subject',
        security: [['passport' => []]],
        tags: ['Subject'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Information of subject in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'subject', description: 'Write id of subject', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function show(Subject $subject)
    {
        //
    }

    #[OA\Post(
        path: '/api/subjects',
        operationId: 'subjects.store',
        description: 'Create a new subject',
        security: [['passport' => []]],
        tags: ['Subject'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success created subject', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    public function store(SubjectRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: '/api/subjects/{subject}',
        operationId: 'subjects.update',
        description: 'Update subject {subject}',
        security: [['passport' => []]],
        tags: ['Subject'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success updated subject', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'subject', description: 'Write id of subject for update', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function update(SubjectRequest $request, Subject $subject)
    {
        //
    }

    #[OA\Delete(
        path: '/api/subjects/{subject}',
        operationId: 'subjects.delete',
        description: 'Delete subject {subject}',
        security: [['passport' => []]],
        tags: ['Subject'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success deleted subject', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'subject', description: 'Write id of subject for delete', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function destroy(Subject $subject)
    {
        //
    }
}
