@extends('layouts.admin')

@section('content')
    <div>
        <header class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">User Management</h1>
                <p class="text-gray-400">Manage all registered users</p>
            </div>
            <!-- Future: Add Search Bar -->
        </header>

        <div class="bg-black/40 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-md">
            <!-- Table content remains similar but styling tweaked for theme consistency -->
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5 bg-white/5">
                        <th class="p-4 font-medium text-gray-400">ID</th>
                        <th class="p-4 font-medium text-gray-400">Name</th>
                        <th class="p-4 font-medium text-gray-400">Email</th>
                        <th class="p-4 font-medium text-gray-400">Plan</th>
                        <th class="p-4 font-medium text-gray-400">Role</th>
                        <th class="p-4 font-medium text-gray-400">Registered</th>
                        <th class="p-4 font-medium text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="p-4 text-gray-500">#{{ $user->id }}</td>
                        <td class="p-4 font-medium">{{ $user->name }}</td>
                        <td class="p-4 text-gray-400">{{ $user->email }}</td>
                        <td class="p-4 text-gray-400">
                             <span class="px-2 py-1 rounded text-xs font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                {{ ucfirst($user->subscription_plan) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-xs font-bold {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/20' : 'bg-gray-500/20 text-gray-400 border border-white/5' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-500 text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="p-4 text-right">
                            <button class="text-gray-400 hover:text-white transition">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
