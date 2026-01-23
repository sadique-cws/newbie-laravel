@php
    $status = $user->apply_status;
    $hasApplied = !is_null($user->aadhar_card);
    $canPreview = in_array($status, ['SUBMITTED', 'PENDING', 'VERIFIED', 'REJECTED']);
    $canEdit = !$hasApplied || $status === 'REJECTED';
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex gap-6">

        {{-- ================= SIDEBAR ================= --}}
        @include('components.app.user-sidebar')

        {{-- ================= MAIN CONTENT ================= --}}
        <main class="flex-1 space-y-8">

            <!-- HEADER -->
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Retailer Verification
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">
                    Submit your KYC details to become an approved retailer
                </p>
            </div>

            <!-- ================= STATUS CARD ================= -->
            @if($hasApplied)
                <div @class([
                    'rounded-2xl p-6 border',

                    'bg-yellow-100 border-yellow-300 text-yellow-900' =>
                        in_array($status, ['SUBMITTED', 'PENDING']),

                    'bg-green-100 border-green-300 text-green-900' =>
                        $status === 'VERIFIED',

                    'bg-red-100 border-red-300 text-red-900' =>
                        $status === 'REJECTED',
                ])>
                    <p class="text-sm font-semibold tracking-wide uppercase">
                        Application Status
                    </p>

                    <p class="text-xl font-bold mt-1">
                        {{ ucfirst(strtolower($status)) }}
                    </p>

                    @if($status === 'SUBMITTED')
                        <p class="mt-2 text-sm">
                            Your application has been submitted successfully and will be reviewed shortly.
                        </p>
                    @elseif($status === 'PENDING')
                        <p class="mt-2 text-sm">
                            Your documents are currently under verification. Please wait for approval.
                        </p>
                    @elseif($status === 'VERIFIED')
                        <p class="mt-2 text-sm">
                            Your retailer account has been verified.
                        </p>
                    @elseif($status === 'REJECTED')
                        <p class="mt-2 text-sm font-semibold">
                            Reason for rejection:
                        </p>
                        <p class="mt-1 text-sm">
                            {{ $user->rejection_reason }}
                        </p>
                    @endif
                </div>
            @endif

            <!-- ================= PREVIEW SECTION ================= -->
            @if($canPreview)
                <div class="bg-white dark:bg-gray-800 rounded-2xl border p-6 space-y-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Submitted Documents
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $user->avatar_url) }}"
                                class="h-28 w-28 rounded-full mx-auto object-cover border">
                            <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                                Profile Photo
                            </p>
                        </div>

                        <div>
                            <img src="{{ asset('storage/' . $user->aadhar_card_front) }}"
                                class="w-full h-44 object-cover rounded-xl border">
                            <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                                Aadhar Card (Front)
                            </p>
                        </div>

                        <div>
                            <img src="{{ asset('storage/' . $user->aadhar_card_back) }}"
                                class="w-full h-44 object-cover rounded-xl border">
                            <p class="text-sm mt-2 text-gray-600 dark:text-gray-400">
                                Aadhar Card (Back)
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 border-t dark:border-gray-700">
                        <p class="text-sm text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Aadhar Number:</span>
                            {{ $user->aadhar_card }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- ================= FORM ================= -->
            @if($canEdit)
                <form wire:submit.prevent="submit" class="bg-white dark:bg-gray-800 rounded-2xl border p-6 space-y-6">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $status === 'REJECTED' ? 'Re-submit Documents' : 'Submit Documents' }}
                    </h2>

                    <!-- AVATAR -->
                    <div>
                        <p class="font-semibold mb-2">Profile Photo</p>

                        <label
                            class="w-32 h-32 border-2 border-dashed rounded-xl flex items-center justify-center cursor-pointer bg-gray-50 dark:bg-gray-700">
                            @if($avatar)
                                <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <span class="text-xs text-gray-500 text-center">
                                    Select Photo
                                </span>
                            @endif
                            <input type="file" wire:model="avatar" class="hidden">
                        </label>
                    </div>

                    <!-- AADHAR NUMBER -->
                    <div>
                        <label class="font-semibold text-sm">Aadhar Number</label>
                        <input type="text" wire:model.defer="aadhar_card"
                            class="w-full mt-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            placeholder="Enter 12-digit Aadhar number">
                    </div>

                    <!-- AADHAR IMAGES -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['aadhar_front' => 'Aadhar Front', 'aadhar_back' => 'Aadhar Back'] as $field => $label)
                            <div>
                                <p class="font-semibold mb-2">{{ $label }}</p>
                                <label
                                    class="h-40 border-2 border-dashed rounded-xl flex items-center justify-center cursor-pointer bg-gray-50 dark:bg-gray-700">
                                    @if($$field)
                                        <img src="{{ $$field->temporaryUrl() }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <span class="text-xs text-gray-500">
                                            Click to upload
                                        </span>
                                    @endif
                                    <input type="file" wire:model="{{ $field }}" class="hidden">
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit"
                        class="px-6 py-3 rounded-xl bg-purple-600 text-white font-semibold hover:bg-purple-700 disabled:opacity-50"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            {{ $status === 'REJECTED' ? 'Re-submit for Verification' : 'Submit for Verification' }}
                        </span>
                        <span wire:loading>
                            Submitting...
                        </span>
                    </button>

                    @if(session()->has('success'))
                        <p class="text-green-700 font-semibold">
                            {{ session('success') }}
                        </p>
                    @endif
                </form>
            @endif

        </main>
    </div>
</div>