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
                    <form action="{{ route('products.store') }}" method="POST"> @csrf
                        <input type="hidden" name="unit_name" value="pcs">
                        <input type="hidden" name="p_type" value="service">
                        <input type="hidden" name="isactive" value="1">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="p_name">Name</label>
                                <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter Product Name" autocomplete="off" required>
                            </div>
                        </div>
                    <div class="col-12 row">
                        <div class="form-group col-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.1" min="0" max="1000000" class="form-control" id="price" name="price" placeholder="Enter Price like 5.50" autocomplete="off">
                        </div>
                        <div class="form-group col-6">
                            <label for="hsn_sac_code">HSN / SAC</label>
                            <input type="text" class="form-control" id="hsn_sac_code" name="hsn_sac_code" placeholder="Enter HSN / SAC Code" autocomplete="off">
                        </div>
                    </div>
                        
                        <div class="col-12 row">
                        <div class="col-6">
                                <p class="mb-0">Taxable</p>
                                <input type="checkbox" checked>
                        </div>
                            <div class="col-6">
                                <fieldset class="form-group" id="taxrate_idFieldset">
                                    <label for="taxrate_id">Tax Rate</label>
                                    <select class="form-control select2" id="taxrate_id" name="taxrate_id" placeholder="Choose Tax Rate">
                                        <option value="">Select Option</option>
                                        @foreach ($taxrates->where('isactive','1') as $tax)
                                            <option value="{{$tax->id}}">{{$tax->tax_name}}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
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
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->p_name}}</td>
                                    <td>{{$product->price}}</td>
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
