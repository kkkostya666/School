<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OpenApi\Annotations as OA;

class GroupController extends Controller
{
    use AuthorizesRequests;

    /**
     * @OA\Info(title="My API", version="1.0.0")
     *
     * @OA\SecurityScheme(
     *     securityScheme="Bearer",
     *     type="apiKey",
     *     in="header",
     *     name="Authorization",
     *     description="Enter token in format (Bearer <token>)"
     * )
     */
    public function index()
    {
        return GroupResource::collection(Group::all());
    }

    public function show(Group $group)
    {
        return GroupResource::make($group);
    }

    public function store(GroupRequest $request)
    {
        $this->authorize('store', Group::class);

        $group = Group::create($request->validated());

        return response()->json([
            'message' => 'Success Store new group',
            'group' => GroupResource::make($group),
        ]);
    }

    public function update(GroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);

        $group->update($request->validated());

        return response()->json([
            'message' => 'Success update group',
            'group' => GroupResource::make($group),
        ]);
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();

        return response()->json(['message' => 'Success delete group']);
    }
}
