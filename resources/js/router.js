import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import ContactCreate from './views/Contact/Create';
import ContactShow from './views/Contact/Show';
import EditContact from './views/Contact/Edit';
Vue.use(VueRouter);

export default new VueRouter({
  routes: [
      {path: '/' , name: 'home', component: ExampleComponent},
      {path: '/contacts/create' , name: 'contact.create',  component: ContactCreate},
      {path: '/contacts/:id' , name: 'contact.show',  component: ContactShow},
      {path: '/contacts/:id/edit' , name: 'contact.edit',  component: EditContact}
  ],
    mode: 'history'
});
