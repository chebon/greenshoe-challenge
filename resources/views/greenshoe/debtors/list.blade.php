
@extends('greenshoe.layouts.app')

@include('greenshoe.layouts.datatables')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Data Tables
                <small>advanced tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- /.box -->

                    <div class="box">
                        <div class="box-header" style=" padding-bottom: 0px; ">
                            <h3 class="box-title">Data Table With Full Features</h3>

                            <div class="col-lg-12" style="padding-left: 0px;">
                                <div class="col-lg-2" style="padding-left: 0px;">
                                <form id="exportForm" role="form"  action="/debtor/export" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Export</label>
                                        <select onchange="$('#exportForm').submit()" id="exportFormart" name="exportFormart" class="form-control">
                                            <option>Choose Format</option>
                                            <option value="1">Excel</option>
                                            <option value="2">Csv</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="debtorsList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th># id</th>
                                    <th>Phone Number</th>
                                    <th>Id Number</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Issue Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th># id</th>
                                    <th>Phone Number</th>
                                    <th>Id Number</th>
                                    <th>Loan Amount</th>
                                    <th>Loan Issue Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function() {
            $('#debtorsList').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('debtors.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'mobile_number', name: 'Phone Number' },
                    { data: 'national_id', name: 'Id Number' },
                    { data: 'detail.loan_amount', name: 'Amount' },
                    { data: 'detail.loan_issue_date', name: 'created_at' },
//                {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection