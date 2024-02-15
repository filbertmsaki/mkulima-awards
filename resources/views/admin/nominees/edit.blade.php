<x-app-layout>
    @section('title', 'Update Nominee')
    @push('css')
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
                theme: 'bootstrap4'
            })
            var individual = "{{ EntryEnum::Individual->value }}"
            var selected_enrty = $("#entry option:selected").val();
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

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.award-nominee.update',$nominee->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Choose the Award Category</label>
                                <select class="form-control select2bs4" id="category_id" name="category_id[]" multiple="multiple"
                                    style="width: 100%;" required>
                                    <option value="">Select Award Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, old('category_id', $nominee->categories_ids)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="entry">Choose Award Entry</label>
                                <select class="form-control select2bs4" name="entry" id="entry"
                                    style="width: 100%;" required>
                                    @foreach (EntryEnum::cases() as $entry)
                                        <option value="{{ $entry->value }}"
                                            {{ old('status', $nominee->entry->value) != $entry->value ?: 'selected' }}>
                                            {{ $entry->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service_name" id="service_name_label">Service/ Business Name</label>
                                <input type="text" id="service_name" name="service_name"
                                    placeholder="Enter Service/ Business Name" class="form-control"
                                    value="{{ old('service_name', $nominee->service_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 company_phone_div">
                            <div class="form-group">
                                <label for="company_phone">Company Phone</label>
                                <input type="text" id="company_phone" name="company_phone" class="form-control"
                                    placeholder="Enter Company Phone"
                                    value="{{ old('company_phone', $nominee->company_phone) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 company_email_div">
                            <div class="form-group">
                                <label for="company_email">Company Email</label>
                                <input type="text" id="company_email" name="company_email" class="form-control"
                                    placeholder="Enter Company Email"
                                    value="{{ old('company_email', $nominee->company_email) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Contact Person Name</label>
                                <input type="text" id="contact_person_name" name="contact_person_name"
                                    class="form-control" placeholder="Enter Contact Person Name"
                                    value="{{ old('contact_person_name', $nominee->contact_person_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_person_phone">Contact Person Phone</label>
                                <input type="tel" id="contact_person_phone" name="contact_person_phone"
                                    class="form-control" placeholder="Phone eg: 0*********"
                                    value="{{ old('contact_person_phone', $nominee->contact_person_phone) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_person_email">Contact Person Email</label>
                                <input type="email" id="contact_person_email" name="contact_person_email"
                                    class="form-control" placeholder="Enter Contact Person Email"
                                    value="{{ old('contact_person_email', $nominee->contact_person_email) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address" id="address_label">Business/Service Address</label>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Enter Business/Service Address"
                                    value="{{ old('address', $nominee->address) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="verified">Verified</label>
                                <select class="form-control select2bs4" id="verified" name="verified"
                                    style="width: 100%;" required>
                                    <option value="">Select Status</option>
                                    @foreach (VerifiedEnum::cases() as $verification)
                                        <option value="{{ $verification->value }}"
                                            {{ old('status', $nominee->verified->value) != $verification->value ?: 'selected' }}>
                                            {{ $verification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"
                                placeholder="Short Description About your Business / Services" required rows="5">{{ old('description', $nominee->description) }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success float-right">Update Nominee</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->

</x-app-layout>
