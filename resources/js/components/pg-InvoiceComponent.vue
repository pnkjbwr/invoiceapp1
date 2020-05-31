<template>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.sparksuite.com/images/logo.png"
                                     style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Invoice #: 123<br> Created: January 1, 2015<br> Due: February 1, 2015
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br> 12345 Sunny Road<br> Sunnyville, CA 12345
                            </td>

                            <td>
                                Acme Corp.<br> John Doe<br> john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td colspan="3">Payment Method</td>
                <td>Check #</td>
            </tr>

            <tr class="details">
                <td colspan="3">Check</td>
                <td>10000</td>
            </tr>

            <tr class="heading">
                <td>Item Name</td>
                <td>Price</td>
                <td>Qty</td>
                <td>GST[%]</td>
                <td>GST[Rs.]</td>
                <td>Total</td>
            </tr>
                        <tr class="item" v-for="item in items">
                            <td>
                                <vue-select class="vue-select2" v-model="item.selectedProduct" label="p_name"
                                            :options="products" :value="products.id"
                                            :searchable="true" language="en-US">
                                </vue-select>
                            </td>
                            <td><input type="number" v-model="item.selectedProduct.price"/></td>
                            <td><input type="number" v-model="item.selectedProduct.quantity"/></td>
                            <td><input type="text" v-if="item.selectedProduct.tax_rate" v-model="item.selectedProduct.tax_rate.tax_rate"/></td>
                            <td>
                                <span v-if="item.selectedProduct.quantity">
                                    {{ ( (item.selectedProduct.price * item.selectedProduct.quantity) * item.selectedProduct.tax_rate.tax_rate) / 100 }}
                                </span>
                                <span v-if="! item.selectedProduct.quantity">0</span>
                            </td>
                            <td>
                                <!-- <input v-if="item.selectedProduct.quantity" type="text" name="" id="" value="${{ subTotal( item.selectedProduct.price, item.selectedProduct.quantity)  }}"> -->
                                <span v-if="item.selectedProduct.quantity">
                                    {{ subTotal( item.selectedProduct.price, item.selectedProduct.quantity)  }}
                                </span>
                                <span v-if="! item.selectedProduct.quantity">0</span>
                            </td>
                        </tr>

            <tr>
                <td colspan="4">
                    <button class="btn-add-row" @click.prevent="addRow">Add row</button>
                </td>
            </tr>

            <tr class="total">
                <td colspan="5"></td>
                <td>
                    Total: <span v-if="selectedProduct.quantity">  {{ total | currency }} </span> 
                            <span v-if="! selectedProduct.quantity">0</span>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import 'vue-select/dist/vue-select.css';

    export default {
        props: ['products'],
        data() {
            return {
                name: "sample",
                selectedProduct: [],
                items: [],
            }
        },

        mounted() {

        },
        computed: {


            total() {
                return (this.subTotal + this.gst);
            },


        },
        methods: {
            addRow() {
                this.items.push({selectedProduct: ""});
            },

            subTotal(price,quantity) {
                return price * quantity;
            },



        },
        filters: {
            currency(value) {
                return value.toFixed(2);
            }
        }
    }
</script>
