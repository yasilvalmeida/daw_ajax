/* This JS file with have all needed classes for the fronted */

/*************************************************************/

/* This class will allow manapulate Itens objects */
/* Item Class Begin */
class Item {
    /* This special function (constructor) will create a item object from id, nome and ficheiro */
    constructor(id, nome, ficheiro){
        this.id       = id;
        this.nome     = nome;
        this.ficheiro = ficheiro;
    }
    /* This function will return the id */
    getId(){
        return this.id;
    }
    /* This function will return the nome */
    getNome(){
        return this.nome;
    }
    /* This function will return the ficheiro */
    getFicheiro(){
        return this.ficheiro;
    }
}
/* Item Class End */

/*************************************************************/
