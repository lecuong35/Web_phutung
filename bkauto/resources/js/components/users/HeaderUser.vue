<template lang="html">
  
        <!-- Sidebar  -->
       <div>
            <nav id="sidebar">
            <div class="sidebar-header">
			   <router-link to="/login-user"><img src="../../../css/assets/phtung.png" style="width: 100%;" /></router-link>
            </div>

            <ul class="list-unstyled components">
                <p>MENU</p>
                <li class="component-items" id="product-item">
                    <router-link to="/cart-manage" >Giỏ Hàng</router-link>
                </li>
                <li class="component-items" id="type-item">
                    <router-link to="/cart-history">Xem Lịch Sử Đặt Hàng</router-link>
                </li>
                 <li class="component-items" id="product-item">
                    <button class="btn btn-secondary"  @click="logout">Đăng Xuất</button>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <router-link to="/manage-user" class="download">
                       <img src="../../../css/assets/images.jpg" alt="" style="width: 100%;">
                    </router-link>
                </li>
            </ul>
        </nav>
        <div class="button-hidden">
          <input type="checkbox" id="check" @click="showMenu" hidden>
          <label for="check">
               <fa icon="bars" style="width: 25px;"/>
          </label>
        </div>
       </div>
       
    
</template>
<script>
import { mapActions, mapMutations } from 'vuex';
import baseUrl from '../../store/baseUrl';
import ls from 'localstorage-slim'
import router from '../../router';

export default {
    created: baseUrl.checkUserLogin,
    methods: {
        showMenu() {
            const menu = document.getElementById('sidebar');
            const button = document.getElementById('check');
            if( button.checked == true)
                menu.style.marginLeft = "0px";
            else 
                menu.style.marginLeft = "-250px";
        },

        ...mapActions({
            logout: 'users/logout'
        })
       
    }

}
</script>
<style scoped>
  /*
    DEMO STYLE
*/

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

/* .wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
} */

#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #7386D5;
    color: #fff;
    transition: all 0.3s;
	text-align: center;
    /* position: fixed; */
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

.component-items.active {
    color: #fff;
    background: #314cc5;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

#sidebarCollapse:checked ~ #sidebar {
	margin-left: -250px;
}



ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

a.article,
a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}

.button-hidden {
    position: absolute;
    left: 2px;
    top: 2px;
}

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

.container-fluid{
	display: flex;
	justify-content:space-between;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
        width: 200px;
    }
    #sidebar.active {
        margin-left: 0;
    }
/*    
    #sidebarCollapse{
         display: block; 
	} */
}
</style>