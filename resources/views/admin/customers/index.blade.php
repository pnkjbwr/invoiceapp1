@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Create Customer</h5></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('customers.store') }}" method="POST" class="steps-validation wizard-circle" id="stepForm">
                            @csrf
                            <!-- Step 1 -->
                            <fieldset>
                                
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="cname" class="required">Full Name</label>
                                            <input type="text" class="form-control required mask_UPPERCASE" placeholder="Enter Customer Name" id="cname" name="cname" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="mobile1" class="required">Registered Mobile</label>
                                            <input type="text" class="form-control mask_mobile" id="mobile1" name="mobile1" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control mask_lowercase" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 2 -->
                            <fieldset>
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="firm">Company Name</label>
                                            <input type="text" class="form-control mask_UPPERCASE" id="firm" name="firm">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="panno">PAN NO</label>
                                            <input type="text" class="form-control mask_panno" id="panno" name="panno">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="gstno">GSTIN</label>
                                        <input type="text" class="form-control mask_UPPERCASE" id="gstno" name="gstno">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="gst_state_code">GST State Code</label>
                                        <input type="text" class="form-control mask_UPPERCASE" id="gst_state_code" name="gst_state_code">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="full_address">Full Address</label>
                                        <input type="text" class="form-control mask_UPPERCASE" id="full_address" name="full_address">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control mask_UPPERCASE" id="city" name="city">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="pincode">Pin Code</label>
                                            <input type="text" class="form-control mask_pincode" id="pincode" name="pincode">
                                        </div>
                                    </div>
                                

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" class="form-control mask_UPPERCASE" id="state" name="state">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control mask_UPPERCASE" id="country" name="country">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="record_created_by" class="required">Record Created By</label>
                                            <input type="text" class="form-control" id="record_created_by" name="record_created_by" value="{{auth()->user()->name}}" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- Step 3 -->
                            <fieldset>
                                <div class="row">
                                    <input type="submit" value="Add New" class="btn btn-info">
                                </div>                                
                            </fieldset>
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
                                <td>cname</td>
                                <td>mobile1</td>
                                <td>email</td>
                                <td>firm</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{$customer->cname}}</td>
                                    <td>{{$customer->mobile1}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->firm}}</td>
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
