@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Create New Tax Rate</h5></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('taxrates.store') }}" method="POST"> @csrf
                        <input type="hidden" name="isactive" value="1">
                        <div class="form-group">
                            <label for="tax_rate">Tax Rate (%)</label>
                            <input type="number" step="0.1" min="0" max="1000" class="form-control" id="tax_rate" name="tax_rate" placeholder="Enter Taxrate like 5.50" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="tax_name">Tax Name</label>
                            <input type="text" class="form-control" id="tax_name" name="tax_name" placeholder="Enter Taxname" autocomplete="off" required>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            &nbsp;&nbsp;<button type="reset" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- Hoverable rows start -->
                    <div class="row" id="table-hover-row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Tax Rates</h4>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>tax_rate</th>
                                                    <th>tax_name</th>
                                                    <th>Activated</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($taxrates as $tax)
                                                    <tr>
                                                        <td>{{$tax->id}}</td>
                                                        <td>{{$tax->tax_rate}}</td>
                                                        <td>{{$tax->tax_name}}</td>
                                                        <td>
                                                            @if ($tax->isactive == 1) YES @else NO @endif
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
                    <!-- Hoverable rows end -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
