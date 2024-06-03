@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        @if (Session::has('message'))
            <div class='alert alert-success'>
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class='alert alert-danger'>
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row justify-content-center px-2 py-2 rounded shadow p-3 mb-5 bg-white">
            @if (isset(Auth()->user()->role->permission['name']['employee']['can-add']))
                <div class="card ms-4 mt-3 me-4" style="border-bottom: 1px solid silver;">
                    <div class="panel-heading no-print mt-2 mb-2">
                        <div class="btn-group">
                            <a href="{{ Route('employee.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Employee
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mb-3 mt-3">
                <div class="col-sm-4">
                    <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset(Auth()->user()->role->permission['name']['employee']['can-add']))
                            <div class="input-group mt-2">
                                <input type="file" name="file" id="fileInput" placeholder="attached xlsx"
                                    class="form-control">
                                <button id="importButton" class="btn btn-outline-primary" disabled>Import</button>
                            </div>
                        @endif
                    </form>

                    <!-- Preview Button -->
                    @if (isset(Auth()->user()->role->permission['name']['employee']['can-add']))

                    <a href="../preview/employee_preview.xlsx" download class="text-primary text-decoration-none mt-1"><i
                            class="fa-solid fa-circle-info me-1"></i>Download sample template for file import</a>
                    @endif
                </div>

                <div class="col-sm-4 text-center mt-2">
                    <div class="dt-buttons btn-group border">
                        <form action="{{ route('employee.exportCsv') }}" method="get" target="_blank">
                            <button class="btn btn-default buttons-csv border buttons-html5 btn-sm">Csv</button>
                        </form>
                        <form action="{{ route('employee.download-excel') }}" method="post" target="_blank">@csrf
                            <button class="btn btn-default buttons-csv border buttons-html5 btn-sm">Excel</button>
                        </form>
                        <form action="{{ route('employee.exportPdf') }}" method="get" target="_blank">
                            <button class="btn btn-default buttons-csv border buttons-html5 btn-sm">Pdf</button>
                        </form>
                        <form action="{{ route('employee.printView') }}" method="get" target="_blank">
                            <button class="btn btn-default buttons-csv border buttons-html5 btn-sm">Print</button>
                        </form>
                    </div>
                </div>

                <div class="col-sm-4 mt-1 d-flex align-items-center justify-content-end">
                    <input id="searchInput" type="text" name="search" class="form-control" placeholder="Search..."
                        style="max-width: 200px;">
                </div>
            </div>


            <div class="card-body" id="employeeTableContainer">
                @include('admin.employee.employee_table', ['employees' => $employees])
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            var fileInput = document.getElementById('fileInput');
            var importButton = document.getElementById('importButton');

            if (fileInput.files.length > 0) {
                importButton.removeAttribute('disabled');
            } else {
                importButton.setAttribute('disabled', 'disabled');
            }
        });



        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value;
                fetchEmployees(query);
            });

            function fetchEmployees(query) {
                fetch(`{{ route('search.employee') }}?search=${query}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('employeeTableContainer').innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error fetching employee data'); // Add this line
                    });
            }
        });
    </script>
@endsection
@endsection
