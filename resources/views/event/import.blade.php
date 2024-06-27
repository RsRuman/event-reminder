@extends('layouts.app')

@section('title')
    Import Event | Event Reminder
@endsection

@section('content')
    <div class="mx-auto rounded-md overflow-hidden shadow-md">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            <br>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            <br>
        @endif

        <div class="px-12 py-4">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Import Event</h2>
            <form action="{{ route('events.import.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">CSV</label>
                    <input id="file" name="file" type="file" placeholder="CSV file" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('file')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
