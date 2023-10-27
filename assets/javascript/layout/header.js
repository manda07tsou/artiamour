import {addEvent, $} from "../services/dom.js"

addEvent(
    $(".burger"),
    "click",
    () => {
        document.querySelector('header').classList.toggle('is-open')
    }
)