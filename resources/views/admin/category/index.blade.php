@include('admin.top-header')

@section('page_title', 'Manage Category')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manage Category
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-categories.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">


                        <table class="table table-striped table-hover">

                            <thead class="thead-light">

                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Icon</th>
                                    <th>Parent Category</th>
                                    <th>Popular</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($categories as $category)

                                    <tr>

                                        <td>{{$category->id}}</td>

                                        <td>{{$category->name}}</td>

                                        <td>{{$category->slug}}</td>
                                        <td><i class="{{$category->icons}}"></i></td>

                                        <td>
                                            {{ $category->parent->name ?? 'Main Category' }}
                                        </td>

                                        <td>

                                            @if($category->is_popular)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-secondary">No</span>
                                            @endif

                                        </td>

                                        <td>

                                            @if($category->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Deactivate</span>
                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.manage-categories.edit', $category->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.manage-categories.destroy', $category->id) }}"
                                                method="POST" style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this category?')">
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="pull-right">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')