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
        <div class="bg-gray-500 text-white font-bold flex items-center justify-center p-12 rounded">
            <i class="bi bi-check mr-2"></i>
            Completed Event
        </div>

        <!-- Upcoming Event Grid -->
        <div class="bg-green-500 text-white font-bold flex items-center justify-center p-12 rounded">
            <i class="bi bi-calendar-event mr-2"></i>
            Upcoming Event
        </div>

        <!-- Create Event Grid -->
        <div class="bg-blue-500 text-white font-bold flex items-center justify-center p-12 rounded">
            <i class="bi bi-plus"></i>
        </div>
    </div>

@endsection
