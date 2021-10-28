<template>
    <nav>
        <div class="clear"></div>
        <div class="logo">
            <router-link to="/">Riyani</router-link>
        </div>
        <div class="info-cta">
            <div class="profile">
                <p>Riyani Wulandari</p>
                <span class="iconify" data-inline="false" data-icon="gg:profile"></span>
            </div>
            <div class="vertical-divider"></div>
            <router-link :to="{name : 'Checkout'}">
                <span class="iconify" data-inline="false" data-icon="ant-design:shopping-filled"></span>
            </router-link>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Topbar',
}
</script>

<style scoped>
    .clear {
        flex: 1;
    }

    nav {
        height: 40px;
        background-color: #ECD5EC;
        color: #000;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    nav .logo {
        flex: 1;
        font-family: 'Cinzel', serif;
        font-size: 1.5em;
        text-align: center;
    }

    nav .logo a {
        text-decoration: none;
    }

    nav .info-cta {
        flex: 1;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    nav .info-cta p {
        font-size: 0.8em;
    }

    nav .info-cta .iconify {
        width: 20px;
        height: 20px;
    }

    nav .info-cta .iconify:hover {
        color: #a501f1;
    }

    .profile {
        width: 60%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .profile:hover {
        color: #a501f1;
        cursor: pointer;
    }

    .profile .iconify {
        margin-left: 0.5em;
    }

    /* Responsive Breakpoint*/

    /* Mobile */
@media screen and (max-width:576px) {
    nav .clear {
        display: none;
    }
    nav .info-cta {
        display: none;
    }
}
</style>