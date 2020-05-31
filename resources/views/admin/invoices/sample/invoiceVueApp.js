var app = new Vue({
    el: "#app",
    data: {
        lines: 1,

        //Basic Configuration
        prodCodeEnabled: false,
        discountEnabled: false,
        hsnEnabled: false,

        //State Code to decide whether Intra or Inter State Invoice
        sellerStateCode: 29,
        clientStateCode: 29,

        //All Sperate Taxables
        invoice_totaltableofrate5: 0,
        invoice_totaltableofrate12: 0,
        invoice_totaltableofrate18: 0,
        invoice_totaltableofrate28: 0,

        //All Seperate Tax rate wise amt
        totaltaxofrate5: 0,
        totaltaxofrate12: 0,
        totaltaxofrate18: 0,
        totaltaxofrate28: 0,

        //Final Totals
        invoice_subtotal: 0, //total of all tyaxables
        invoice_totaltax: 0, // total tax = a
        invoice_totalcgstsgst: 0, // a/2
        invoice_grandtotal: 0, // all tax + all taxabale

        //For Each Lines
        invoice_products: [
            {
                product_no: "",
                product_name: "",
                product_hsn: "",
                product_price: "",
                product_qty: "1",
                product_gstrate: "0",
                product_gstamt: "0",
                product_discount: "0",
                line_total: 0
            }
        ]
    },
    methods: {
        /* Row Manipulation */
        addNewRow() {
            this.lines += 1;
            this.invoice_products.push({
                product_no: "",
                product_name: "",
                product_hsn: "",
                product_price: "",
                product_qty: "1",
                product_gstrate: "0",
                product_gstamt: "0",
                product_discount: "0",
                line_total: 0
            });
        },
        deleteRow(index, invoice_product) {
            //Flag to count Lines
            this.lines -= 1;
            //Atleast One Line must be there
            if (this.lines >= 1) {
                var idx = this.invoice_products.indexOf(invoice_product);
                //console.log(idx, index);
                if (idx > -1) {
                    this.invoice_products.splice(idx, 1);
                }
                this.calculateTotal();
                this.calculateTotalGST();
            }
        },
        /* PS Calculations Starts */
        calcLineGstAmt(invoice_product) {
            //alert('ALert Alert');
            var rowPrice = parseFloat(invoice_product.product_price);
            var rowQty = parseFloat(invoice_product.product_qty);
            var rowGstRate = parseFloat(invoice_product.product_gstrate);
            var rowDiscount = parseFloat(invoice_product.product_discount);

            //total = total - (total * discount / 100);
            var rowTotal = rowPrice * rowQty;
            rowTotal = rowTotal - (rowTotal * rowDiscount) / 100;

            var rowGstAmt =
                rowTotal * (rowGstRate / 100) * (1 - rowDiscount / 100);

            //var gstamt = (rate * qty * (itemgstpercent / 100) * (1 - discount / 100));

            //updating GST Amt
            if (!isNaN(rowGstAmt)) {
                invoice_product.product_gstamt = rowGstAmt.toFixed(2);
            }
            //updating Total Value if Discount is there
            if (!isNaN(rowTotal)) {
                invoice_product.line_total = rowTotal.toFixed(2);
            }

            this.calculateTotal();
            this.calculateTotalGST();
        },

        /* PS Calculations Ends */
        /* Line Total  */
        calculateLineTotal(invoice_product) {
            var discount = parseFloat(invoice_product.product_discount);
            var total =
                parseFloat(invoice_product.product_price) *
                parseFloat(invoice_product.product_qty);
            total = total - (total * discount) / 100;
            //alert('after discount = ' + total);
            if (!isNaN(total)) {
                invoice_product.line_total = total.toFixed(2);
            }

            this.calculateTotal();
            this.calculateTotalGST();
        },
        /* Grand Total */
        calculateTotal() {
            var subtotal, total;

            subtotal = this.invoice_products.reduce(function(sum, product) {
                var lineTotal = parseFloat(product.line_total);
                if (!isNaN(lineTotal)) {
                    return sum + lineTotal;
                }
            }, 0);

            //Setting Subtotal value
            this.invoice_subtotal = subtotal.toFixed(2);

            //Calculation total Tax Again
            this.calculateTotalGST();

            //Recalculating Grand Total
            this.invoice_grandtotal =
                parseFloat(this.invoice_subtotal) +
                parseFloat(this.invoice_totaltax);
        },

        calculateTotalGST() {
            var totalTax;
            var invoice_totaltableofrate5 = 0,
                invoice_totaltableofrate12 = 0,
                invoice_totaltableofrate18 = 0,
                invoice_totaltableofrate28 = 0;
            var gsttaxat5 = 0,
                gsttaxat12 = 0,
                gsttaxat18 = 0,
                gsttaxat28 = 0;

            var gstamt, gstrate, lineTotal;

            totalTax = this.invoice_products.reduce(function(sum, product) {
                gstrate = parseFloat(product.product_gstrate);
                gstamt = parseFloat(product.product_gstamt);
                lineTotal = parseFloat(product.line_total);

                /*Logic for totaling tax @ rate wise starts */
                if (gstrate == 5) {
                    gsttaxat5 = parseFloat(gsttaxat5) + parseFloat(gstamt);
                    invoice_totaltableofrate5 =
                        parseFloat(invoice_totaltableofrate5) +
                        parseFloat(lineTotal);
                }

                if (gstrate == 12) {
                    gsttaxat12 = parseFloat(gsttaxat12) + parseFloat(gstamt);
                    invoice_totaltableofrate12 =
                        parseFloat(invoice_totaltableofrate12) +
                        parseFloat(lineTotal);
                }

                if (gstrate == 18) {
                    gsttaxat18 = parseFloat(gsttaxat18) + parseFloat(gstamt);
                    invoice_totaltableofrate18 =
                        parseFloat(invoice_totaltableofrate18) +
                        parseFloat(lineTotal);
                }

                if (gstrate == 28) {
                    gsttaxat28 = parseFloat(gsttaxat28) + parseFloat(gstamt);
                    invoice_totaltableofrate28 =
                        parseFloat(invoice_totaltableofrate28) +
                        parseFloat(lineTotal);
                }

                /*Logic for totaling tax @ 5% ends */

                if (!isNaN(gstamt)) {
                    return sum + gstamt;
                }
            }, 0);

            //Updating Analisys Table Tax Amt rate wise
            this.totaltaxofrate5 = gsttaxat5.toFixed(2);
            this.totaltaxofrate12 = gsttaxat12.toFixed(2);
            this.totaltaxofrate18 = gsttaxat18.toFixed(2);
            this.totaltaxofrate28 = gsttaxat28.toFixed(2);

            //Updating Analisys Table Taxable rate wise
            this.invoice_totaltableofrate5 = invoice_totaltableofrate5.toFixed(
                2
            );
            this.invoice_totaltableofrate12 = invoice_totaltableofrate12.toFixed(
                2
            );
            this.invoice_totaltableofrate18 = invoice_totaltableofrate18.toFixed(
                2
            );
            this.invoice_totaltableofrate28 = invoice_totaltableofrate28.toFixed(
                2
            );

            /*Setting total Tax*/
            this.invoice_totalcgstsgst = parseFloat(totalTax) / 2;
            this.invoice_totaltax = totalTax.toFixed(2);
        },
        //Dividing Parameter Vlues by 2
        divideByTwo(num1) {
            return parseFloat(num1) / 2;
        }

        /* End of Methods */
    }

    /* End of App */
});
