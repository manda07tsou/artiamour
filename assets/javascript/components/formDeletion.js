export class FormDeletion extends HTMLFormElement{
    constructor(){
        super();
    }

    connectedCallback(){
        this.addEventListener('submit', this.preSubmit.bind(this))
    }

    preSubmit(e){
        e.preventDefault();
        if (confirm("Voulez-vous vraiment supprimer ce contenu")){
            e.target.submit();
        }
    }
}