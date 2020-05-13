import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import ContactCreate from './views/Contact/Create';


Vue.use(VueRouter);

export default new VueRouter({
  routes: [
      {path: '/' , name: 'home', component: ExampleComponent},
      {path: '/contacts/create' , name: 'contact.create',  component: ContactCreate}
  ],
    mode: 'history'
});
