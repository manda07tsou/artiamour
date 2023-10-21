const options = {
    root: null,
    threshold: .3,
    rootMargin: "0px"
}

const handleIntersect = (entries, observer) => {
    entries.forEach(entrie => {
        if(entrie.isIntersecting){
            entrie.target.classList.add('reveal')
            observer.unobserve(entrie.target)
        }
    })
}


let observer = new IntersectionObserver(handleIntersect, options)
let elements = document.querySelectorAll('[class*=hide]')
elements.forEach(element => {
    observer.observe(element)
})