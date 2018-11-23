<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRolesAPIRequest;
use App\Http\Requests\API\UpdateRolesAPIRequest;
use App\Models\Roles;
use App\Repositories\RolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RolesController
 * @package App\Http\Controllers\API
 */

class RolesAPIController extends AppBaseController
{
    /** @var  RolesRepository */
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepo)
    {
        $this->rolesRepository = $rolesRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/roles",
     *      summary="Get a listing of the Roles.",
     *      tags={"Roles"},
     *      description="Get all Roles",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Roles")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->rolesRepository->pushCriteria(new RequestCriteria($request));
        $this->rolesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $roles = $this->rolesRepository->all();

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * @param CreateRolesAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/roles",
     *      summary="Store a newly created Roles in storage",
     *      tags={"Roles"},
     *      description="Store Roles",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Roles that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Roles")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Roles"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolesAPIRequest $request)
    {
        $input = $request->all();

        $roles = $this->rolesRepository->create($input);

        return $this->sendResponse($roles->toArray(), 'Roles saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/roles/{id}",
     *      summary="Display the specified Roles",
     *      tags={"Roles"},
     *      description="Get Roles",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Roles",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Roles"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Roles $roles */
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            return $this->sendError('Roles not found');
        }

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRolesAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/roles/{id}",
     *      summary="Update the specified Roles in storage",
     *      tags={"Roles"},
     *      description="Update Roles",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Roles",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Roles that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Roles")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Roles"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Roles $roles */
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            return $this->sendError('Roles not found');
        }

        $roles = $this->rolesRepository->update($input, $id);

        return $this->sendResponse($roles->toArray(), 'Roles updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/roles/{id}",
     *      summary="Remove the specified Roles from storage",
     *      tags={"Roles"},
     *      description="Delete Roles",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Roles",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Roles $roles */
        $roles = $this->rolesRepository->findWithoutFail($id);

        if (empty($roles)) {
            return $this->sendError('Roles not found');
        }

        $roles->delete();

        return $this->sendResponse($id, 'Roles deleted successfully');
    }
}
