<x-guest-layout>
    @section('title', 'Participation Confirmation')
    @push('css')
        <style>
            .select2-container--bootstrap4 .select2-selection--single {
                height: calc(1.5em + 0.75rem + 16px) !important;
            }

            #selectedOptionsList {
                /* Set list style to upper-case Roman numerals */
                padding-left: 5px;
                /* Add padding for better appearance */
            }

            #selectedOptionsList li {
                margin-bottom: 5px;
                list-style-type: upper-roman !important;

                /* Add some spacing between list items */
            }
        </style>
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush
    @push('scripts')
        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                width: "100%",
            });
            $(document).ready(function() {
                $("#category_id").change(function() {
                    var selectedOptions = $(this).val();
                    $("#selectedOptionsList").empty(); // Clear previous selections
                    if (selectedOptions && selectedOptions.length > 0) {
                        selectedOptions.forEach(function(optionValue) {
                            var optionText = $("#category_id option[value='" + optionValue + "']")
                                .text();
                            $("#selectedOptionsList").append("<li>" + optionText + "</li>");
                        });
                    } else {
                        $("#selectedOptionsList").append("<li>No options selected.</li>");
                    }
                });
                $("#category_id").change();
            });
        </script>
    @endpush
    <!-- breadcrumb -->
    <div class="breadcrumb-area">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Participation Confirmation</h2>
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a>
                    </li>
                    <li class="active">Participation Confirmation</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <section class="section-padding bg-theme-primary">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form class="form_validate ajax_submit form_alert" action="{{ route('web.participation_confirmation.store',['id'=>$nominee->id,'category'=>$category->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <p>Congratulations {{ $nominee->service_name }}! You are about to confirm your participation as
                            <strong style="text-transform: uppercase">{{ $category->name }}</strong>. This
                            acknowledgment marks your outstanding
                            contribution to agricultural innovation, showcasing your dedication to advancing the
                            field.
                        </p>
                        <p>If you wish to add or change the category selected, please feel free to do so before final
                            confirmation.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Change or Add Award Category</label>
                                    <select class="form-control form-control-submit select2bs4" id="category_id"
                                        name="category_id[]" multiple="multiple" required>
                                        <option value="">Select Award Category</option>
                                        @foreach ($categories as $d_category)
                                            <option value="{{ $d_category->id }}"
                                                {{ $d_category->id == $category->id ? 'selected' : '' }}>
                                                {{ $d_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1">Selected Categories</p>
                                <ul id="selectedOptionsList">

                            </div>


                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-4">
                                <button type="submit" class="btn-second btn-submit full-width">Verify</button>
                                <div class="server_response w-100"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
