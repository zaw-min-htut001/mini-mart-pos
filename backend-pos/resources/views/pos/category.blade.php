<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="container mt-5">
            <h1 class="mb-4 ml-3 text-3xl">Categories</h1>
            <div class="ml-3">
                <!-- Modal toggle -->
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-md px-4 py-2.5 inline-flex items-center text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Add new category
                </button>
                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Create New Category
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form id="myForm" class="p-4 md:p-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Type category name">
                                            <span id="name_error" class="text-danger error"></span>
                                    </div>
                                </div>
                                <button type="submit" id="submitBtn"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="empTable" class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{ $dataTable->scripts() }}
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            // Delete record
            $('#empTable').on('click', '.deleteCategory', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: '{{ url('/category/') }}/' + id,
                            data: {
                                _token: CSRF_TOKEN,
                            },
                            dataType: 'json',
                            success: function(res) {
                                if (res.success === 1) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload(true)
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });

            // create category
            $('#submitBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/category/create',
                    data: $('#myForm').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success === true) {
                                    Swal.fire({
                                        title: response.message,
                                        icon: "success"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload(true)
                                        }
                                    });
                                }
                        // Handle success, e.g., close modal, show success message
                        $('#crud-modal').hide();

                    },
                    error: function(error) {
                        // Handle errors, e.g., display error messages
                        if (error.responseJSON && error.responseJSON.errors) {
                            // Handle validation errors
                            var errors = error.responseJSON.errors;
                            // Display errors in the modal using your desired method (e.g., using alert, appending to HTML, etc.)
                            // Example:
                            $.each(errors, function(key, value) {
                                // Append error messages to specific elements in the modal
                                $('#' + key + '_error').text(value[0]);
                            });
                        } else {
                            // Handle other errors
                            console.log('An unexpected error occurred:', error);
                        }
                    }
                });
            });

        });
    </script>
@endpush

</x-app-layout>
