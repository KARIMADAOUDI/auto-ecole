<div class="relative" x-data="{ open: false }">
    <!-- Bouton de notification -->
    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-800 focus:outline-none">
        <i class="bi bi-bell text-xl"></i>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Menu déroulant -->
    <div x-show="open" 
         @click.away="open = false"
         class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50">
        
        <div class="p-4 border-b">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Notifications</h3>
                @if($unreadCount > 0)
                    <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                            Tout marquer comme lu
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @forelse($notifications as $notification)
                <div class="p-4 border-b hover:bg-gray-50 {{ !$notification->is_read ? 'bg-blue-50' : '' }}">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @if($notification->type === 'payment_complete')
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            @else
                                <i class="bi bi-info-circle-fill text-blue-500 text-xl"></i>
                            @endif
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->title }}
                            </p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $notification->message }}
                            </p>
                            <p class="mt-1 text-xs text-gray-400">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                            @if(!$notification->is_read)
                                <form action="{{ route('notifications.mark-read', $notification) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-800">
                                        Marquer comme lu
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500">
                    Aucune notification
                </div>
            @endforelse
        </div>

        @if($notifications->hasPages())
            <div class="p-4 border-t">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</div> 