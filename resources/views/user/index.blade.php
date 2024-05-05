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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
                    "data": "id",
                    "render": function(id) {
                        return `<div class="text-center">
                            <a href="user/task/edit/${id}"" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                    <a href="user/task/delete/${id}" class="bg-red-500 p-2 rounded-md ">Delete</a>
                                </div>`;
                    }
                }, ]
            });
        });

        $(document).ready(function() {
            $('#tablenotif').DataTable({
                ajax: `{{ route('user.task.notification') }}`,
                responsive: true,
                processing: true,
                serverSide: true,
                columns: [{
                    "data": "name",
                }, {
                    "data": "description",
                }, {
                    "data": "status",
                }, {
                    "data": "due_date",
                    "render": function(due_date) {
                        if (due_date > new Date().toISOString().slice(0, 10)){
                            var color = 'bg-green-500';
                        } else {
                            var color = 'bg-red-500';
                        }
                        return `<div class="${color}"><p>${due_date}</p></div>`;
                    }
                }, ]
            });
        });
    </script>

    <script>
        var yValues = [];

        $.ajax({
            url: `{{route('user.task.grafik')}}`,
            success: function(result) {
                yValues.push(result.TODO);
                yValues.push(result.PROGRESS);
                yValues.push(result.DONE);



        var xValues = ["TODO", "ON PROGRESS", "FINISHED"];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797"
        ];


        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Task Status Progress"
                }
            }
        });
    }
        });
    </script>
@endsection

@section('content')
    <div class="container mx-auto">
        <!-- component -->
        <div class="bg-gradient-to-bl flex  font-bold mb-6 ">
            <h1 class="text-3xl	">User Dashboard</h1>
        </div>
        <div class="bg-gradient-to-bl flex items-center justify-center ">
            <div class="container mx-auto mx-auto p-4">
                <div class="">
                    <!-- Replace this with your grid items -->
                    <div class="bg-white rounded-lg border p-4">
                        <div class="px-1 py-4">
                            <div class="font-bold text-xl mb-2">My Notification</div>
                            <div class="">
                                <div class="items-center justify-center">
                                    <canvas id="myChart" style="max-width: 600px" class="p-8"></canvas>
                                </div>
                                <div class="">
                                    <table class="table-auto w-full mt-4 display nowrap" style="width: 100%;"
                                        id="tablenotif">
                                        <thead class="">
                                            <tr class="">
                                                <th class="border-separate border-spacing-2  border border-slate-400">Name
                                                </th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">
                                                    Description</th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">Status
                                                </th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">Due
                                                    Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                            </tr>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                            </tr>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="px-1 py-4">
                            <div class="font-bold text-xl mb-2">My Task</div>
                            <div class="">
                                <div class="">
                                    <table class="table-auto w-full mt-4 display nowrap" style="width: 100%" id="table">
                                        <thead class="">
                                            <tr class="">
                                                <th class="border-separate border-spacing-2  border border-slate-400">Name
                                                </th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">
                                                    Description</th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">User
                                                    Name</th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">Status
                                                </th>
                                                <th class="border-separate border-spacing-2 border border-slate-400">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    <div class=" text-center">
                                                        <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                                        <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    <div class=" text-center">
                                                        <a href="" class="bg-blue-500 p-2 rounded-md">Edit</a>
                                                        <a href="" class="bg-red-500 p-2 rounded-md ">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">The
                                                    Sliding Mr. Bones (Next Stop, Pottersville)</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    Malcolm Lockyer</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
                                                <td class="border-separate border-spacing-2 border border-slate-400 p-4">
                                                    1961</td>
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
                                href="{{ route('user.task.create') }}">Create Task</a>
                        </div>
                    </div>
                    <!-- Add more items as needed -->
                </div>
            </div>
        </div>

    </div>
@endsection
