@extends('layouts.app')

@section('title')
    Event List | Event Reminder
@endsection

@section('content')
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table
                        class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead
                            class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Title</th>
                            <th scope="col" class="px-6 py-4">Event ID</th>
                            <th scope="col" class="px-6 py-4">Description</th>
                            <th scope="col" class="px-6 py-4">Date</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr class="border-b border-neutral-200 dark:border-white/10">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize">{{ $event->title }}</td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize">{{ $event->event_id }}</td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize">{{ $event->description }}</td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize">{{ date('M d, Y', strtotime($event->date)) }}</td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize
                                {{ $event->status === 'upcoming' ? 'text-orange-500' : 'text-gray-500' }}">
                                    {{ $event->status }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 capitalize flex items-center space-x-2">
                                    <button class="delete-event bg-red-500 text-white px-2 py-1 rounded flex items-center" data-id="{{ $event->id }}">
                                        <i class="bi bi-trash mr-1"></i>
                                        Delete
                                    </button>

                                    <a href="{{ route('events.edit', $event->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded flex items-center">
                                        <i class="bi bi-edit mr-1"></i>
                                        Edit
                                    </a>

                                    <button class="show-event bg-gray-500 text-white px-2 py-1 rounded flex items-center"
                                            data-id="{{ $event->id }}"
                                            data-title="{{ $event->title }}"
                                            data-description="{{ $event->description }}"
                                            data-date="{{ $event->date }}"
                                            data-recipients="{{ implode(',', $event->recipients) }}"
                                            data-status="{{ $event->status }}">
                                        <i class="bi bi-eye mr-1"></i>
                                        Show
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $events->links() }}

    @include('components._show_event_modal')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-event').forEach(button => {
                button.addEventListener('click', function () {
                    const eventId = this.getAttribute('data-id');

                    if (confirm('Are you sure you want to delete this event?')) {
                        fetch(`/events/${eventId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => {
                                if (response.ok) {
                                    location.reload();
                                } else {
                                    alert('Failed to delete the event.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show modal when 'Show' button is clicked
            document.querySelectorAll('.show-event').forEach(button => {
                button.addEventListener('click', function () {
                    const eventId = this.getAttribute('data-id');
                    const eventTitle = this.getAttribute('data-title');
                    const eventDescription = this.getAttribute('data-description');
                    const eventRecipients = this.getAttribute('data-recipients');
                    const eventDate = this.getAttribute('data-date');
                    const eventStatus = this.getAttribute('data-status');

                    // Set modal content
                    document.getElementById('modalEventTitle').textContent = eventTitle;
                    document.getElementById('modalEventDescription').textContent = eventDescription;
                    document.getElementById('modalEventRecipients').textContent = eventRecipients;
                    document.getElementById('modalEventDate').textContent = eventDate;
                    document.getElementById('modalEventStatus').textContent = eventStatus;

                    // Show the modal
                    document.getElementById('eventModal').classList.remove('hidden');
                });
            });

            // Close modal when 'X' button is clicked
            document.getElementById('closeModal').addEventListener('click', function () {
                document.getElementById('eventModal').classList.add('hidden');
            });

            // Close modal when 'Close' button in footer is clicked
            document.getElementById('closeModalFooter').addEventListener('click', function () {
                document.getElementById('eventModal').classList.add('hidden');
            });
        });
    </script>
@endsection
