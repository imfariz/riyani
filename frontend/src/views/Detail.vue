<template>
<div>
<div class="back-button">
    <span class="iconify" data-inline="false" data-icon="bx:bxs-left-arrow" style="color: #000;"></span>
    <router-link to="/">Continue Shopping</router-link>
</div>
<main class="details-info">
    <div class="info-product">
        <div class="info-header">
            <h4>{{ productDetails.name }}</h4>
            <div class="brand-price">
                <p id="brand">{{ productDetails.type }}</p>
                <p id="price">Rp{{ productDetails.price }},-</p>
            </div>
        </div>
        <div class="horizontal-divider"></div>
        <div class="detail-product">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vehicula ac sed enim pellentesque odio lacus maecenas velit. Et neque commodo, eget egestas purus eleifend. Sit etiam mauris, rutrum sapien felis a. Aliquet etiam pellentesque at sapien gravida pharetra.</p>
        </div>
        <div class="info-footer">
            <div class="radio-choice">
                <div class="radio-group">
                    <input type="radio" name="rc" id="r1">
                    <label for="r1">100ML</label>
                </div>
                <div class="radio-group">
                    <input type="radio" name="rc" id="r2">
                    <label for="r2">150ML</label>
                </div>
                <div class="radio-group">
                    <input type="radio" name="rc" id="r3">
                    <label for="r3">200ML</label>
                </div>                    
            </div>
            <div class="vertical-divider"></div>
            <div class="add-button">
                <input type="number" name="amount" id="amount" min="1" max="10" value="1">
                <button class="bon-form bon-primary">Add to Cart</button>
                <button class="bon-form bon-secondary">Buy Now</button>
            </div>
        </div>
    </div>
    <div class="image">
        <img :src="'http://127.0.0.1:8000/storage/'+productDetails.image" alt="">
    </div>
    <section class="button-cta">
        <button class="bunc bon-primary">Add to Cart</button>
        <button class="bunc bon-secondary">Buy Now</button>
    </section>
</main>
</div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            productDetails : []
        }
    },
    mounted() {
         axios.get("http://127.0.0.1:8000/api/products", {
            params: {
                id: this.$route.params.id
            }
        })
            .then(res => (this.productDetails = res.data.data))
            .catch(err => console.log(err))
    }
}
</script>


<style scoped>
/* Back Button */
.back-button {
    padding: 1em;
    display: flex;
    align-items: center;
}

.back-button a {
    text-decoration: none;
}
.back-button a:hover {
    text-decoration: underline;
}

/* Info Product */

main.details-info {
    width: 90%;
    height: 85vh;
    display: flex;
    flex-direction: row;
}

.info-product {
    flex: 1.8;
    font-size: 1.25em;
}

.info-header {
    font-family: 'Dosis', sans-serif;
}

.info-header h4 {
    font-size: 1.5em;
    margin-bottom: 0.4em;
}

.info-header .brand-price{
    display: flex;
    justify-content: space-between;
}

.info-header .brand-price #price {
    font-weight: bold;
    text-align: end;
}

.info-product .horizontal-divider {
    margin: 2em 0;
    height: 1.5px;
}

.detail-product {
    margin: 2em 0;
}

.info-product .info-footer .radio-choice{
    display: flex;
    width: 100%;
    align-items: center;
    margin-bottom: 1.2em;
    font-weight: bold;
}

.radio-group {
    margin-right: 2em;
    margin-bottom: 2em;
}

.info-product .info-footer .add-button {
    display: flex;
}

.info-product .info-footer .vertical-divider {
    display: none;
}

.bon-form {
    width: 150px;
    font-family: 'Poppins', serif;
    margin: 0 2em;
}

.image {
    flex: 1;
    padding: 40px;
    box-sizing: border-box;
}

.image img {
    width: 100%;
    height: 100%;
}

section.button-cta {
    display: none;
}

/* Responsive Breakpoint */

/* Tablet */
@media screen and (max-width:758px) {
    
    /* Details */
    main.details-info {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .details-info .info-product {
        width: 90%;
        order: 2;
        padding-bottom: 70px;
    }

    .details-info .info-product .info-footer {
        display: flex;
        align-items: center;
        height: fit-content;
    }

    .info-product .info-footer .radio-choice {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 0;
        flex: 1;
    }
    .info-product .info-footer .radio-choice .radio-group{
        margin-bottom: 1em;
    }
    .info-product .info-footer .add-button {
        justify-content: flex-end;
        flex: 1;
    }

    .info-footer .add-button .bon-form {
        display: none;
    }

    .details-info .info-product .info-footer .vertical-divider {
        width: 2px;
        height: 90px;
        display: block;
        background-color: #CE93D8;
    }
    

    .details-info .image {
        order: 1;
        width: 50%;
        height: 65%;
        margin-bottom: 2.5em;
    }

    section.button-cta {
        display: flex;
        order: 3;
        background-color: #ECD5EC;
        width: 100%;
        position: fixed;
        bottom: 0;
        justify-content: space-around;
        padding: 10px;
    }

    section.button-cta .bunc {
        width: 45%;
        font-family: 'Poppins', sans-serif;
        font-size: 1em;
        padding: 5px 0;
    }
}

/* Mobile */
@media screen and (max-width:576px) {
    nav .clear {
        display: none;
    }
    nav .info-cta {
        display: none;
    }

    header .hero {
        text-align: center;
        justify-content: center;
    }
}
</style>
