<!-- Modal -->
<div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold" id="modalTitle">Event Details</h2>
            <button id="closeModal" class="text-black">&times;</button>
        </div>
        <div class="mt-4">
            <p><strong>Title:</strong> <span id="modalEventTitle"></span></p>
            <p><strong>Description:</strong> <span id="modalEventDescription"></span></p>
            <p><strong>Recipients:</strong> <span id="modalEventRecipients"></span></p>
            <p><strong>Date:</strong> <span id="modalEventDate"></span></p>
            <p><strong>Status:</strong> <span id="modalEventStatus"></span></p>
        </div>
        <div class="mt-4 flex justify-end">
            <button id="closeModalFooter" class="px-4 py-2 bg-gray-600 text-white rounded">Close</button>
        </div>
    </div>
</div>
