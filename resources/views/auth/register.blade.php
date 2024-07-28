<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

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
        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ isset($student) ? $student->date_of_birth : '' }}" required>
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
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ isset($student) ? $student->email : '' }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required @disabled(!auth()->user()->can('update-role'))>
                @foreach(\App\Enums\UserRole::cases() as $role)
                    <option value="{{ $role->value }}" @selected(isset($student) && $student->role === $role->value)>
                        {{ $role->label() }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <label for="city">Город:</label>
        <input type="text" id="city" name="address[city]" value="{{ old('address.city') }}" required><br>

        <label for="street">Улица:</label>
        <input type="text" id="street" name="address[street]" value="{{ old('address.street') }}" required><br>

        <label for="house">Дом:</label>
        <input type="text" id="house" name="address[house]" value="{{ old('address.house') }}"><br>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
