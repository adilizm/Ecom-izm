import axios from "axios";

import { reactive } from "vue";

const state = reactive({
    counter: -1,
    products: [],
    product: [],
    Quantity: 1,
    prodects_in_cart: [],
    number_prodects_in_cart: 0,
    total_to_pay: 0,
    Firstname: null,
    Lastname: null,
    Addres: null,
    Telephone: null,
    Email: null,
    Ville: null,
    sliders: [],
    home_products: [],
    prodect_variants: [],
    prodect_variants_values: [],
    prodect_selected_variants_values: [],
    variants_value_selected: [],
});

const methodes = {
    callme(_variant, index) {
        console.log(
            "Hello Mr adil izm element is = ",
            _variant,
            "--- index = ",
            index
        );
        state.product[0].selected_variant.forEach((variant) => {
            if (variant[0] == _variant) {
                console.log("m3alkaa");
                variant[1] = index;
            }
        });
    },
    less() {
        state.counter--;
    },
    getprodects() {
        // hna each product should have the same form as product reteurned in getprodectwithslug(slug)
        let All_products = [];
        state.counter = -1;
        state.products = [];
        let json_variants = null;
        let variantsKantara0 = [];
        let variantsKantara1 = [];

        let variant_values = [];
        let productobj = {product: null, qty: 1, selected_variant: [], variants_values: [], };
        axios
            .get("http://127.0.0.1:8000/api/prodects")
            .then(
                (res) => (
                    (All_products = res.data),
                    All_products.forEach((product_) => {
                        state.counter = -1;
                        console.log("All_products = ", All_products);
                        variantsKantara1 = [];
                        productobj = {
                            product: null,
                            qty: 1,
                            selected_variant: [],
                            variants_values: [],
                        };
                        console.log("product_ = ", product_),
                            (json_variants = JSON.parse(product_.variants)),
                            console.log("json = ", json_variants),
                            console.log(
                                "json keys = ",
                                Object.keys(json_variants)
                            ),
                            Object.keys(json_variants).forEach(() => {
                                state.counter++;
                                variantsKantara0 = [];
                                variantsKantara0.push(
                                    Object.keys(json_variants)[state.counter]
                                );
                                variantsKantara0.push(0);
                                variantsKantara1.push(variantsKantara0);

                                let variants_Keys = [];
                                variant_values = [];
                                variants_Keys.push(Object.keys(json_variants));
                                console.log(
                                    "prodects variants kays =",
                                    variants_Keys[0].length
                                );
                                console.log("key ==== ", variants_Keys[0][0]);

                                let i = 0;
                                for (i = 0; i < variants_Keys[0].length; i++) {
                                    variant_values.push(
                                        JSON.parse(product_.variants)[
                                            Object.keys(
                                                JSON.parse(product_.variants)
                                            )[i]
                                        ]
                                    );
                                }
                            });
                        console.log("variant_values === ", variant_values);
                        console.log("variantsKantara1 = ", variantsKantara1);

                        productobj.product = product_;
                        productobj.selected_variant = variantsKantara1;
                        productobj.variants_values=variant_values
                        state.products.push(productobj);
                        console.log("productobgj = ", productobj);
                    })
                )
            )
            .catch((e) => console.log("error = ", e.message));
    },
    get_home_products() {
        let All_products = [];
        state.counter = -1;
        state.home_products = [];
        let product_and_its_objects = {
            product: null,
            qty: 1,
            selected_variant: [],
            variants_values: [],
        };
        axios
            .get("http://127.0.0.1:8000/api/homesproducts")
            .then(
                (res) => (
                    (All_products = res.data),
                    All_products.forEach((product_) => {
                        //show products geted by api
                        console.log("all products = ", All_products);
                        //initialise all arrays will used product_and_its_objects
                        product_and_its_objects = {
                            product: null,
                            qty: 1,
                            selected_variant: [],
                            variants_values: [],
                        };
                        let json_variants = null;
                        let selected_variant = [];
                        let values_variant = [];

                        //converte variants getet from json to array
                        json_variants = JSON.parse(product_.variants);
                        console.log("json_variants = ", json_variants);

                        //making selected_variants all the first varinat
                        state.counter = -1;
                        Object.keys(json_variants).forEach((variant) => {
                            state.counter++;
                            let recrde = [];
                            let v = Object.keys(json_variants)[state.counter];
                            recrde.push(v);
                            recrde.push(0);
                            selected_variant.push(recrde);
                        });
                        console.log("selected_variant = ", selected_variant);
                        //making variants_values
                        state.counter = -1;
                        Object.keys(json_variants).forEach((variant) => {
                            state.counter++;
                            values_variant.push(json_variants[variant]);
                            //  console.log('this is values =',json_variants[variant])
                        });
                        //affecting values to product_and_its_objects
                        product_and_its_objects.product = product_;
                        product_and_its_objects.qty = 1;
                        product_and_its_objects.selected_variant = selected_variant;
                        product_and_its_objects.variants_values = values_variant;
                        //add product and its variants
                        state.home_products.push(product_and_its_objects);
                    })
                )
            )
            .catch((e) => console.log("error = ", e.message));
    },
    async getprodectwithslug(slug) {
        state.prodect_variants = [];
        state.prodect_variants_values = [];
        state.counter = -1;
        let variantsKantara0 = [];
        let variantsKantara1 = [];
        let json_variants = null;
        let productobj = {
            product: null,
            qty: 1,
            selected_variant: [],
            variants_values: [],
        };
        axios.get("http://127.0.0.1:8000/api/prodect/" + slug).then(
            (res) => (
                (productobj.product = res.data),
                // console.log('s = ',productobj),
                (json_variants = JSON.parse(productobj.product[0].variants)),
                // console.log(' Object.keys(json_variants)[0] = ', Object.keys(json_variants)[0],),

                Object.keys(json_variants).forEach(() => {
                    state.counter++;
                    variantsKantara0 = [];
                    variantsKantara0.push(
                        Object.keys(json_variants)[state.counter]
                    );
                    variantsKantara0.push(0);
                    variantsKantara1.push(variantsKantara0);
                    // console.log('variantskantara = ', variantsKantara1)
                    productobj.selected_variant = variantsKantara1;
                    // console.log('productobj.product = ',productobj.product[0])

                    let variants_Keys = [];
                    let variant_values = [];
                    variants_Keys.push(
                        Object.keys(JSON.parse(productobj.product[0].variants))
                    );
                    console.log(
                        "prodects variants kays =",
                        variants_Keys[0].length
                    );
                    console.log("key ==== ", variants_Keys[0][0]);

                    let i = 0;
                    for (i = 0; i < variants_Keys[0].length; i++) {
                        variant_values.push(
                            JSON.parse(productobj.product[0].variants)[
                                Object.keys(
                                    JSON.parse(productobj.product[0].variants)
                                )[i]
                            ]
                        );
                    }

                    //let keyss=JSON.parse(productobj.product[0].variants)
                    console.log(
                        "hna aykon color ==",
                        Object.keys(
                            JSON.parse(productobj.product[0].variants)
                        )[0]
                    );
                   
                    let pro = {
                        product: productobj.product[0],
                        qty: productobj.qty,
                        selected_variant: productobj.selected_variant,
                        variants_values: variant_values,
                    };
                    if (state.counter == 0) {
                        state.product = [];
                        state.product.push(pro);
                        console.log("variants values = ", variant_values);
                    }
                    // console.log('productobj.qty = ',productobj.qty)
                    // state.product.push(productobj.qty)

                    /*  state.product.push(productobj.product[0])
              state.product.push(productobj.qty)
               state.product.push(productobj.selected_variant) */
                }),
                console.log("state.product= ", state.product)
            )
        );

        // .then((res) => ( productobj.product = res.data,console.log('s = ',productobj.product),console.log(state.product[0].variants),variants2=JSON.parse(state.product[0].variants),console.log('variants2 = ',variants2),state.product[0].variants2=variants2,console.log('state.product[0]= ',state.product[0]) ));
    },

    add_prodect_to_cart(prod) {
        console.log("prod add parameter = ", prod);
        var isnewproduct = true;
        state.prodects_in_cart.forEach((prodecte) => {
            if (prodecte.product === prod.product) {
                isnewproduct = false;
            }
        });
        if (isnewproduct) {
            state.number_prodects_in_cart++;
            state.prodects_in_cart.push(prod);
            methodes.Update_total_to_pay();
        } else {
            console.log("prodect alredy in cart ");
        }
        console.log("state.prodects in cart = ", state.prodects_in_cart);
    },
    add_prodect_to_cart_with_qty(prod, Quantity) {
        console.log('product add from parameter =',prod)
    
        var isnewproduct = true;
        state.prodects_in_cart.forEach((producte) => {
            if (producte.product === prod.product) {
                isnewproduct = false;
            }
        });
        if (isnewproduct) {
            state.number_prodects_in_cart++;
            prod.qty=state.Quantity
            state.prodects_in_cart.push(prod);
            console.log('state.qty = ',state.Quantity)
            
            methodes.Update_total_to_pay();
        } else {
            console.log("prodect alredy in cart ");
        }
        console.log('state.products_in_cart = ',state.prodects_in_cart);
    },
    increase_Quantity(prod) {
        state.prodects_in_cart.forEach((p) => {
            if (p.product === prod) {
                p.qty = p.qty + 1;
            }
            methodes.Update_total_to_pay();
            console.log(state.prodects_in_cart);
        });
        console.log("state.prodects in cart = ", state.prodects_in_cart);
    },
    decrease_Quantity(prod) {
        state.prodects_in_cart.forEach((p) => {
            if (p.product === prod) {
                p.qty = p.qty - 1;
                if (p.qty < 2) {
                    p.qty = 1;
                }
            }
            methodes.Update_total_to_pay();
        
        });
        console.log("state.prodects in cart = ", state.prodects_in_cart);
    },
    Quantity_change(prod, New_Quantity) {
        console.log("new Quantity = ", New_Quantity);
        state.prodects_in_cart.forEach((p) => {
            if (p.product === prod) {
                p.qty = New_Quantity;
                if (p.qty < 2) {
                    p.qty = 1;
                }
                if (p.qty > p.product.qty) {
                    p.qty = p.product.qty;
                }
            }
            methodes.Update_total_to_pay();
            console.log(state.prodects_in_cart);
        });
    },
    remove_product_from_cart(prod) {
        state.prodects_in_cart = state.prodects_in_cart.filter((p) => {
            return p.product != prod;
        });
        state.number_prodects_in_cart--;
        methodes.Update_total_to_pay();
        console.log("arte after remove", state.prodects_in_cart);
    },
    Update_total_to_pay() {
        state.total_to_pay = 0;
        state.prodects_in_cart.forEach((p) => {
            state.total_to_pay += p.product.price * p.qty;
        });
    },
    SubmiteOrder() {
        var createorder = true;
        if (state.Firstname === "" || state.Firstname === null) {
            document.getElementById("firstname").classList.add("needed");
            createorder = false;
        } else {
            document.getElementById("firstname").classList.remove("needed");
        }
        if (state.Lastname === "" || state.Lastname === null) {
            document.getElementById("Lastname").classList.add("needed");
            createorder = false;
        } else {
            document.getElementById("Lastname").classList.remove("needed");
        }
        if (state.Telephone === "" || state.Telephone === null) {
            document.getElementById("Telephone").classList.add("needed");
            createorder = false;
        } else {
            document.getElementById("Telephone").classList.remove("needed");
        }
        if (state.Ville === "" || state.Ville === null) {
            document.getElementById("Ville").classList.add("needed");
            createorder = false;
        } else {
            document.getElementById("Ville").classList.remove("needed");
        }
        if (state.Addres === "" || state.Addres === null) {
            document.getElementById("Address").classList.add("needed");
            createorder = false;
        } else {
            document.getElementById("Address").classList.remove("needed");
        }
        if (createorder) {
            const order = {
                firstname: state.Firstname,
                lastname: state.Lastname,
                Telephone: state.Telephone,
                Address: state.Addres,
                Email: state.Email,
                Ville: state.Ville,
                prodects_json: null,
                total_to_pay: state.total_to_pay,
            };
            const json_poducts = {
                products: [],
            };
            for (var i = 0; i < state.prodects_in_cart.length; i++) {
                const prod = {};
                prod.prodect_id = state.prodects_in_cart[i].product.id;
                prod.qty = state.prodects_in_cart[i].qty;
                prod.selected_variant=state.prodects_in_cart[i].selected_variant;
                json_poducts.products.push(prod);
            }
            order.prodects_json = json_poducts;
            console.log('ordere seded = ' ,order)
            /*  axios
                .post("http://127.0.0.1:8000/api/CreateOrder", order)
                .then((res) => console.log(res));  */
        }
    },
    getSliders() {
        axios
            .get("http://127.0.0.1:8000/api/sliders")
            .then((res) => (state.sliders = res.data));
    },
    select_prodect_from_cart(product_name){
        state.prodects_in_cart.forEach((product0)=>{
            if(product0.product.name ==product_name){
                state.product=[]
                state.product.push(product0);
                console.log('prodect selected from cart =' ,product0)
                console.log('state.product =' ,state.product)
            }
        })

    }
};

export default { state, methodes };
