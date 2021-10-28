<template>
<div>
    <main class="checkout">
        <section class="details">
            <div class="cart">
                <div class="item-header">
                    <span class="iconify" data-inline="false" data-icon="fa-solid:shopping-bag" style="color: #000;"></span>
                    <h5>My Carts</h5>
                </div>
                <div class="item" v-for="cart in userCart" :key="cart.id">
                    <div class="product">
                        <div class="photo">
                            <img :src="cart.image" :alt="cart.name">
                        </div>
                        <div class="item-brand">
                            <p v-text="cart.type"></p>
                            <p v-text="cart.name"></p>
                            <p>{{ total }}</p>
                        </div>
                    </div>
                    <input type="number" name="amount" id="1" min="1" max="10" value="1">
                    <p class="price">Rp{{ cart.price }},-</p>
                </div>
            </div>
            <div class="total-amount">
                <div class="horizontal-divider"></div>
                <div class="item-amountM">
                    <p>Total Amounts:</p>
                    <p>Rp{{ total }}</p>
                </div>
            </div>
            <div class="delivery">
                <div class="item-header">
                    <span class="iconify" data-inline="false" data-icon="ic:round-local-shipping" style="color: #000;"></span>
                    <h5>Delivery Method</h5>
                </div>
                <div class="item-delivery">
                    <div class="radio-group">
                        <input type="radio" v-model="deliveryName" id="lc" value="Local Courier">
                        <label for="lc">Local Courier</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" v-model="deliveryName" id="tk" value="TIKI">
                        <label for="tk">TIKI</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" v-model="deliveryName" id="sp" value="Store Pickup">
                        <label for="sp">Store Pickup</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" v-model="deliveryName" id="jn" value="JNE">
                        <label for="jn">JNE</label>
                    </div>
                </div>
                <div class="total-amount">
                    <div class="horizontal-divider"></div>
                    <div class="item-amountM">
                        <p>Shipping Price:</p>
                        <p>Rp{{ deliveryPrice }}</p>
                    </div>
                </div>
            </div>
            <div class="payment-methodM">
                <div class="item-header">
                    <span class="iconify" data-inline="false" data-icon="ic:round-local-shipping" style="color: #000;"></span>
                    <h5>Payment Method</h5>
                </div>
                <div class="item-payment">
                    <div class="radio-group">
                        <input type="radio" name="pm" id="gp">
                        <label for="gp">Gopay</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="pm" id="pu">
                        <label for="pu">Pickup</label>
                    </div>
                </div>
                <div class="total-amount">
                    <div class="horizontal-divider"></div>
                    <div class="item-amountM">
                        <p>Shipping Price:</p>
                        <p>Rp{{ deliveryPrice }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="summary">
            <h5 class="title">
                Payment Summary
            </h5>
            <div class="sum-card">
                <div class="amount">
                    <div class="item-amount">
                        <div class="total-amount">
                            <p>Total Amounts</p>
                            <p>Rp{{ total }}</p>
                        </div>
                        <div class="del-amount">
                            <div class="del-met">
                                <p>Delivery</p>
                                <p>({{ deliveryName }})</p>
                            </div>
                            <p>Rp{{ deliveryPrice }}</p>
                        </div>
                    </div>
                    <div class="horizontal-divider"></div>
                    <div class="total-transaction">
                        <p>Total Transaction</p>
                        <p>Rp{{ totalAmount }},-</p>
                    </div>
                </div>
                <div class="payment-method">
                    <p>Payment Method</p>
                    <div class="methods">
                        <div class="radio-group">
                            <input type="radio" name="pm" id="gp">
                            <label for="gp">Gopay</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" name="pm" id="pu">
                            <label for="pu">Pickup</label>
                        </div>
                    </div>
                </div>
                <button class="bons bon-secondary" @click="checkout">Pay Now</button>
            </div>
        </section>
    </main>
    <section class="ctaM">
        <div class="total-price">
            <p>Total Transaction:</p>
            <p>Rp{{ totalAmount }},-</p>
        </div>
        <button class="bonb bon-secondary" @click="checkout">
            Pay Now
        </button>
    </section>
</div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'Checkout',
    methods: {
        checkout() {
            let productsId = this.userCart.map(product => {
                return product.id
            });

            let checkoutData = {
                'name': "Fariz Ramadhan",
                'email': "farizramadhan07@gmail.com",
                'number': "082136948293",
                'address': "Guna Jaya",
                'transaction_total': this.totalAmount,
                'transaction_status': "PENDING",
                'transaction_details': productsId
            }

            axios.post('http://127.0.0.1:8000/api/checkout', checkoutData)
                .then(() => this.$router.push('/'))
                .catch(err => console.log(err))
        }
    },
    data() {
        return {
            userCart: [],
            userData: {
                name: "Fariz Ramadhan",
                email: "farizramadhan07@gmail.com",
                number: "082136948293",
                address: "Guna Jaya",
                transaction_total: this.totalAmount,
                transaction_status: "PENDING",
                transaction_details: this.userCart
            },
            deliveryName: "Local Courier",
            deliveryPrice: 10000
        }
    },
    computed: {
        total() {
            return this.userCart.reduce((items, data) => {
                return items + data.price;
            }, 0)
        },
        totalAmount() {
            return this.total + this.deliveryPrice
        }
    },
    watch: {
        deliveryName(val) {
            if(val == "Local Courier") {
                this.deliveryPrice = 10000
            } else if(val == "Store Pickup") {
                this.deliveryPrice = 0
            } else {
                this.deliveryPrice = 5000
            }
        },
    },
    mounted() {
        if(localStorage.getItem('cart')) {
            try {
                this.userCart = JSON.parse(localStorage.getItem('cart'));
            } catch(e) {
                localStorage.removeItem('cart')
            }
        }
    }
}
</script>

<style scoped>
/* Checkout */
main.checkout {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-start;
    width: 90%;
}

main.checkout .details {
    flex: 2;
}

main.checkout .summary {
    margin-top: 40px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

main.checkout .details .cart{
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Item */

.checkout .item-header {
    display: flex;
    font-size: 2em;
    font-family: 'Dosis', sans-serif;
    margin: 1em 0;
}

.checkout .item-header h5 {
    margin-left: 10px;
}

.cart .item {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2em;
}

.cart .item .product {
    display: flex;
    align-items: center;
    flex: 2;
}

.cart .item .photo {
    height: 95px;
    width: 95px;
    background-color: #ECD5EC;
    border-radius: 16px;
}

.cart .item .photo img{
    width: 100%;
    height: 100%;
}

.cart .item .item-brand {
    width: 100px;
    font-weight: 600;
    font-size: 0.85em;
    margin-left: 5px;
}

.cart .item .item-brand p:nth-child(1) {
    font-weight: 400;
}

.cart .item input[type=number] {
    flex: 1;
    max-width: 50px;
    max-height: 10px;
}

.cart .item .price {
    text-align: right;
    flex: 2;
    font-weight: bold;
    margin-left: 10px;
}

/* Delivery */

.delivery .item-delivery {
    display: flex;
    flex-wrap: wrap;
    font-weight: bold;
    font-size: 1.6em;
    justify-content: space-between;
    align-content: center;
}

.radio-group {
    margin-right: 2em;
    margin-bottom: 2em;
}

.delivery .item-delivery .radio-group {
    flex-basis: 30%;
}

/* Summary */

.summary {
    display: flex;
    flex-direction: column;
    margin-left: 50px;
}

.summary .title {
    text-align: center;
    font-size: 1.2em;
    margin-bottom: 1em;
}

.summary .sum-card {
    box-sizing: border-box;
    padding: 15px;
    width: 235px;
    border: 3px solid #CE93D8;
    border-radius: 16px;
    font-size: 0.8em;
}

.sum-card .amount .item-amount .total-amount,
.sum-card .amount .item-amount .del-amount,
.sum-card .amount .total-transaction{
    display: flex;
    justify-content: space-between;
    margin-bottom: 1em;
}

section.details .total-amount {
    display: none;
}

section.details .total-amount .item-amountM {
    width: 100%;
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    margin: 1em 0;
}

section.details .total-amount .item-amountM p:nth-child(2){
    text-align: right;
}

section.details .total-amount .horizontal-divider {
    height: 2px;
}

.sum-card .amount .total-transaction {
    margin: 1em 0;
}

.sum-card .payment-method {
    margin-top: 2em;
}

.sum-card .payment-method .methods {
    display: flex;
    margin-top: 1em;
    width: 100%;
    justify-content: space-between;
}

section.details .payment-methodM {
    display: none;
}

section.details .payment-methodM .item-payment {
    display: flex;
    justify-content: space-around;
    font-weight: bold;
    font-size: 2em;
}

.methods .radio-group {
    display: flex;
    align-items: center;
}

.methods .radio-group label {
    margin-left: 5px;
}

.bons {
    box-sizing: border-box;
    padding: 5px;
    width: 100%;
}

.ctaM {
    display: none;
}

@media screen and (max-width:758px) {
    /* Checkout */

    main.checkout {
        display: flex;
        flex-direction: column;
    }

    section.details .total-amount {
        display: block;
    }

    main.checkout .summary {
        display: none;
    }

    section.delivery .item-delivery{
        font-size: 1em;
    }

    section.details .payment-methodM {
        display: flex;
        flex-direction: column;
        font-size: 1em;
        padding-bottom: 25px;
    }

    main.checkout footer {
        display: block;
    }

    .ctaM {
        bottom: 1;
        background: #ECD5EC;
        position: absolute;
        width: 100%;
        display: flex;
        box-sizing: border-box;
        padding: 15px;
        justify-content: space-between;
    }

    .ctaM .total-price {
        flex: 1;
        display: flex;
        flex-direction: column;
        color: #807676;
    }

    .ctaM .total-price p:nth-child(2) {
        color: #000;
        font-weight: bold;
    }

    .ctaM button.bonb {
        flex: 1;
        font-size: 1em;
    }
}
</style>