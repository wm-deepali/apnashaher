@include('admin.top-header')

@section('page_title', 'Add FAQ')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.manage-faq.index') }}">Manage FAQ</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add FAQ
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add FAQ</strong>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.manage-faq.store') }}" method="POST">

                        @csrf

                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="question" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Answer</label>
                            <textarea name="answer" class="form-control" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>

                        <div class="form-group">
                            <label>Show on Home</label>
                            <select name="show_on_home" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Save FAQ
                        </button>

                        <a href="{{ route('admin.manage-faq.index') }}" class="btn btn-default">
                            Cancel
                        </a>

                    </form>


                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')