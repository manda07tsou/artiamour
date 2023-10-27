import {addEvent, $} from "../../services/dom.js"

//evenement pour le checkbox sur le formulaire de produit
addEvent(
    $("#colors_all"),
    "change", 
    (e) => {
        const product_colors_field = document.getElementById("product_colors")
        if(!e.target.checked){
            product_colors_field.value = ''
        }else{
            product_colors_field.value = "Toutes couleurs disponible"
        }
    }
)
