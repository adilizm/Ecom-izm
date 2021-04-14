import axios from "axios";

import { reactive } from "vue";

const state = reactive({
    counter: 102,
    products: [],
    product: null,
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
});

const methodes = {
    add() {
        state.counter++;
    },
    less() {
        state.counter--;
    },
    getprodects() {
        axios
            .get("http://127.0.0.1:8000/api/prodects")
            .then((res) => (state.products = res.data));
    },
    getprodectwithslug(slug) {
        axios
            .get("http://127.0.0.1:8000/api/prodect/" + slug)
            .then((res) => (state.product = res.data));
    },
    add_prodect_to_cart(prod) {
        var prodect = { product: prod, qty: 1 };
        var isnewproduct = true;
        state.prodects_in_cart.forEach((prodecte) => {
            if (prodecte.product === prodect.product) {
                isnewproduct = false;
            }
        });
        if (isnewproduct) {
            state.number_prodects_in_cart++;
            state.prodects_in_cart.push(prodect);
            state.prodects_in_cart.forEach((prodecte) => {
                console.log(
                    "product = ",
                    prodecte.product,
                    "  qty = ",
                    prodecte.qty
                );
            });
            methodes.Update_total_to_pay();
        } else {
            console.log("prodect alredy in cart ");
        }
    },
    add_prodect_to_cart_with_qty(prod, Quantity) {
        var prodect = { product: prod, qty: Quantity };
        var isnewproduct = true;
        state.prodects_in_cart.forEach((prodecte) => {
            if (prodecte.product === prodect.product) {
                isnewproduct = false;
            }
        });
        if (isnewproduct) {
            state.number_prodects_in_cart++;
            state.prodects_in_cart.push(prodect);
            state.prodects_in_cart.forEach((prodecte) => {
                console.log(
                    "product = ",
                    prodecte.product,
                    "  qty = ",
                    prodecte.qty
                );
            });
            methodes.Update_total_to_pay();
        } else {
            console.log("prodect alredy in cart ");
        }
        console.log(state.prodects_in_cart);
    },
    increase_Quantity(prod) {
        state.prodects_in_cart.forEach((p) => {
            if (p.product === prod) {
                p.qty = p.qty + 1;
            }
            methodes.Update_total_to_pay();
            console.log(state.prodects_in_cart);
        });
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
            console.log(state.prodects_in_cart);
        });
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
        if(createorder){
            const order={
                "firstname":state.Firstname,
                "lastname":state.Lastname,
                "Telephone":state.Telephone,
                "Address":state.Addres,
                "Email":state.Email,
                "Ville":state.Ville,
                "prodects_json":null,
                "total_to_pay":state.total_to_pay,
            }
            const json_poducts={
                "products":[]
            }
            for(var i =0;i<state.prodects_in_cart.length;i++){
                const prod={}
                prod.prodect_id=state.prodects_in_cart[i].product.id
                prod.qty=state.prodects_in_cart[i].qty
                json_poducts.products.push(prod)
            }
            order.prodects_json=json_poducts
            axios.post("http://127.0.0.1:8000/api/CreateOrder", order).then(res=>console.log(res))
            
        }
       
    },
};

export default { state, methodes };
