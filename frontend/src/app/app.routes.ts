import { Routes } from "@angular/router";
import {AboutComponent} from './components/about/about.component';
import {LoginComponentComponent} from './components/login-component/login-component.component';
import { MainComponent } from "./components/main/main.component";

export const routes: Routes = [
  {path:'', component:MainComponent},
  {path:'login', component:LoginComponentComponent},
  {path:'about', component:AboutComponent},

];
