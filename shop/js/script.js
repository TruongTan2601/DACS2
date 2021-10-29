const btn = document.querySelectorAll('.add_to_cart')
// console.log(btn)
btn.forEach(function(a,index){
  a.addEventListener("click",function (event) {  
    var btnItem = event.target
    var product = btnItem.parentElement.parentElement.parentElement.parentElement
    var productImg = product.querySelector("img").src
    var productName = product.querySelector("H4").innerText
    var productPrice = product.querySelector("H5").innerText
    // console.log(productImg,productName,productPrice)
    add_cart(productImg,productName,productPrice)
  })
})

function add_cart(productImg,productName,productPrice){
  var add_li = document.createElement("li")
  var li_content = '<li><a href="#" class="photo"><img src="'+productImg+'" class="cart-thumb" alt="" /></a> <h6><a href="#">'+productName+'</a></h6><p>1x - <span class="price">'+productPrice+'</span></p></li>'
  add_li.innerHTML = li_content
  var cart_table = document.querySelector("ul.cart-list")
  // console.log(cart_table)
  cart_table.append(add_li)
}