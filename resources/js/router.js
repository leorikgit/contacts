import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import ContactCreate from './views/Contact/Create';
import ContactShow from './views/Contact/Show';
import EditContact from './views/Contact/Edit';
import IndexContact from './views/Contact/Index';
import BirthdayIndex from './views/Birthday/index';
Vue.use(VueRouter);

export default new VueRouter({
  routes: [
      {path: '/' , name: 'home', component: ExampleComponent},
      {path: '/contacts/' , name: 'contact.index',  component: IndexContact},
      {path: '/contacts/create' , name: 'contact.create',  component: ContactCreate},
      {path: '/contacts/:id' , name: 'contact.show',  component: ContactShow},
      {path: '/contacts/:id/edit' , name: 'contact.edit',  component: EditContact},
      {path: '/birthdays/' , name: 'birthday.index',  component: BirthdayIndex}
  ],
    mode: 'history'
});
