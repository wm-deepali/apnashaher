@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content container-fluid">

        <div class="card">
            <div class="card-header"><strong>Profile Setting</strong></div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.setting.update') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-8">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                                <small>Leave empty to keep same</small>
                            </div>

                        </div>

                        <div class="col-md-4 text-center">

                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" width="150" class="mb-3">
                            @endif

                            <input type="file" name="image" class="form-control">

                        </div>

                    </div>

                    <button class="btn btn-success mt-4">
                        <i class="fa fa-save"></i> Save
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')