<x-app-layout>
    <div class="p-4 sm:ml-64">
        <div class="container mt-5">
            <h1 class="mb-4 ml-3 text-3xl">Products</h1>
            <div class="ml-3">
                <!-- Modal toggle -->
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Add new product
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
                                    Create New Product
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
                            <form id="myForm" class="p-4 md:p-5" method="POST">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Type product name">
                                        <span id="name_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                        <input type="number" name="unit_price" id="price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="$2999" required="">
                                        <span id="unit_price_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="current_stock"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                        <input type="number" name="current_stock" id="current_stock"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="12pcs" required="">
                                        <span id="current_stock_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="unit_of_measure"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit of
                                            measure</label>
                                        <input type="text" name="unit_of_measure" id="unit_of_measure"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Pcs , etc ..." required="">
                                        <span id="unit_of_measure_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category" name="category_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option disabled selected>Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="category_id_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="brand" name="brand_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                        <select id="brand" name="brand_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option disabled selected="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="brand_id_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="supplier"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                        <select id="supplier" name="supplier_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option selected="" disabled>Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="supplier_id_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                            Description</label>
                                        <textarea id="description" rows="4" name="description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write product description here"></textarea>
                                        <span id="description_error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="file" class="filepond" name="filepond"
                                            data-allow-reorder="true" data-max-file-size="3MB">
                                        <span id="filepond_error" class="text-danger error"></span>
                                    </div>
                                </div>
                                <button type="submit" id="submitBtn"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Add new product
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- update-modal --}}
                <div id="productModal" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-screen md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="absolute top-[40px] left-[500px] right-[500px] bottom-0 justify-center items-center">
                        <!-- Modal content -->
                        <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Update Product
                                </h3>
                                <button id="closeModal" type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form id="editform" class="p-4 md:p-5" method="PUT">
                                @csrf
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Type product name">
                                        <span id="name-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                        <input type="number" name="unit_price" id="price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="$2999">
                                        <span id="unit_price-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="current_stock"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                        <input type="number" name="current_stock" id="current_stock"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="12pcs">
                                        <span id="current_stock-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="unit_of_measure"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit of
                                            measure</label>
                                        <input type="text" name="unit_of_measure" id="unit_of_measure"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Pcs , etc ...">
                                        <span id="unit_of_measure-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                        <select id="category" name="category_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option disabled selected>Select category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="category_id-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="brand" name="brand_id"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                        <select id="brand" name="brand_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option disabled selected="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="brand_id-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="supplier"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                        <select id="supplier" name="supplier_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option selected="" disabled>Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span id="supplier_id-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                            Description</label>
                                        <textarea id="description" rows="4" name="description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Write product description here"></textarea>
                                        <span id="description-error" class="text-danger error"></span>
                                    </div>
                                    <div class="col-span-2">
                                        <input type="file" class="filepond1" name="filepond1"
                                            data-allow-reorder="true" data-max-file-size="3MB">
                                    </div>
                                    <input type="hidden" name="product_id">
                                </div>
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Update product
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

                // create brand
                $('#submitBtn').click(function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: 'POST',
                        url: '/products/create',
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

                // Delete record
                $('#empTable').on('click', '.deleteProduct', function() {
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
                                url: '{{ url('/products/') }}/' + id,
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

                $('#closeModal').click(function() {
                    $('#productModal').hide();
                });
                //update product
                $('#empTable').on('click', '.updateProduct', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        url: `/products/${id}/edit`,
                        method: 'GET',
                        success: function(response) {
                            console.log(response);
                            // Populate the modal form with data
                            $('#editform').find('input[name="product_id"]').val(response.data.product_id);
                            $('#editform').find('input[name="name"]').val(response.data.name);
                            $('#editform').find('input[name="unit_price"]').val(response.data
                                .unit_price);
                            $('#editform').find('input[name="unit_of_measure"]').val(response.data.unit_of_measure);
                            $('#editform').find('input[name="current_stock"]').val(response.data.current_stock);
                            $('#supplier option[value="'+response.data.supplier_id+'"]').attr("selected", "selected");
                            $('#category option[value="'+response.data.category_id+'"]').attr("selected", "selected");
                            $('#brand option[value="'+response.data.brand_id+'"]').attr("selected", "selected");
                            $('#editform').find('textarea[name="description"]').val(response.data.description);

                            $('#productModal').show();
                        }
                    });
                });

                $('#editform').submit(function(e) {
                        e.preventDefault();
                        let id = $(this).find('input[name="product_id"]').val();

                        $.ajax({
                            url: `/products/${id}/update`,
                            method: 'PUT',
                            data: $('#editform').serialize(),
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
                            $('#updateModal').hide();

                        },
                        error: function(error) {
                            console.log(error);
                            // Handle errors, e.g., display error messages
                            if (error.responseJSON && error.responseJSON.errors) {
                                // Handle validation errors
                                var errors = error.responseJSON.errors;
                                // Display errors in the modal using your desired method (e.g., using alert, appending to HTML, etc.)
                                // Example:
                                $.each(errors, function(key, value) {
                                    // Append error messages to specific elements in the modal
                                    $('#' + key + '-error').text(value[0]);
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
