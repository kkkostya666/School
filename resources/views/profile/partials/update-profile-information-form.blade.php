<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form action="{{ route('profile.update')}}" method="post">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($student) ? $student->first_name : '' }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($student) ? $student->last_name : '' }}" required>
        </div>
        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" value="{{ isset($student) ? $student->surname : '' }}">
        </div>
        <x-select
            id="group_id"
            name="group_id"
            label="Group"
            :options="$groups"
            :selected="old('group_id')"
            required
        />
        <div class="form-group">
            <label for="address_array">Адрес</label>
            <input type="text" class="form-control" id="address_array" name="address_array" value="{{ isset($student) ? $student->address_array : '' }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email (Optional)</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ isset($student) ? $student->email : '' }}">
        </div>
            @if ($student instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $student->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <div class="container">
        <h1>{{ $student->name }}'s Profile</h1>

        <form action="{{ route('profile.updateAvatar', $student)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="avatar">Upload New Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" required>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Update Avatar</button>
            </div>
        </form>
    </div>
</section>
