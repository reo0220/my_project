import * as Vue from "vue";
import {ref} from "vue";
import SampleComponent from "./SampleComponent.vue";

const application = {
    setup(){
        const name = ref("");
        const validateResult = ref("");

        const title = ref("vue test title.");

        let buttonClick = function(){
            title.value = "value update.";
       };

       let validate = function(){
            let isKana = name.value.match(/^[ぁ-んー　]*$/);
            validateResult.value = isKana ? "正常" : "ひらがな以外が入力されています。";
       };

       return{
        title,
        buttonClick,

        name,
        validate,
        validateResult,
       };
    },

    components : {
        "sample-component" : SampleComponent,
    }
};

try{
    let mainElement = document.getElementsByTagName("main")[0];
    Vue.createApp(application).mount(mainElement);
}catch (e){}