
@extends('greenshoe.layouts.app')

@include('greenshoe.layouts.datatables')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->

                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6 col-md-offset-3">
                    <!-- Horizontal Form -->

                    <!-- /.box -->
                    <!-- general form elements disabled -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Search Debtor By  Phone Or Id Number</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" id="debtorSearchForm" action="/debtors/search" method="post">
                            {{ csrf_field() }}
                                <!-- text input -->
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{$keyword or ''}}" class="form-control" placeholder="Enter Id Number or Phone Number">
                                </div>
                            </form>
                        </div>

                        <div class="box-footer" style="text-align: center;">
                            <button type="button" onclick="$('#debtorSearchForm').submit()" n class="btn btn-success">Search</button>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!-- /.box -->
                </div>

                <div class="col-md-12">
                    @if(isset($debtors) && !$debtors->isEmpty())
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Search Results</h3>

                                <table id="example2" class="table table-bordered table-hover">
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
                                    @foreach($debtors as $debtor)
                                        <tr>
                                            <td>{{$debtor->id}}</td>
                                            <td>{{$debtor->mobile_number}}</td>
                                            <td>{{$debtor->national_id}}</td>
                                            <td>{{$debtor->detail->loan_amount}}</td>
                                            <td>{{$debtor->detail->loan_issue_date}}</td>
                                        </tr>
                                    @endforeach
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
                        </div>
                        @elseif (isset($debtors) && $debtors->isEmpty())

                        <div class="col-md-12" style="text-align: center;">
                            <h3 class="box-title">Search Results </h3>
                            <h3 class="box-title" style=" color: #3c8dbc; ">No user match the mobile or Id number you provided</h3>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')

@endsection