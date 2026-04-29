@include('admin.top-header')

<style>
    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .form-check-input {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .form-check-label {
        margin: 0;
        cursor: pointer;
    }
</style>

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

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.manage-categories.index') }}">Manage Category</a>
                    </li>

                    <li class="breadcrumb-item active">
                        @if(isset($category))
                            Edit Category
                        @else
                            Add Category
                        @endif
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>
                        @if(isset($category))
                            Edit Category
                        @else
                            Add Category
                        @endif
                    </strong>
                </div>

                <div class="card-body">

                    <form method="POST" @if(isset($category))
                    action="{{ route('admin.manage-categories.update', $category->id) }}" @else
                        action="{{ route('admin.manage-categories.store') }}" @endif>

                        @csrf

                        @if(isset($category))
                            @method('PUT')
                        @endif


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $category->name ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        value="{{ $category->slug ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" name="icons" class="form-control"
                                        value="{{ $category->icons ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"
                                        value="{{ $category->meta_title ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tags</label>
                                    <input type="text" name="tags" class="form-control"
                                        value="{{ $category->tags ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select name="parent_id" class="form-control">

                                        <option value="">Main Category</option>

                                        @foreach($categories as $cat)

                                            <option value="{{$cat->id}}" @if(isset($category) && $category->parent_id == $cat->id) selected @endif>
                                                {{$cat->name}}
                                            </option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>

                                    <select name="status" class="form-control">

                                        <option value="active" @if(isset($category) && $category->status == 'active')
                                        selected @endif>
                                            Active
                                        </option>

                                        <option value="deactive" @if(isset($category) && $category->status == 'deactive')
                                        selected @endif>
                                            Deactivate
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control">
            {{ $category->meta_description ?? '' }}
            </textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
    <div class="form-group">
        <label>Title (H1)</label>
        <input type="text" name="title" class="form-control"
               value="{{ $category->title ?? '' }}">
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Short Description</label>
        <textarea name="short_description" class="form-control" rows="3">
{{ $category->short_description ?? '' }}
        </textarea>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label>Detail Content (SEO Content)</label>
        <textarea name="detail_content" class="form-control" rows="6">
{{ $category->detail_content ?? '' }}
        </textarea>
    </div>
</div>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_popular" value="1"
                                        @if(isset($category) && $category->is_popular) checked @endif>
                                    <label class="form-check-label">Popular Category</label>
                                </div>
                            </div>

                        </div>

                        <button class="btn btn-primary mt-4">
                            @if(isset($category))
                                Update Category
                            @else
                                Create Category
                            @endif
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        $('#name').on('keyup', function () {
            let slug = $(this).val()
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace('-board-academic-coachings', '')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');

            $('#slug').val(slug);
        });

    });
</script>
@include('admin.footer')