<x-guest-layout>
    @section('title', 'Award Registration')
    @push('css')
        <style>
            .select2-container--bootstrap4 .select2-selection--single {
                height: calc(1.5em + 0.75rem + 16px) !important;
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
            })
            var individual = "{{ EntryEnum::Individual->value }}"
            var selected_enrty = $("#entry option:selected").val();
            console.log(selected_enrty);
            if (selected_enrty == individual) {

                $('#company_phone').prop('disabled', true);
                    $('.company_phone_div').addClass('d-none');
                    $('#company_email').prop('disabled', true);
                    $('.company_email_div').addClass('d-none');
                    $('#service_name').attr('placeholder', 'Enter Entry/ Service / Business Name');
                    $('#service_name_label').text('Entry/ Service / Business Name');
                    $('#address').attr('placeholder', 'Enter Business/Service Address');
                    $('#address_label').text('Business/Service Address');
                    $('#description').attr('placeholder', 'Short Description About your Business / Services');
                } else {
                    $('#company_phone').prop('disabled', false);
                    $('.company_phone_div').removeClass('d-none');
                    $('#company_email').prop('disabled', false);
                    $('.company_email_div').removeClass('d-none');
                    $('#service_name').attr('placeholder', 'Enter Company Name');
                    $('#service_name_label').text('Company Name');
                    $('#address').attr('placeholder', 'Enter Company Address');
                    $('#address_label').text('Company Address');
                    $('#description').attr('placeholder', 'Short Description About The  Company');
                }
            $('#entry').on('change', function() {
                var entry = $(this).val();
                if (entry == individual) {
                    $('#company_phone').prop('disabled', true);
                    $('.company_phone_div').addClass('d-none');
                    $('#company_email').prop('disabled', true);
                    $('.company_email_div').addClass('d-none');
                    $('#service_name').attr('placeholder', 'Enter Entry/ Service / Business Name');
                    $('#service_name_label').text('Entry/ Service / Business Name');
                    $('#address').attr('placeholder', 'Enter Business/Service Address');
                    $('#address_label').text('Business/Service Address');
                    $('#description').attr('placeholder', 'Short Description About your Business / Services');
                } else {
                    $('#company_phone').prop('disabled', false);
                    $('.company_phone_div').removeClass('d-none');
                    $('#company_email').prop('disabled', false);
                    $('.company_email_div').removeClass('d-none');
                    $('#service_name').attr('placeholder', 'Enter Company Name');
                    $('#service_name_label').text('Company Name');
                    $('#address').attr('placeholder', 'Enter Company Address');
                    $('#address_label').text('Company Address');
                    $('#description').attr('placeholder', 'Short Description About The  Company');
                }
            });
        </script>
    @endpush
    @push('modals')
    @endpush
    <!-- breadcrumb -->
    <div class="breadcrumb-area">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="breadcrumb-content">
                <h2>@yield('title')</h2>
                <ul>
                    <li><a href="{{ route('web.index') }}">Home</a>
                    </li>
                    <li><a href="{{ route('web.awards.categories.index') }}">Categories</a>
                    </li>
                    <li class="active">@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <section class="section-padding bg-theme-primary">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form class="form_validate ajax_submit form_alert"
                        action="{{ route('web.awards.registration.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Choose the Award Category</label>
                                    <select class="form-control form-control-submit select2bs4" id="category_id"
                                        name="category_id" required>
                                        <option value="">Select Award Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Choose Award Entry</label>
                                    <select class="form-control form-control-submit select2bs4" id="entry"
                                        name="entry" required>
                                        @foreach (EntryEnum::cases() as $entry)
                                            <option value="{{ $entry->value }}">{{ $entry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600" id="service_name_label">Service/ Business Name</label>
                                    <input type="text" name="service_name" id="service_name" class="form-control form-control-submit"
                                        placeholder="Service/ Business Name" required>
                                </div>
                            </div>
                            <div class="col-md-4 company_phone_div">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Company Phone</label>
                                    <input type="tel" name="company_phone"  id="company_phone"
                                        class="form-control form-control-submit" placeholder="Company Phone">
                                </div>
                            </div>
                            <div class="col-md-4 company_email_div">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Company Email</label>
                                    <input type="email" name="company_email" id="company_email"
                                        class="form-control form-control-submit" placeholder="Company Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Contact Person Name</label>
                                    <input type="text" name="contact_person_name" id="contact_person_name"
                                        class="form-control form-control-submit" placeholder="Contact Person Name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Contact Person Phone</label>
                                    <input type="tel" name="contact_person_phone" id="contact_person_phone"
                                        class="form-control form-control-submit" placeholder="Contact Person Phone"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Contact Person Email</label>
                                    <input type="email" name="contact_person_email" id="contact_person_email"
                                        class="form-control form-control-submit" placeholder="Contact Person Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-light-black fw-600" id="address_label">Business/Service Address</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-submit"
                                        placeholder="Business/Service Address">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-light-black fw-600">Description</label>
                                    <textarea class="form-control form-control-submit" id="description" name="description" rows="6"
                                        placeholder="Short Description About your Business / Services"></textarea>
                                </div>
                                <button type="submit" class="btn-second btn-submit full-width">Register</button>
                                <div class="server_response w-100"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</x-guest-layout>
