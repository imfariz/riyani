<template>
<div>
<header>
    <div class="hero">
        <h1>Let Us <br> Found What You Need <br> Easily</h1>
    </div>
</header>

<main>
    <ul class="nav-content">
        <li><a href="#">All Products</a></li>
        <li><a href="#">Victoria Secret</a></li>
        <li><a href="#">Body Wash</a></li>
    </ul>
    <div class="horizontal-divider"></div>
    <input type="search" name="product" id="product" placeholder="Victoria Secret">
    <div class="products">
        <div class="card" v-for="item in products" :key="item.id">
            <div class="card-header">
                <div class="brand">
                    <p>{{ item.type }}</p>
                </div>
                <div class="card-button">
                    <a @click="saveCart(item.id, item.name, item.type, item.image, item.price)">
                        <span class="iconify" data-inline="false" data-icon="ri:shopping-basket-fill"></span>
                    </a>
                </div>
            </div>
            <div class="card-image">
                <router-link :to="'/detail/'+item.id">
                    <img :src="'http://127.0.0.1:8000/storage/'+item.image">
                </router-link>
            </div>
            <div class="card-footer">
                <h5>{{ item.name }}</h5>
                <p>Rp{{ item.price }},-</p>
            </div>
        </div>
    </div>
</main>
</div>
</template>

<style scoped>
header {
    height: 25vh;
    background-color: #FBEAFB;
    display: flex;
    justify-content: center;
}

header .hero {
    box-sizing: border-box;
    font-family: 'Dosis', sans-serif;
    font-weight: 400;
    font-style: normal;
    display: flex;
    align-items: center;
    width: 80%;
    height: 100%;
}

/* Main */

main {
    width: 90%;
    
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Nav */

main ul.nav-content {
    margin: 1.5em 0;
    display: flex;
    width: 70%;
    list-style: none;
    justify-content: space-evenly;
}

main ul.nav-content a {
    text-decoration: none;
    font-family: 'Dosis', sans-serif;
}

main ul.nav-content a:hover {
    color: #CE93D8;
    text-decoration: underline;
}

/* Search */
#product {
    align-self: flex-start;
    background-color: #FCEAFC;
    border: none;
    margin: 1.5em 0;
    border-radius: 15px;
    width: 35%;
    padding: 5px 35px 5px;
    
}

#product::placeholder {
    font-family: 'Poppins';
}

/* Products Card */
.products {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 20px;
}

/* Card */

.card {
    /* height: 300px; */
    width: 240px;
    height: 440px;
    margin-bottom: 60px;
}

/* Card Header */

.card .card-header {
    font-size: 16px;
    height: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header .card-button {
    font-size: 24px;
    align-self: baseline;
}
.card-header .card-button .iconify:hover {
    color: #CE93D8;
}

/* Card Image */
.card-image {
    width: 100%;
    height: 290px;
    background-color: #ECD5EC;
}

.card-image img {
    width: 100%;
    height: 100%;
}

/* Card Footer */
.card-footer {
    font-size: 18px;
    font-weight: bold;
}

.card-footer p{
    color: #FFAF15;
}

/* Responsive Breakpoint */

/* Tablet */
@media screen and (max-width:758px) {
    nav {
        justify-content: space-around;
    }
    nav .clear {
        display: none;
    }
    nav .info-cta {
        justify-content: space-around;
    }
}

/* Mobile */
@media screen and (max-width:576px) {
header .hero {
    text-align: center;
    justify-content: center;
}
}

</style>

<script>
import axios from 'axios'

export default {
name: 'Home',
data() {
    return {
        products: [],
        carts: []
    }
},
methods : {
    saveCart(id, name, type, image, price) {
        this.carts.push({
            id,
            name,
            type,
            image: "http://127.0.0.1:8000/storage/"+image,
            price
        });
        const parsed = JSON.stringify(this.carts);
        localStorage.setItem('cart', parsed);
    }
},
mounted() {
    if(localStorage.getItem('cart')) {
        try {
            this.carts = JSON.parse(localStorage.getItem('cart'));
        } catch(e) {
            localStorage.removeItem('cart')
        }
    }

    axios.get('http://127.0.0.1:8000/api/products').then(res => {
        this.products = res.data.data.data;
        console.log(this.products)
    })
}
}
</script>
