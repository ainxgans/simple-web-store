function addToCart(id) {
    axios.post('/carts', {product_id: id}).then(response => {
        console.log(response)
    })
}
