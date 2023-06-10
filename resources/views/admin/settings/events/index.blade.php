<x-app-layout>
    @section('title', 'Event Settings')
    @push('css')
    @endpush
    @push('scripts')
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
            <div class="card-header">
                <h6>Award Registration Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.events.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="award_registration_value" value="award_registration">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="award_registration_status">Registration Status</label>
                                <select class="form-control select2bs4" id="award_registration_status"
                                    name="award_registration_status" style="width: 100%;" required>
                                    <option value="">Select Status</option>
                                    @foreach (EventStatusEnum::cases() as $verification)
                                        <option value="{{ $verification->value }}"
                                            {{ old('status', @$award_registration->status->value) != $verification->value ?: 'selected' }}>
                                            {{ $verification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="award_registration_start_date"
                                    id="award_registration_start_date_label">Start Date </label>
                                <input type="date" id="award_registration_start_date"
                                    name="award_registration_start_date" class="form-control"
                                    placeholder="Enter Start Date"
                                    value="{{ @$award_registration->start_date == null ?'': date('Y-m-d', strtotime($award_registration->start_date)) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="award_registration_end_date" id="award_registration_end_date_label">End
                                    Date</label>
                                <input type="date" id="award_registration_end_date"
                                    name="award_registration_end_date" class="form-control" placeholder="Enter End Date"
                                    required value="{{ @$award_registration->end_date == null ?'': date('Y-m-d', strtotime($award_registration->end_date)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h6>Voting Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.events.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="voting_value" value="voting">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="voting_status">Voting Status</label>
                                <select class="form-control select2bs4" id="voting_status" name="voting_status"
                                    style="width: 100%;" required>
                                    <option value="">Select Status</option>
                                    @foreach (EventStatusEnum::cases() as $verification)
                                        <option value="{{ $verification->value }}"
                                            {{ old('status', @$voting->status->value) != $verification->value ?: 'selected' }}>
                                            {{ $verification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="voting_start_date" id="voting_start_date_label">Start Date </label>
                                <input type="date" id="voting_start_date" name="voting_start_date"
                                    class="form-control" placeholder="Enter Start Date"
                                    value="{{ @$voting->start_date == null ?'': date('Y-m-d', strtotime($voting->start_date)) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="voting_end_date" id="voting_end_date_label">End
                                    Date</label>
                                <input type="date" id="voting_end_date" name="voting_end_date" class="form-control"
                                    placeholder="Enter End Date" required
                                    value="{{ @$voting->end_date == null ?'': date('Y-m-d', strtotime($voting->end_date)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-right">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>

    </section>
    <!-- /.content -->

</x-app-layout>
