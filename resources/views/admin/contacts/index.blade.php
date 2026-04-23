@extends('vendor.voyager.master')

@section('page_title', 'Contact Us Enquiry')
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-briefcase"></i>
        Contact Us Enquiry
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">

    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover no-footer">
                    <thead>
                        <tr>
                            <th>Created On</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->mobile }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->message }}</td>
                                

                                <td class="text-right">
                                    <form action="{{ route('admin.contacts.destroy',$contact->id) }}"
                                        method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="voyager-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="pull-right">
                {{ $contacts->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@stop