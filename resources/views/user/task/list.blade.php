@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                ajax: `{{ route('user.task.list') }}`,
                responsive: true,
                processing: true,
                serverSide: true,
                columns: [{
                    "data": "name",
                }, {
                    "data": "description",
                }, {
                    "data": "user.email",
                }, {
                    "data": "status",
                }, {
                    "data": "due_date",
                }, {
                    "data": "id",
                    "render": function(id) {
                        return `<div class=" text-center">
                            <a href="task/edit/${id}"" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                    <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                                </div>`;
                    }
                }, ]
            });
        });
    </script>
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="text-3xl font-bold">
            <h1>Task List</h1>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 mt-8">
            <div>
                <a href="{{ route('user.task.create') }}" class="bg-blue-500 p-2 rounded-md mt-4">Create Task</a>
            </div>
            <table class="table-auto w-full mt-4 display nowrap" style="width: 100%" id="table">
                <thead class="">
                    <tr class="">
                        <th class="border-separate border-spacing-2  border border-slate-400">Name</th>
                        <th class="border-separate border-spacing-2 border border-slate-400">Description</th>
                        <th class="border-separate border-spacing-2 border border-slate-400">User Name</th>
                        <th class="border-separate border-spacing-2 border border-slate-400">Status</th>
                        <th class="border-separate border-spacing-2 border border-slate-400">Date</th>
                        <th class="border-separate border-spacing-2 border border-slate-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next
                            Stop, Pottersville)</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">Malcolm Lockyer</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                            <div class=" text-center">
                                <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next
                            Stop, Pottersville)</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">Malcolm Lockyer</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                            <div class=" text-center">
                                <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next
                            Stop, Pottersville)</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">Malcolm Lockyer</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">1961</td>
                        <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                            <div class=" text-center">
                                <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
