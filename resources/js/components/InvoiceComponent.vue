<template>
    <div class="container">
        <div class="col-12">
        <div id="app">
            <form action="#" method="post" id="invoiceForm">
                <!-- csrf -->
            
                <input type="hidden" name="finalTaxable0" id="finalTaxable0" value="">
                <input type="hidden" name="finalTaxable5" id="finalTaxable5" value="">
                <input type="hidden" name="finalTaxable12" id="finalTaxable12" value="">
                <input type="hidden" name="finalTaxable18" id="finalTaxable18" value="">
                <input type="hidden" name="finalTaxable28" id="finalTaxable28" value="">
            
                <input type="hidden" name="finalTotalTax" id="finalTotalTax" value="">
                <input type="hidden" name="finalTotalTaxable" id="finalTotalTaxable" value="">
                <input type="hidden" name="finalGT" id="finalGT" value="">
            
                
                <div class="row no-margin">
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <h4>Invoice To</h4>
                        <div class="form-group">
                            <label for="clientCompanyName">Customer Name</label>
                            <input type="text" class="form-control" name="clientCompanyName" id="clientCompanyName"
                                placeholder="Company Name" value="PANKAJ SANKHLA">
                        </div>
                        <div class="form-group">
                            <label for="clientAddress">Address</label>
                            <textarea class="form-control" rows='3' name="clientAddress" id="clientAddress"
                                placeholder="Your Address">Beawar Rajasthan - 305901</textarea>
                        </div>
                        <div class="form-group">
                            <label for="supplyPlaceState">Place of Supply</label>
                            <select class="form-control" id="supplyPlaceState" name="supplyPlaceState" v-model="clientStateCode">
                                <option value="0">Select State</option>
                                <option value="29">29-[KA] Karnataka</option>
                                <option value="32">32-[KL] Kerala</option>
                                <option value="31">31-[LD] Lakshadweep Islands</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-left: 30%" class='col-xs-12 col-md-4 col-lg-4 float-right'>
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="invoiceNo">Invoice No.</label>
                            <input type="number" class="form-control" name="invoiceNo" id="invoiceNo" placeholder="Invoice No"
                                value="1001">
                        </div>
                        <div class="form-group">
                            <label for="invoiceDate">Invoice Date</label>
                            <input type="text" class="form-control" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="amountDueTop">Previous Due</label>
                            <input type="number" class="form-control amountDue" id="amountDueTop" name="amountDueTop"
                                placeholder="Amount Due" value="1000" readonly>
                        </div>
                    </div>
                </div>
            
                <hr>
            
                <table class="table table-striped table-bordered" id="data">
                    <tr>
                        <th scope="col">#Del</th>
                        <th scope="col" style="width: 20%">Item Name</th>
                        <th scope="col text-right">Price</th>
                        <th scope="col text-right">Qty</th>
                        <th scope="col text-right">GST[%]</th>
                        <th scope="col text-right">GST[&#8377;]</th>
                        <th scope="col text-right">Total</th>
                    </tr>
                    <tr v-for="(item, k) in items" :key="k">
                        <td scope="row" class="trashIconContainer">
                    <!-- <tr class="item" v-for="item in items"> -->
                            <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true" @click="deleteRow(k, item)"></i></button>
                            <!-- <i class="fa fa-trash" aria-hidden="true" @click="deleteRow(k, item)"></i> -->
                        </td>
                        <td style="">
                            <!-- <input class="form-control" type="text" v-model="invoice_product.product_name"/> -->
                            <!-- Item Name -->
                            <vue-select class="vue-select2" v-model="item.selectedProduct" label="p_name" :options="products" :value="products.id" :searchable="true" language="en-US">
                            </vue-select>
                        </td> 
                        <td>
                            <!-- Price -->
                            <input class="form-control text-right" type="number" min="0" step=".01" v-model="item.selectedProduct.price"
                              v-on:keyup="calcLine(item)"  />
                        </td>
                        <td>
                            <!-- Qty -->
                            <input class="form-control text-right" type="number" min="0" step=".01"  v-model="item.selectedProduct.qty"
                              v-on:keyup="calcLine(item)"  />
                        </td>
                        <td>
                            <!-- Tax Rate -->
                            <input type="text" v-if="item.selectedProduct.tax_rate" v-model="item.selectedProduct.tax_rate.tax_rate" v-on:change="calcLineGstAmt(item)" readonly/>
                        </td>
                        <td>
                            <!-- Tax Amt -->
                            <!-- <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="item.selectedProduct.gstamt"/> -->
                            <!-- calcLineGstAmt -->
                            <span v-if="item.selectedProduct.tax_rate.tax_rate">{{ calcLineGstAmt( item.selectedProduct.price, item.selectedProduct.qty,item.selectedProduct.tax_rate.tax_rate)  }}</span>
                            <span v-if="! item.selectedProduct.tax_rate.tax_rate">0.00</span>
                        </td>
                        <td>
                            <!-- Line Total -->
                            <!-- <input readonly class="form-control text-right" type="number" min="0" step=".01" v-model="item.selectedProduct.linetotal"/> -->
                            <span v-if="item.selectedProduct.qty">{{ calcLineTotal( item.selectedProduct.price, item.selectedProduct.qty)  }}</span>
                            <span v-if="! item.selectedProduct.qty">0</span>
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
                        <button id="addnew" class="btn btn-info addmore" type="button" @click.prevent="addRow">Add More</button>
                        <br>
            <br>
            <br>
            <br>
                        <input class="btn btn-primary" type="button" id="submitBtn" value="Create Invoice">
                        <input class="btn btn-info" type="submit" value="Back">
                    </div>
                    <!-- ************* -->
                    <div style="margin-left: 25%"
                        class='col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3'>
            
                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#8377;</span>
                                </div>
                                <input readonly min="0" type="number" class="form-control" name="invoice_subtotal"
                                placeholder="Subtotal" v-model="invoice_subtotal">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label v-if="sellerStateCode == clientStateCode">Total [CGST + SGST] : &nbsp;</label>
                            <label v-else>Total IGST Amount: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#8377;</span>
                                </div>
                                <input readonly min="0" type="number" class="form-control" name="tax_percent" id="totalTaxAmt" placeholder="Tax" v-model="invoice_totaltax">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Grand Total: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">&#8377;</span>
                                </div>
                                <input readonly min="0" type="text" class="form-control" name="invoice_total"
                                    id="grandTotal" v-model="invoice_grandtotal">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</template>

<script>
    import 'vue-select/dist/vue-select.css';

    export default {
        props: ['products'],
        data() {
            return {
                lines: 1,

                clientStateCode: "29",
                sellerStateCode: "29",

                //Basic Configuration
                prodCodeEnabled: false,
                discountEnabled: false,
                hsnEnabled: false,
                //Final Totals
                /* ---------- */
                invoice_subtotal: 0, //total of all tyaxables
                invoice_totaltax: 0, // total tax = a
                invoice_totalcgstsgst: 0, // a/2
                invoice_grandtotal: 0, // all tax + all taxabale
                /* ---------- */
                name: "sample",
                selectedProduct: [],
                items: [],
            }
        },

        mounted() {

        },
        computed: {


            


            },
        methods: {
            addRow() {
                
                console.log('add row lines = '+ this.lines);
                this.lines += 1;
                console.log('add row lines+1 = '+ this.lines);

                this.items.push({selectedProduct: {
                    istaxable:1, //setting default at new line
                    tax_rate: { //setting default at new line 0%
                        tax_rate:0,
                    },
                    price:0,
                    qty:1,

                }});
                this.calculateTotal();
                
            },
            deleteRow(index, item) {

                console.log('Delete Clicked Lines = '+ this.lines);
                
                //Flag to count Lines
                //Atleast One Line must be there
                if (this.lines >= 1) 
                {
                    this.lines -= 1;
                    var idx = this.items.indexOf(item);
                    //console.log(idx, index);
                    if (idx > -1) {
                        this.items.splice(idx, 1);
                    }
                    // this.calculateTotal();
                    // this.calculateTotalGST();
                }
                console.log('After Delete Clicked Lines = '+ this.lines);
                this.calculateTotal();
            },
            
            calcLineGstAmt(price,qty,rate) {
                var rowDiscount = parseFloat(0.00);
                var rowTotal = parseFloat(price) * parseFloat(qty);
                var rowGstRate = parseFloat(rate);
                var rowGstAmt = rowTotal * (rowGstRate / 100) * (1 - rowDiscount / 100);

                if (!isNaN(rowGstAmt)) {
                    return parseFloat(rowGstAmt).toFixed(2);
                }
                else
                {
                    return 0.00;
                }
                this.calculateTotal();
            },

            calcLineTotal(price,quantity) {

                var total = parseFloat(price * quantity).toFixed(2);
                if (!isNaN(total)) {
                    return total;
                }
                else{
                    return 0.00;
                }

                this.calculateTotal();
            },

            /* PS Calculations Ends */
            /* Line Total  */
            calcLine(item)
            {
                
                // var discount = 0;
                var rowDiscount = parseFloat(0.00);
                var rowPrice = parseFloat(item.selectedProduct.price);
                var rowQty = parseFloat(item.selectedProduct.qty);
                var rowTotal = rowPrice * rowQty;
                console.log('called line total = '+rowTotal );
                var rowGstRate = parseFloat(item.selectedProduct.tax_rate.tax_rate);
                var rowGstAmt = rowTotal * (rowGstRate / 100) * (1 - rowDiscount / 100);


                if (!isNaN(rowTotal)) {
                    item.selectedProduct.linetotal = rowTotal.toFixed(2);
                }
                else
                {
                    item.selectedProduct.linetotal = 0.00;
                }

                if (!isNaN(rowGstAmt)) {
                    item.selectedProduct.gstamt = rowGstAmt.toFixed(2);
                }
                else
                {
                    item.selectedProduct.gstamt = 0.00;
                }

                this.calculateTotal();
            },
            /* Grand Total */
            /* Grand Total */
            calculateTotal() 
            {

                console.log('calcTotal() called');
                
                var subtotal,total;
                // var lineTotal;

                subtotal = this.items.reduce(function(sum, item) {
                    var lineTotal = parseFloat(item.selectedProduct.linetotal);

                    if (!isNaN(lineTotal)) {
                        return sum + lineTotal;
                    }

                    return 0.00;
                }, 0);

                //Setting Subtotal value
                console.log('subtotal --> '+subtotal);
                this.invoice_subtotal = subtotal.toFixed(2);

                //Calculation total Tax Again
                // this.calculateTotalGST();

                //Recalculating Grand Total
                this.invoice_grandtotal = parseFloat(this.invoice_subtotal) + parseFloat(this.invoice_totaltax);
            },


        },
        filters: {
            currency(value) {
                return value.toFixed(2);
            }
        }
    }
</script>
