@extends('layouts.sbk')

@section('content')                        
                <div class="row">
                    <div class="col-12">                   
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive mt-4">
                                    <table id="config-table" class="table display table-bordered table-striped no-wrap">
                                        <thead>
                                            <tr>
                                                <th>C ID</th>
                                                <th>Company Name</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                                <th>Domain</th>
                                                <th>Sub-Domain</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tenants as $key)
                                            <tr>
                                                <td>{{$key->id}}</td>
                                                <td>{{$key->companyName}}</td>
                                                <td>{{$key->firstName}}</td>
                                                <td>{{$key->lastName}}</td>
                                                <td>{{$key->userName}}</td>
                                                <td>{{$key->subdomain}}</td>
                                                <td>{{$key->alias_domain}}</td>
                                                <td>
                                                    <a href="{{route('tenant.edit',$key->id)}}" class="btn btn-primary">Edit</a>
                                                    <a href="#" class="btn btn-warning">Del</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('scripts')
    <script src="../assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

    <script>
        $('#example23').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            columnDefs: [
                { responsivePriority: 3, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('#config-table').DataTable({
            responsive: true
        });
    </script>
@endsection