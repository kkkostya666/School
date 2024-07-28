<?php

namespace App\Http\Controllers\swagger;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class GroupController extends Controller
{
    #[OA\Get(
        path: '/api/groups',
        operationId: 'groups.index',
        description: 'Get a list of all groups.',
        security: [['passport' => []]],
        tags: ['Group'],
    ),
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'List of all groups in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    public function index()
    {
        //
    }

    #[OA\Get(
        path: '/api/groups/{group}',
        operationId: 'groups.show',
        description: 'Get information of group',
        security: [['passport' => []]],
        tags: ['Group'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Information of group in json',
        content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'group', description: 'Write id of group', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function show(Group $group)
    {
        //
    }

    #[OA\Post(
        path: '/api/groups',
        operationId: 'groups.store',
        description: 'Create a new group',
        security: [['passport' => []]],
        tags: ['Group'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success created group', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'title', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    public function store(GroupRequest $request)
    {
        //
    }

    #[OA\Patch(
        path: '/api/groups/{group}',
        operationId: 'groups.update',
        description: 'Update group {group}',
        security: [['passport' => []]],
        tags: ['Group'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success updated group', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'name', in: 'query', required: true, schema: new OA\Schema(type: 'string'))]
    #[OA\Parameter(name: 'group', description: 'Write id of group for update', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function update(GroupRequest $request, Group $group)
    {
        //
    }

    #[OA\Delete(
        path: '/api/groups/{group}',
        operationId: 'groups.delete',
        description: 'Delete group {group}',
        security: [['passport' => []]],
        tags: ['Group'])
    ]
    #[OA\Response(response: Response::HTTP_OK, description: 'Success deleted group', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthorized', content: new OA\JsonContent())]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Errors in input data', content: new OA\JsonContent())]
    #[OA\Parameter(name: 'group', description: 'Write id of group for delete', in: 'path', required: true,
        schema: new OA\Schema(type: 'integer'))]
    public function destroy(Group $group)
    {
        //
    }
}
