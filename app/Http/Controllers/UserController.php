<?php

namespace App\Http\Controllers;

use Devrabiul\ToastMagic\Facades\ToastMagic;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = $this->service->listUsers(25);
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->safe()->only(['name', 'email']);
            $data['password'] = bcrypt($request->input('password'));

            $this->service->create($data);
            ToastMagic::success('User created', 'New user was created successfully.');

            return redirect()->route('users.index');
        } catch (\Throwable $exception) {
            ToastMagic::error('Create failed', $exception->getMessage());

            return back()->withInput();

            
        }
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $data = $request->safe()->only(['name', 'email']);

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }

            $this->service->update($user, $data);
            ToastMagic::success('User updated', 'User details were updated successfully.');

            return redirect()->route('users.index');
        } catch (\Throwable $exception) {
            ToastMagic::error('Update failed', $exception->getMessage());

            return back()->withInput();
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->service->delete($user);
            ToastMagic::success('User deleted', 'User has been deleted.');

            return redirect()->route('users.index');
        } catch (\Throwable $exception) {
            ToastMagic::error('Delete failed', $exception->getMessage());

            return back();
        }
    }

}

