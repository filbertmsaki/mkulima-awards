@php($topheader = false)
@php($header = false)
@php($footer = false)
<x-guest-layout :topheader="$topheader" :header="$header" :footer="$footer">
    @section('title', 'Home Page')
    @push('css')
    @endpush
    @push('scripts')
    @endpush
    @push('modals')
    @endpush

    <div class="inner-wrapper">
        <div class="container-fluid no-padding">
            <div class="row no-gutters overflow-auto d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="section-2 user-page main-padding">
                        <div class="login-sec">
                            <div class="login-box">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <h4 class="text-light-black fw-600">Sign In</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="text-light-white fs-14">Email Address</label>
                                                <input type="email" name="email"
                                                    class="form-control form-control-submit  @error('email') is-invalid @enderror" placeholder="Email Address"
                                                    required value="{{ old('email') }}">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="text-light-white fs-14">Password</label>
                                                <input type="password" id="password-field" name="password"
                                                    class="form-control form-control-submit" placeholder="Password"
                                                    required>
                                                <div data-name="#password-field"
                                                    class="fa fa-fw fa-eye field-icon toggle-password"></div>
                                            </div>
                                            <div class="form-group checkbox-reset">
                                                <label class="custom-checkbox mb-0">
                                                    <input type="checkbox" name="remember"> <span
                                                        class="checkmark"></span> Keep me signed in</label> <a
                                                    href="#">Reset password</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn-second-2 btn-submit full-width">Sign
                                                    in</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
