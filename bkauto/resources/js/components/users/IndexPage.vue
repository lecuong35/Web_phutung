<template>
    <div class="wrapper">
        <div class="header">
            <div class="header__info">
                <div class="header__logo">
                    <router-link to="/login-user">
                        <img src="../../../css/assets/phtung.png" alt=""/>
                    </router-link>

                </div>

                <div class="header__contact">
                   <a href="https://www.google.com/maps/place/105+Ng.+325+P.+Kim+Ng%C6%B0u,+Thanh+L%C6%B0%C6%A1ng,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i/@21.0053547,105.8649449,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ac07e54d5aa3:0xa2dc9d5c2626b5db!8m2!3d21.0053547!4d105.8649449?hl=vi-VN"
                   target="_blank"
                   class="address">
                        <fa icon="map-marker"/>
                        <p>Địa chỉ: 19 - ngách 105 - ngõ 325 - kim ngưu - thanh lương - hai bà trưng - hà nội</p>
                   </a>
                   <a href="" onclick="return false" style="margin-left: 15px;">
                        <fa icon="phone" style="padding-top:5px;"/>
                        SDT: 0936247421
                   </a>
                </div>

                  <div class="login">
                        <div class="nav-item">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <fa icon="user" style="color: #fafafa;"/>
                            </a>
                            <div class="dropdown-menu login__account" v-if="login">
                                <p>Xin chào {{user.name}} </p>
                                <p>
                                    <router-link to="/cart-manage">Quản lý tài khoản</router-link>
                                </p>
                                <button class="btn btn-warning"
                                @click="logout">
                                    Đăng xuất
                                </button>
                            </div>
                            <div class="dropdown-menu login__account" v-else>
                                <router-link to="/login-user" class="dropdown-item">Đăng nhập</router-link>
                            </div>

                        </div>

                    </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: sticky; top: 0; z-index: 999;">
                <a class="navbar-brand" href="#">BKAuto</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" @click.prevent="restore">Trang chủ <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                       <a class="nav-link" href="" onclick="return false">
                        Phụ tùng theo loại
                        </a>
                        <div class="menu" >
                            <a class="item" href="#" @click.prevent="searchByType('Giảm xóc')">Giảm xóc</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByType('Gương hậu')">Gương hậu</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByType('Đèn trước')">Đèn trước</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByType('Đèn sau')">Đèn sau</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByType('Cửa bên')">Cửa bên</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByType('Xilanh')">Xilanh</a>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="" onclick="return false">
                        Phụ tùng theo hãng
                        </a>
                        <div class="menu">
                            <a class="item" href="#" @click.prevent="searchByBrand('Toyota')">Toyota</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByBrand('Honda')">Honda</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByBrand('Nissan')">Nissan</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByBrand('Peugeot')">Peugeot</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByBrand('Mazda')">Mazda</a>
                            <div class="dropdown-divider"></div>
                            <a class="item" href="#" @click.prevent="searchByBrand('Kia')">Kia</a>
                        </div>
                    </li>
                    </ul>
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" v-model="search" placeholder="Tìm theo tên" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </form>
                </div>
         </nav>
         <div class="slide">
              <div class="slide__container">
                    <div class="slide__item">
                       <img :src="source" alt="slide" id="slide__img1">
                    </div>

                    <button class="prev" @click="prev">&#10094;</button>
                    <button class="next" @click="nextSlide">&#10095;</button>

                    <div class="dot" >
                       <button class="dot__item"  @click="click1">
                            1
                       </button>
                       <button class="dot__item"   @click="click2">
                            2
                       </button>
                       <button class="dot__item"   @click="click3">
                            3
                       </button>
                    </div>
             </div>
         </div>
         <hr style="width: 90%; color: #000;" >

            <div class="wrapper_content">
                <h2 style="margin-bottom: 15px;">
                    CÁC SẢN PHẨM CỦA CỬA HÀNG    
                </h2> 
                <div class="products">
                    <div class="products__item row">
                        <p v-for="pro in displayedPosts" :key="pro.id"
                         class="col-sm-6 col-md-4 col-lg-3">
                            <img :src="getImage(pro.image)" style="width: 75%; height: 45%">
                            <hr style="color: #000; width: 90%">
                            <div class="products__info">
                                <p>
                                    <b>Tên sản phẩm: </b> {{pro.name}}
                                </p>
                                <!-- <p>
                                    <b>Miêu tả: </b> {{pro.describe}}
                                </p> -->
                                <p>
                                    <b>Giá tiền: </b>{{pro.price}} vnđ
                                </p>
                                <div>
                                   <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#exampleModal'+pro.id">
                                        Xem chi tiết
                                    </button>
                                        <!-- Modal -->
                                        <div class="modal fade" :id="'exampleModal'+pro.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết sản phẩm</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="display: flex;">
                                                    <div class="body__img" style="flex: 3;">
                                                        <img :src="getImage(pro.image)" :key="pro.id" style="width: 90%; height: 75%">
                                                    </div>
                                                    <div class="body__info" style="flex: 2;">
                                                        <h3>
                                                            {{pro.name}}
                                                        </h3>
                                                        <p>{{pro.describe}}</p>
                                                        <p>Giá thành: {{pro.price}} vnđ</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" @click="addToCart(pro.id)">
                                                        Thêm vào giỏ
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <button class="btn btn-success" style="margin-left: 5px" @click="addToCart(pro.id)">
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </div>
                            
                        </p>
                    </div>
                     <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <button type="button" class="page-link" v-if="page != 1" @click="page--"> Previous </button>
                            </li>
                            <li class="page-item">
                                <button type="button" class="page-link" 
                                v-for="pageNumber in pages.slice(page-1, page)" @click="page = pageNumber"> {{pageNumber}} </button>
                                <!-- @click="page = pageNumber" -->
                            </li>
                            <li class="page-item">
                                <button type="button" class="page-link"
                                @click="page++" v-if="numberOfPages > page"> Next </button>
                            </li>
                        </ul>
                    </nav>	
                </div>

            </div>

            <footer class="footer">
                <div class="footer__info">
                    <h2>
                        Thông tin về Trung tâm phụ tùng ô tô chính hãng BKAuto
                    </h2>
                    <hr>
                    <h4>
                        Bách Khoa Auto Parts | Cung cấp phụ tùng ô tô chính hãng Hà Nội
                    </h4>
                    <div class="info">
                       <a href="https://www.google.com/maps/place/105+Ng.+325+P.+Kim+Ng%C6%B0u,+Thanh+L%C6%B0%C6%A1ng,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i/@21.0053547,105.8649449,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ac07e54d5aa3:0xa2dc9d5c2626b5db!8m2!3d21.0053547!4d105.8649449?hl=vi-VN"
                            target="__blank" style="display: flex;"
                            class="address">
                            <fa icon="map-marker" style="margin-right: 15px;"/>
                            <p>Địa chỉ: 19 - ngách 105 - ngõ 325 - kim ngưu - thanh lương - hai bà trưng - hà nội</p>
                        </a>
                        <a href="" onclick="return false">
                        <!-- onclick="return false" -->
                                <fa icon="phone" style="padding-top:5px; margin-right: 15px"/>
                                SDT: 0936247421
                        </a>
                        <a href="https://www.facebook.com/le.cuong.104855" target="__blank" style="margin-top: 15px">
                            <!-- <fa icon="envelope" /> -->
                            <p>Facebook: Lê Cường</p>
                        </a>
                        <a href="mailto:cuonglemanh352001@gmail.com">
                            <fa icon="envelope"/>
                            Email: Lê Cường
                        </a>
                    </div>
                </div>
            </footer>
    </div>
</template>


<script>
import { mapMutations, mapGetters, useStore, mapActions } from 'vuex';
import {  computed } from 'vue'; 
import ls from 'localstorage-slim';
import { assertTSTypeParameterInstantiation } from '@babel/types';

export default {
   setup() {
        const store = useStore();
        const source = computed( () => store.getters['page/source']);
        store.dispatch('products/getProducts');
        const products = computed( () => store.getters['products/products']);
        const pages = computed( () => store.getters['products/pages']);
        const perPage = computed( () => store.getters['products/perPage']);
        const numberOfPages = computed( () => store.getters['products/numberOfPages']);
        const user = ls.get('user');
        const login = user != null ? true:false;

        return {
            source,
            login,
            user,
            products,
            pages,
            perPage,
            numberOfPages

        }

   },
    data() {
      return {
        search: '',
        // products: this.products
        page: 1,
        pagepage: [1,2,3,4,5]
      }
    },

    watch: {
      ...mapMutations({
         search: 'products/SEARCH_PRODUCT'
      }),
    },

	computed: {
		displayedPosts() {
			return this.paginate(this.products);
		},
	},

    methods: {
        ...mapMutations({
            click1: 'page/CLICK_1',
            click2: 'page/CLICK_2',
            click3: 'page/CLICK_3',

            nextSlide: 'page/CLICK_NEXT',
            prev: 'page/CLICK_PREV',

            searchByBrand: 'products/SEARCH_BY_BRAND',
            searchByType: 'products/SEARCH_BY_TYPE',
            restore: 'products/RESTORE',
        }),

        getImage(src){
          return "storage/images/products/"+src;
        },

        ...mapActions({
            logout: 'users/logout',
            addToCart: 'carts/addCart'
        }),

        // setPages () {
		// 	let numberOfPages = Math.ceil(this.products.length / this.perPage);
		// 	for (let index = 1; index <= numberOfPages; index++) {
		// 		this.pages.push(index);
		// 	}
		// },
		paginate (pagi) {
			let page = this.page;
			let eachPage = this.perPage;
			let from = (page * eachPage) - eachPage;
			let to = (page * eachPage);
			return  pagi.slice(from, to);
		}
	},
}

</script>

<style lang="scss" scoped>
    .wrapper{
        display: flex;
        flex-direction: column;
        
        .header{
            width: 100%;
            background-color: rgb(92, 108, 224);
            padding: 5px 5px 5px;

            .header__info{
                display: flex;
                justify-content: space-between;
                // padding: 10px 10px 10px;

                .login:hover{
                      background-color: rgb(229, 229, 240);
                }
                .login {

                    .login__account{
                        text-align: center;
                        margin-right: 10px;
                        padding: 10px 10px 10px 10px;
                    }
                }



                .header__logo{
                    img {
                        width: 50px;
                    }
                    margin-right: 25px;
                }

                .header__contact{
                    display: none;
                    justify-content: space-between;
                    a{
                        display: flex;
                        padding-top: 10px;
                        color: #fafafa;

                        p{
                            margin-left: 15px;
                        }
                    }

                    a:hover {
                        text-decoration: none;
                        color: #050505;
                    }
                }
            }
        }

        button.page-link {
            display: inline-block;
        }
        button.page-link {
            font-size: 20px;
            color: #29b3ed;
            font-weight: 500;
        }
        // .offset{
        // width: 500px !important;
        // margin: 20px auto;  
        // }

        nav{
            display: flex;
            align-items: center;
            .menu{
                display: none;
                position: absolute;
                width: 200px;
                border: solid 1px rgb(50, 49, 49);
                border-radius: 7px;
                background-color: #fafafa;
                padding: 10px 10px 10px 10px ;
                height: fit-content;
                z-index: 123;

                .item{
                    color: rgb(31, 29, 29);
                    text-decoration: none;
                }
                .item:hover {
                    color:  rgba(51, 63, 224, 0.8);
                }
            }

            .nav-item:hover .menu{
                display: block;
            }
            .form-inline{

                input {
                    width: 250px;
                }
            }

        }

        .slide {
            margin-top: 20px;

            .slide__container {
                text-align: center;
                position: relative;
                width: 100%;
                // display: flex;
                // flex-direction: column;
                // justify-content: center;


                .slide__item{
                    list-style: none;
                    // width: 90%;
                    // padding-top: 30%;
                    // background-image: url('../../../css/assets//cuahang1.jpg');
                    background-repeat: no-repeat;
                    background-size: cover;

                    position: relative;
                    width: 100%;
                    height: 0;
                    padding-bottom: 33%;

                    img{
                        width: 90%;
                        // display: none;
                    }
                    
                }

                    .next {
                        // cursor: pointer;
                        position: absolute;
                        top: 50%;
                        width: auto;
                        right: 10%;
                        padding: 16px;
                        color: rgb(253, 250, 250);
                        background-color: rgba(253, 250, 250, 0.1);
                        border: none;
                        font-weight: bold;
                        font-size: 18px;
                        transition: 0.6s ease;
                        border-radius: 0 3px 3px 0;
                        user-select: none;
                        text-decoration: none;
                    }

                    .prev{
                        // cursor: pointer;
                        position: absolute;
                        top: 50%;
                        left: 10%;
                        width: auto;
                        padding: 16px;
                        color: rgb(253, 250, 250);
                        background-color: rgba(253, 250, 250, 0.1);
                        border: none;
                        font-weight: bold;
                        font-size: 18px;
                        transition: 0.6s ease;
                        border-radius: 0 3px 3px 0;
                        user-select: none;
                        text-decoration: none;
                    }


                    /* On hover, add a black background color with a little bit see-through */
                    .prev:hover, .next:hover {
                    background-color: rgba(51, 63, 224, 0.8);
                    }

                    .dot{
                        display: flex;
                        justify-content: center;
                        margin-top: 10px;
                        .dot__item{
                            border: solid 1px rgba(51, 63, 224, 0.8);
                            border-radius: 50%;
                            margin-left: 10px;
                            margin-right: 10px;
                            padding: 3px 3px 3px 3px;
                            text-decoration: none;
                            color: #000;
                        }

                        .dot__item:hover{
                            background-color: rgba(51, 63, 224, 0.8) ;
                        }
                    }
            }
        }
    }

    .wrapper_content {
        width: 90%;
        margin-left: 5%;
        text-align: center;

        .products {

            .products__item{
                .products__info {
                    text-align: start;
                }
            }
        }
    }

    .footer{
        width: 90%;
        margin-left: 5%;
        border: dotted 2px rgb(42, 41, 41);
        padding: 10px 10px 10px;
        background-color: #e2dbfa;

        .footer__info{
            a{
                color: #050505;
                text-decoration: none;
            }

            a:hover{
                color: rgba(51, 63, 224, 0.8);
            }

            h2, h4 {
                color: rgba(51, 63, 224, 0.8);
            }

            .info{
                padding: 10px 20px 10px;
            }
        }
    }

    @media screen and (max-width: 576px) {
        .header__contact {
            display: none;
            color: #000;
        }
    }
</style>