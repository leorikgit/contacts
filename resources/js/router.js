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
      {path: '/' , name: 'home', component: ExampleComponent,  meta: {'title': 'home'}},
      {path: '/contacts/' , name: 'contact.index',  component: IndexContact, meta: {'title': 'contacts'}},
      {path: '/contacts/create' , name: 'contact.create',  component: ContactCreate, meta: {'title': 'create'}},
      {path: '/contacts/:id' , name: 'contact.show',  component: ContactShow ,meta: {'title': 'show'}},
      {path: '/contacts/:id/edit' , name: 'contact.edit',  component: EditContact,meta: {'title': 'edit'}},
      {path: '/birthdays/' , name: 'birthday.index',  component: BirthdayIndex, meta: {'title': 'birthdays'}}
  ],
    mode: 'history'
});
