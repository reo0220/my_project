import * as Vue from "vue";
import {ref} from "vue";

const application = {
    setup(){
       const title = ref("vue test title.");

       let buttonClick = function(){
        title.value = "value update.";
       }

       return{
        title,
        buttonClick,
       };
    },
};

try{
    let mainElement = document.getElementsByTagName("main")[0];
    Vue.createApp(application).mount(mainElement);
}catch (e){}