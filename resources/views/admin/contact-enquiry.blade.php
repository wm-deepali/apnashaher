@extends('admin.master')

@section('content')
    <div class="space-y-6">

        <h1 class="text-2xl font-bold mb-4">Contact Enquiries</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Message</th>
                        <th class="py-2 px-4 text-left">Submitted At</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>

    </div>
@endsection