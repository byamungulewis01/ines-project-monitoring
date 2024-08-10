<x-guest-layout>
    <div class="card mt-4">

        <div class="card-body p-4">
            <div class="text-center mt-2">
                <h5 class="text-primary">Create New Account</h5>
                <p class="text-muted">Get your INES mis account now.</p>
            </div>
            <div class="p-2 mt-4">
                <form method="POST" action="{{ route('student.register') }}">
                    @csrf
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" placeholder="Enter email address" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="reg_number" :value="__('Reg Number')" />
                        <x-text-input id="reg_number" type="text" name="reg_number" :value="old('reg_number')" required autofocus
                            autocomplete="reg_number" placeholder="Enter Reg Number" />
                        <x-input-error :messages="$errors->get('reg_number')" class="mt-1" />
                    </div>

                    <div class="mb-3">

                        <x-input-label for="password-input" :value="__('Password')" />
                        <div class="position-relative auth-pass-inputgroup mb-3">

                            <x-text-input id="password" placeholder="Enter password" class="pe-5 password-input"
                                type="password" name="password" required autocomplete="current-password" />

                            <button
                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-primary-button>
                            {{ __('Sign Up') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            <div class="mt-4 text-center">
                <p class="mb-0">Already have an account ?  <a href="{{ route('student.login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
            </div>
        </div>
        <!-- end card body -->
    </div>


</x-guest-layout>
