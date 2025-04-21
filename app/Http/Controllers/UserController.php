<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Psr\Log\LoggerInterface;

class UserController extends Controller
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->middleware(['auth', 'role:admin']);
    }

    public function index(Request $request)
    {
        try {
            $query = User::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('department', 'like', "%{$search}%");
                });
            }

            if ($request->filled('department')) {
                $query->where('department', $request->department);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status === 'active');
            }

            $users = $query->with('roles')
                          ->orderBy($request->sort ?? 'created_at', $request->order ?? 'desc')
                          ->paginate($request->per_page ?? 10);

            return view('users.index', compact('users'));
        } catch (\Exception $e) {
            $this->logger->error('Kullanıcı listesi alınırken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Kullanıcı listesi alınırken bir hata oluştu.');
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', Password::defaults()],
                'phone' => ['nullable', 'string', 'max:20'],
                'position' => ['nullable', 'string', 'max:100'],
                'department' => ['nullable', 'string', 'max:100'],
                'profile_photo' => ['nullable', 'image', 'max:2048'],
                'roles' => ['required', 'array']
            ]);

            if ($request->hasFile('profile_photo')) {
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo'] = $path;
            }

            $validated['password'] = Hash::make($validated['password']);
            
            $user = User::create($validated);
            $user->syncRoles($request->roles);

            $this->logger->info('Yeni kullanıcı oluşturuldu', [
                'user_id' => $user->id,
                'created_by' => auth()->id()
            ]);

            return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
        } catch (\Exception $e) {
            $this->logger->error('Kullanıcı oluşturulurken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Kullanıcı oluşturulurken bir hata oluştu.');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
                'password' => ['nullable', Password::defaults()],
                'phone' => ['nullable', 'string', 'max:20'],
                'position' => ['nullable', 'string', 'max:100'],
                'department' => ['nullable', 'string', 'max:100'],
                'profile_photo' => ['nullable', 'image', 'max:2048'],
                'roles' => ['required', 'array']
            ]);

            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo'] = $path;
            }

            if ($request->filled('password')) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $user->update($validated);
            $user->syncRoles($request->roles);

            $this->logger->info('Kullanıcı güncellendi', [
                'user_id' => $user->id,
                'updated_by' => auth()->id()
            ]);

            return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
        } catch (\Exception $e) {
            $this->logger->error('Kullanıcı güncellenirken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Kullanıcı güncellenirken bir hata oluştu.');
        }
    }

    public function destroy(User $user)
    {
        try {
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Kendi hesabınızı silemezsiniz.');
            }

            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $user->delete();

            $this->logger->info('Kullanıcı silindi', [
                'user_id' => $user->id,
                'deleted_by' => auth()->id()
            ]);

            return back()->with('success', 'Kullanıcı başarıyla silindi.');
        } catch (\Exception $e) {
            $this->logger->error('Kullanıcı silinirken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Kullanıcı silinirken bir hata oluştu.');
        }
    }

    public function toggleStatus(User $user)
    {
        try {
            if ($user->id === auth()->id()) {
                return back()->with('error', 'Kendi hesabınızın durumunu değiştiremezsiniz.');
            }

            $user->update(['status' => !$user->status]);

            $this->logger->info('Kullanıcı durumu değiştirildi', [
                'user_id' => $user->id,
                'new_status' => $user->status,
                'changed_by' => auth()->id()
            ]);

            return back()->with('success', 'Kullanıcı durumu başarıyla güncellendi.');
        } catch (\Exception $e) {
            $this->logger->error('Kullanıcı durumu değiştirilirken hata oluştu', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Kullanıcı durumu değiştirilirken bir hata oluştu.');
        }
    }
} 