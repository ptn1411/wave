<form action="{{ route('wave.settings.security.put') }}" method="POST" enctype="multipart/form-data">
    <div class="relative flex flex-col px-10 py-8">

        <div>
            <label for="current_password" class="block text-sm font-medium leading-5 text-gray-700">Current
                Password</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input id="current_password" type="password" name="current_password" placeholder="Current Password"
                    class="input input-bordered w-full max-w-full">
            </div>
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium leading-5 text-gray-700">New Password</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input id="password" type="password" name="password" placeholder="New Password"
                    class="input input-bordered w-full max-w-full">
            </div>
        </div>

        <div class="mt-5">
            <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">Confirm New
                Password</label>
            <div class="mt-1 rounded-md shadow-sm">
                <input id="password_confirmation" type="password" name="password_confirmation"
                    placeholder="Confirm New Password" class="input input-bordered w-full max-w-full">
            </div>
        </div>

        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="flex justify-end w-full mt-2">
            <button class="btn btn-outline btn-info px-4 py-2 mt-5" dusk="update-profile-button">Update</button>
        </div>

    </div>
</form>