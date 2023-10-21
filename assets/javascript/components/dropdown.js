export class Dropdown extends HTMLElement{
    // isOpen = false;
    constructor(){
        super();
        this.content = this.querySelector('.dropdown-content');
        if(!this.content.hasAttribute('hidden')){
            this.content.setAttribute('hidden', true)
        }
    }

    connectedCallback(){
        this.btn = this.querySelector('.dropdown-toggle');
        this.btn.addEventListener('click',this.toggleContent.bind(this))
        // this.querySelector('.dropdown-closed').addEventListener('click', this.close.bind(this))
    }

    toggleContent(){
        if(this.isOpen){
            this.close()
        }else{
            this.open()
        }
    }
    open(){
        this.content.removeAttribute('hidden');
        this.isOpen=true;
    }

    close(){
        this.content.setAttribute('hidden', true)
        this.isOpen =false;
    }
    
}