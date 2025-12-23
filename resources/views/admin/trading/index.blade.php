@extends('layouts.admin')

@section('content')
    <div>
        <header class="mb-8">
            <h1 class="text-3xl font-bold">Trading Monitor</h1>
            <p class="text-gray-400">View all connected broker accounts across the platform</p>
        </header>

        <div class="bg-black/40 border border-white/5 rounded-2xl overflow-hidden backdrop-blur-md">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5 bg-white/5">
                        <th class="p-4 font-medium text-gray-400">Owner</th>
                        <th class="p-4 font-medium text-gray-400">Broker</th>
                        <th class="p-4 font-medium text-gray-400">Login ID</th>
                        <th class="p-4 font-medium text-gray-400">Server</th>
                        <th class="p-4 font-medium text-gray-400">Balance</th>
                        <th class="p-4 font-medium text-gray-400">MetaApi ID</th>
                        <th class="p-4 font-medium text-gray-400">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="p-4 font-medium">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-xs font-bold">
                                    {{ substr($account->user->name, 0, 1) }}
                                </div>
                                {{ $account->user->name }}
                            </div>
                        </td>
                        <td class="p-4 text-gray-400 uppercase font-bold text-xs tracking-wider">{{ $account->broker_type }}</td>
                        <td class="p-4 text-gray-300 font-mono text-sm">{{ $account->login_id }}</td>
                        <td class="p-4 text-gray-400 text-sm">{{ $account->server }}</td>
                        <td class="p-4 font-mono text-emerald-400">${{ number_format($account->balance, 2) }}</td>
                        <td class="p-4 text-gray-600 font-mono text-xs">{{ $account->meta_api_id ?? 'N/A' }}</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-xs font-bold bg-green-500/10 text-green-500 border border-green-500/20">
                                ACTIVE
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $accounts->links() }}
        </div>
    </div>
@endsection
