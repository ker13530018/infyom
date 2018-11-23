<?php

namespace App\Http\Controllers;

// Request
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUserRolesRequest;
use App\Http\Requests\UpdateUserRolesRequest;
// Repository
use App\Repositories\RolesRepository;
use App\Repositories\UserRolesRepository;
use App\Repositories\UsersRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserRolesController extends AppBaseController
{
    /** @var  UserRolesRepository */
    private $userRolesRepository;

    /** @var  RolesRepository */
    private $rolesRepository;

    /** @var  UsersRepository */
    private $usersRepository;

    public function __construct(UserRolesRepository $userRolesRepo, RolesRepository $rolesRepo, UsersRepository $userRepo)
    {
        $this->userRolesRepository = $userRolesRepo;
        $this->rolesRepository = $rolesRepo;
        $this->usersRepository = $userRepo;
    }

    /**
     * Display a listing of the UserRoles.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userRolesRepository->pushCriteria(new RequestCriteria($request));
        $userRoles = $this->userRolesRepository->all();

        return view('user_roles.index')
            ->with('userRoles', $userRoles);
    }

    /**
     * Show the form for creating a new UserRoles.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $this->rolesRepository->pushCriteria(new RequestCriteria($request));
        $roles = $this->rolesRepository->all();

        return view('user_roles.create')->with('roles', $roles);
    }

    /**
     * Store a newly created UserRoles in storage.
     *
     * @param CreateUserRolesRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRolesRequest $request)
    {
        $input = $request->all();

        $userRoles = $this->userRolesRepository->create($input);

        Flash::success('User Roles saved successfully.');

        return redirect(route('userRoles.index'));
    }

    /**
     * Display the specified UserRoles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userRoles = $this->userRolesRepository->findWithoutFail($id);

        if (empty($userRoles)) {
            Flash::error('User Roles not found');

            return redirect(route('userRoles.index'));
        }

        return view('user_roles.show')->with('userRoles', $userRoles);
    }

    /**
     * Assign the specified UserRoles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function assign($id, Request $request)
    {
        $user = $this->usersRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->rolesRepository->pushCriteria(new RequestCriteria($request));
        $roles = $this->rolesRepository->all();

        return view('user_roles.assign')->with('user', $user)->with('roles', $roles);
    }

    /**
     * Assign the specified UserRoles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function role($id, Request $request)
    {
        $userRoles = $this->userRolesRepository->findWhere(['user_id' => $id]);
        if ($userRoles->isEmpty()) {
            // insert process
            $this->userRolesRepository->create($request->all());
            Flash::success('User Roles create successfully.');
        } else {
            //update process
            $this->userRolesRepository->update($request->all(), $userRoles->id);
            Flash::success('User Roles update successfully.');
        }
        
        return redirect(route('users.index'));
    }

    /**
     * Show the form for editing the specified UserRoles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $userRoles = $this->userRolesRepository->findWithoutFail($id);

        if (empty($userRoles)) {
            Flash::error('User Roles not found');

            return redirect(route('userRoles.index'));
        }

        return view('user_roles.edit')->with('userRoles', $userRoles);
    }

    /**
     * Update the specified UserRoles in storage.
     *
     * @param  int              $id
     * @param UpdateUserRolesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRolesRequest $request)
    {
        $userRoles = $this->userRolesRepository->findWithoutFail($id);

        if (empty($userRoles)) {
            Flash::error('User Roles not found');

            return redirect(route('userRoles.index'));
        }

        $userRoles = $this->userRolesRepository->update($request->all(), $id);

        Flash::success('User Roles updated successfully.');

        return redirect(route('userRoles.index'));
    }

    /**
     * Remove the specified UserRoles from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userRoles = $this->userRolesRepository->findWithoutFail($id);

        if (empty($userRoles)) {
            Flash::error('User Roles not found');

            return redirect(route('userRoles.index'));
        }

        $this->userRolesRepository->delete($id);

        Flash::success('User Roles deleted successfully.');

        return redirect(route('userRoles.index'));
    }
}
