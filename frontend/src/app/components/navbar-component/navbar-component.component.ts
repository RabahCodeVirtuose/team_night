import { Component } from '@angular/core';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {MatToolbarModule} from '@angular/material/toolbar';
import {RouterLink} from '@angular/router';
import {MatFormField, MatInput} from '@angular/material/input';

@Component({
  selector: 'app-navbar-component',
  imports: [MatToolbarModule, MatButtonModule, MatIconModule, RouterLink, MatFormField, MatFormField, MatInput],
  templateUrl: './navbar-component.component.html',
  styleUrl: './navbar-component.component.scss'
})
export class NavbarComponentComponent {

  filterResults(value: string) {

  }
}

