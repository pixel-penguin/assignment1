<template>
  <div id="invoice">
    <div class="invoice overflow-auto">
      <div style="min-width: 600px">
        <header>
          <div class="row">
            <div class="col">
              <a target="_blank" href="#">
                <img
                  src="https://res.cloudinary.com/pixel-penguin/image/upload/c_scale,h_100/v1582807680/pixel_penguin_logos/new/pixel_penguin_without_creative_solutions-01_xaejgv.png"
                  data-holder-rendered="true"
                />
              </a>
            </div>
            <div class="col company-details">
              <h2 class="name">
                <a target="_blank" href="#">PixelPenguin</a>
              </h2>
              <div>PixelPenguin Place</div>
              <div>(123) 456-789</div>
              <div>sample@email.com</div>
            </div>
          </div>
        </header>

        <main>
          <div class="row contacts">
            <div class="col invoice-to">
              <div class="text-gray-light">INVOICE TO:</div>
              <h2 class="to">John Doe</h2>
              <div class="address">The other street</div>
              <div class="email">
                <a href="mailto:john@example.com">john@example.com</a>
              </div>
            </div>
            <div class="col invoice-details">
              <h1 class="invoice-id">INVOICE {INSERT REFERENCE HERE}</h1>
              <div class="date">Date of Invoice: {INSERT DATE OF INVOICE HERE}</div>
              <div class="date">Due Date: {INSERT DATE OF INVOICE HERE + 14 DAYS}</div>
            </div>
          </div>

          <div>
            <div
              @click="insertNewProductModal = true"
              class="btn btn-primary"
            >Add new item to invoice</div>
          </div>

          <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>#</th>
                <th class="text-left">DESCRIPTION</th>
                <th class="text-right">PRICE</th>
                <th class="text-right">QUANTITY</th>
                <th class="text-right">TOTAL</th>
                <th class="text-right">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              
              <tr v-for="(invoiceItem, key) in invoiceItems" :key="key">
                <td class="no">{{invoiceItem.product.id}}</td>
                <td class="text-left">
                  <h3>{{invoiceItem.product.name}}</h3>
                  {PRODUCT DESCRIPTION}
                </td>
                <td class="unit">${{invoiceItem.product.price}}</td>
                <td class="qty">{{invoiceItem.quantity}}</td>
                <td class="total">${{ invoiceItem.quantity * invoiceItem.product.price}}</td>
                <td><div @click="removeProductFromInvoice(key)" class="btn btn-danger">Delete</div></td>
              </tr>
              
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">SUBTOTAL</td>
                <td>${{subTotal}}</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">TAX 25%</td>
                <td>${{percentagePrice}}</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td colspan="2">GRAND TOTAL</td>
                <td>${{totalPrice}}</td>
              </tr>
            </tfoot>
          </table>
          <div class="thanks">
            <div v-if="loading == false" @click="saveInvoiceToDatabase" class="btn btn-primary">Save Invoice</div>
            <div v-else class="btn btn-primary">Loading</div>
            Thank you!
          </div>
          <div class="notices">
            <div>NOTICE:</div>
            <div
              class="notice"
            >A finance charge of 1.5% will be made on unpaid balances after due date.</div>
          </div>
        </main>
        <footer>This is just a project and nothing more</footer>
      </div>
      <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
      <div></div>
    </div>

    <simple-modal v-model="insertNewProductModal" title="Insert New Item">
      <template slot="body">
        <form @submit="addNewRowToInvoice">
          <div class="form-group">
            <label for="itemQuantity">Quantity of Item</label>
            <input v-model="newItem.quantity" id="itemQuantity" class="form-control" type="number" required />
          </div>

          <div class="form-group">
            <label for="productItem">Product</label>
            <select v-model="newItem.invoice_item_product_id" id="productItem" class="form-control" required>
              <option
                v-for="invoiceItemProduct in invoiceItemProducts"
                :key="invoiceItemProduct.id"
                :value="invoiceItemProduct.id"
              >{{invoiceItemProduct.name}}</option>
            </select>
          </div>

          <button class="btn btn-primary" type="submit">Add button to Invoice</button>
        </form>
      </template>
      <template slot="footer">
        <button>OK</button>
      </template>
    </simple-modal>
  </div>
</template>

<script>
import SimpleModal from "simple-modal-vue";

export default {
  data() {
    return {
      
      totalPrice: 0,
      subTotal: 0,
      percentagePrice: 0,

      loading: false,
      insertNewProductModal: false,

      invoiceItemProducts: [],

      invoiceItems: [],

      newItem: {
        quantity: 1,
        invoice_item_product_id: 0
      }
    };
  },
  components: { SimpleModal },
  mounted() {
    const self = this;

    self.getAllInvoiceItemProducts();
  },
  methods: {

    generateNewItemRow(invoice_item_product_id, quantity, price, product) {
      return {
        id: null,
        invoice_id: null,
        invoice_item_product_id: invoice_item_product_id,
        quantity: quantity,
        price: price,
        product:product
      };
    },
    removeProductFromInvoice(key){
      const self = this;

      self.invoiceItems.splice(key, 1);
    },
    addNewRowToInvoice(e){
      const self = this;
      e.preventDefault();

      var productSelect = self.invoiceItemProducts.find(x => x.id === self.newItem.invoice_item_product_id);

      
      var newRow = self.generateNewItemRow(self.newItem.invoice_item_product_id, self.newItem.quantity, productSelect.price, productSelect);

      //console.log(newRow);

      self.invoiceItems.push(newRow);

      //console.log(self.invoiceItems);

      self.calculateAllPrices();


    },

    saveInvoiceToDatabase(){
      const self = this;

      self.loading = true;

      Vue.axios.post('/invoice/store',{
        invoiceItems: self.invoiceItems,
        totalPrice: self.totalPrice,
        subTotal: self.subTotal,
        percentagePrice: self.percentagePrice
      }).then(response =>{
        
        var data = response.data;
        
        if(data.success == true){
          window.location = '/invoice';
        }

        console.log(date);

        self.loading = false;

      })
      .catch(error =>{
        self.loading = false;
      })

    },

    getAllInvoiceItemProducts() {
      const self = this;

      Vue.axios
        .get("/invoice/invoiceitemproducts/get")
        .then(response => {
          var data = response.data;

          if (data.success == true) {
            self.invoiceItemProducts = data.data;
          } else {
            alert(data.message);
          }
          //console.log(data);

          //self.invoiceItemProducts = response.data.data;
        })
        .catch(error => {});
    },
    calculateAllPrices(){
      const self = this;

      var totalPrice = 0;

      self.invoiceItems.forEach(function (item, key) {
  
        totalPrice += item.quantity * item.product.price;

      })
      
      self.totalPrice = totalPrice;

      self.percentagePrice = (25/100) * self.totalPrice;

      self.subTotal = self.totalPrice - self.percentagePrice;
    }
  }
};
</script>