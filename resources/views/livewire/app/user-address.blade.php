<div>
    <!-- ===== PAGE HEADER ===== -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-xl sm:text-2xl font-bold">My Addresses</h1>
        <p class="text-sm text-gray-500">
            Manage your delivery addresses
        </p>
    </div>

    <a href="#add-address"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
              bg-purple-600 text-white text-sm font-semibold">
        + Add New Address
    </a>
</div>

<!-- ===== ADDRESS GRID ===== -->
<div class="grid grid-cols-2 md:grid-cols-3 gap-4">

    <!-- ===== ADDRESS CARD ===== -->
    <div class="bg-white border rounded-xl p-4 space-y-2">

        <div class="flex justify-between items-start">
            <p class="font-semibold text-sm">Home</p>
            <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600">
                Default
            </span>
        </div>

        <p class="text-sm text-gray-600 leading-relaxed">
            Ankur Jha<br>
            221B, Baker Street<br>
            New Delhi, Delhi – 110001
        </p>

        <p class="text-sm font-semibold">📞 9876543210</p>

        <div class="flex gap-3 pt-2 text-sm font-semibold">
            <a href="#edit" class="text-purple-600">Edit</a>
            <a href="#delete" class="text-red-500">Delete</a>
        </div>

    </div>

    <!-- ===== ADDRESS CARD ===== -->
    <div class="bg-white border rounded-xl p-4 space-y-2">

        <p class="font-semibold text-sm">Office</p>

        <p class="text-sm text-gray-600 leading-relaxed">
            Ankur Jha<br>
            Cyber City, DLF Phase 2<br>
            Gurugram, Haryana – 122002
        </p>

        <p class="text-sm font-semibold">📞 9876543210</p>

        <div class="flex gap-3 pt-2 text-sm font-semibold">
            <a href="#edit" class="text-purple-600">Edit</a>
            <a href="#delete" class="text-red-500">Delete</a>
        </div>

    </div>

</div>

</div>