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
                },{
                    "data": "user.email",
                },{
                    "data": "status",
                },  {
                    "data": "user",
                    "render": function(name) {
                        return `<div class=" text-center">
                                    <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
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
        <!-- component -->
        <div class="bg-gradient-to-bl flex  font-bold mb-6 ">
            <h1 class="text-3xl	">Admin Dashboard Management</h1>
        </div>
        <div class="bg-gradient-to-bl flex items-center justify-center ">
            <div class="container mx-auto mx-auto p-4">
                <div class="">
                    <!-- Replace this with your grid items -->
                    <div class="bg-white rounded-lg border p-4">
                        <div class="px-1 py-4">
                            <div class="font-bold text-xl mb-2">My Task</div>
                            <div class="">
                                <div class="">
                                    <table class="table-auto w-full mt-4 display nowrap"  style="width: 100%" id="table">
                                        <thead class="">
                                          <tr class="">
                                            <th class="border-separate border-spacing-2  border border-slate-400">Name</th>
                                            <th class="border-separate border-spacing-2 border border-slate-400">Description</th>
                                            <th class="border-separate border-spacing-2 border border-slate-400">User Name</th>
                                            <th class="border-separate border-spacing-2 border border-slate-400">Status</th>
                                            <th class="border-separate border-spacing-2 border border-slate-400">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
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
                                            <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
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
                                            <td class="border-separate border-spacing-2 border border-slate-400 p-4">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
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
                            <a class="mt-6 lg:inline-block py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200"
                                href="{{route('user.task.create')}}">Create Task</a>
                        </div>
                    </div>
                    <!-- Add more items as needed -->
                </div>
            </div>
        </div>

    </div>
@endsection
