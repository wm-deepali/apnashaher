<div class="flex items-center gap-4">

    <!-- Notification Bell -->
    <div class="relative">
        <button onclick="toggleNotification()" class="relative p-2 rounded-full hover:bg-gray-100">

            <!-- Bell Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 17h5l-1.405-1.405M19 17V11a7 7 0 10-14 0v6l-1.405 1.405M9 21h6"/>
            </svg>

            <!-- Badge -->
            @if($unreadCount > 0)
                <span id="notifBadge"
                      class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-semibold px-1.5 py-0.5 rounded-full">
                    {{ $unreadCount }}
                </span>
            @endif
        </button>

        <!-- Dropdown -->
        <div id="notificationDropdown"
             class="hidden absolute right-0 mt-3 w-72 sm:w-80 max-w-[90vw] bg-white rounded-xl shadow-xl border z-50 transition-all duration-200">

            <!-- Heading -->
            <div class="flex justify-between items-center px-4 py-3 border-b">
                <h3 class="font-semibold text-gray-700">Notifications</h3>
            </div>

            <!-- Notification Items -->
            @forelse($notifications as $notif)
                @php
                    $data = $notif->data;
                    $statusClass = $notif->read_at ? 'text-gray-500' : 'text-gray-800 font-medium';
                @endphp
                <div onclick="openNotifModal('{{ $data['message_title'] ?? $data['type'] }}',
                                             '{{ $notif->created_at->format('d M Y') }}',
                                             '{{ $data['message'] ?? '' }}',
                                             '{{ $notif->id }}')"
                     class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b {{ $statusClass }}">
                    <p class="text-sm">{{ $data['message_title'] ?? $data['type'] }}</p>
                    <p class="text-xs text-gray-500 mt-1 truncate">{{ $data['message'] ?? '' }}</p>
                </div>
            @empty
                <div class="px-4 py-3 text-center text-gray-500">
                    No notifications
                </div>
            @endforelse
        </div>
    </div>
</div>