<div class="sidebar">
    <!-- Sidebar content -->
    <div>
        <a href="{{ route('home') }}" class="flex items-center">
            <i class="bi bi-calendar-check px-2 py-1 rounded-md bg-blue-600"></i>
            <h1 class="font-bold text-[15px] ml-3">Event Reminder</h1>
        </a>
        <div class="my-2 bg-gray-600 h-[1px]"></div>

        <!-- Sidebar menu items -->
        <a href="{{ route('events.create') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-plus"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Create Event</span>
        </a>

        <a href="{{ route('events.index') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-list"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Event List</span>
        </a>

        <div class="my-4 bg-gray-600 h-[1px]"></div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-in-right"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Logout</span>
        </div>
    </div>
</div>
