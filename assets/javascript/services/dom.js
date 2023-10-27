/**
 * Ajoute un evenement a un element et verifie si l'element existe sur la page
 * @param {Node | NodeList} elements 
 * @param {string} event 
 * @param {callback} callback 
 */
export function addEvent(elements, event, callback){
    if(elements){
        if(elements instanceof NodeList){
            elements.forEach(element => {
                element.addEventListener(event, callback)
            })
        }else{
            elements.addEventListener(event, callback)
        }
    }
}

/**
 * Selecteur d'un element
 * @param {string} selector 
 * @return HTMLElement
 */
export function $(selector){
    return document.querySelector(selector)
}