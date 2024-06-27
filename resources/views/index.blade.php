@extends('layouts.app')

@section('title')
    Event Reminder | Home
@endsection

@section('content')
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        <br>
    @endif

    <div class="grid grid-cols-3 gap-4 place-content-center">
        <!-- Completed Event Grid -->
        <a href="{{ route('events.index', ['completed']) }}" class="bg-gray-500 text-white font-bold p-12 rounded">
            <div class="flex items-center justify-center">
                <i class="bi bi-check mr-2"></i>
                <p>Completed Event</p>
            </div>

            <h1 class="mt-4 text-center">{{ $completedEvent }}</h1>
        </a>

        <!-- Upcoming Event Grid -->
        <a href="{{ route('events.index', ['upcoming']) }}" class="bg-green-500 text-white font-bold p-12 rounded">
            <div class="flex items-center justify-center">
                <i class="bi bi-calendar-event mr-2"></i>
                Upcoming Event
            </div>

            <h1 class="mt-4 text-center">{{ $upcomingEvent }}</h1>
        </a>

        <!-- Create Event Grid -->
        <div class="bg-blue-500 text-white font-bold flex items-center justify-center p-12 rounded">
            <i class="bi bi-plus"></i>
        </div>
    </div>

@endsection
