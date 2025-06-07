import {Component, OnInit} from '@angular/core';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {MatToolbarModule} from '@angular/material/toolbar';
import {RouterLink} from '@angular/router';
import {AuthenticationService} from '../../services/authentication.service';

@Component({
  selector: 'app-navbar-component',
  imports: [MatToolbarModule, MatButtonModule, MatIconModule, RouterLink],
  templateUrl: './navbar-component.component.html',
  styleUrl: './navbar-component.component.scss'
})
export class NavbarComponentComponent implements OnInit {
  isAdmin: boolean = false;
  constructor(public auth : AuthenticationService) {}
    logout():void{
      this.auth.logout();
    }
    ngOnInit():void{
      this.isAdmin = this.auth.isAdmin() ;
      
    }

  filterResults(value: string) {

  }
  }


