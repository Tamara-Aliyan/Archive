<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="name" class="form-label" >Name</label>
                    <input name="name" class="form-control" type="text" id="name" value="{{ $user->name }}" required autocomplete="name">
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" >Email</label>
                    <input name="email" class="form-control" type="email" id="email" value="{{ $user->email }}" required autocomplete="username">
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="birthday" class="form-label" >Birthday</label>
                    <input name="birthday" class="form-control" type="date" id="birthday" value="{{ $user->birthday }}" required autocomplete="birthday">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label" >Mobile</label>
                    <input name="mobile" class="form-control" type="text" id="mobile" value="{{ $user->mobile }}" required autocomplete="mobile">
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="img" class="form-label" >Image</label>
                    <input name="img" class="form-control" type="file" accept="image/*" id="img" value="{{ $user->img }}">
                </div>
            </div>
        </div>



        <div class="flex items-center gap-4">
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}
            <button class="btn btn-primary" type="submit">Save</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
